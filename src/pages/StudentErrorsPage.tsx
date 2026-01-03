import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { ArrowLeft, BookOpen, AlertCircle, CheckCircle, XCircle, Target, Filter, RefreshCw, ChevronRight } from "lucide-react";
import { Button } from "@/components/ui/button";
import { api } from "@/lib/api";

interface QuestionError {
    question: {
        id: number;
        text: string;
        base_text?: string;
        options: string[];
        correct_answer: number;
        rationale?: string;
        subject: "portugues" | "matematica";
        hint?: string;
    };
    user_answer: number;
}

const ErrorReviewCard = ({ item }: { item: QuestionError }) => {
    const [status, setStatus] = useState<'pending' | 'correct' | 'wrong'>('pending');
    const [selectedAttempt, setSelectedAttempt] = useState<number | null>(null);

    const handleAttempt = (optionIndex: number) => {
        if (status === 'correct') return; // Já resolvido

        setSelectedAttempt(optionIndex);

        if (optionIndex === item.question.correct_answer) {
            setStatus('correct');
        } else {
            setStatus('wrong');
        }
    };

    return (
        <div className={`card-elevated p-6 animate-fade-in transition-all duration-500 border-l-4 ${status === 'correct' ? 'border-l-success shadow-[0_0_15px_rgba(34,197,94,0.1)]' :
                status === 'wrong' ? 'border-l-destructive shadow-[0_0_15px_rgba(239,68,68,0.1)]' :
                    'border-l-accent'
            }`}>
            <div className="flex items-center justify-between mb-4">
                <div className="flex items-center gap-2">
                    <span className={`px-2 py-0.5 rounded-full text-xs font-bold uppercase ${item.question.subject === 'portugues' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700'
                        }`}>
                        {item.question.subject}
                    </span>
                    <span className="text-xs text-muted-foreground">Questão #{item.question.id}</span>
                </div>

                {status === 'correct' && (
                    <span className="flex items-center gap-1 text-xs font-bold text-success animate-scale-in">
                        <CheckCircle className="w-4 h-4" />
                        Revisada com Sucesso
                    </span>
                )}
            </div>

            {item.question.base_text && (
                <div className="mb-4 p-4 bg-muted/30 rounded-lg text-sm italic text-muted-foreground border-l-2 border-border">
                    {item.question.base_text}
                </div>
            )}

            <div className="font-medium text-lg text-foreground mb-6">
                {item.question.text}
            </div>

            <div className="space-y-2 mb-6">
                {item.question.options.map((opt, index) => {
                    const isOriginalError = index === item.user_answer;
                    const isSelectedNow = index === selectedAttempt;
                    const isCorrect = index === item.question.correct_answer;

                    // Lógica visual complexa para guiar o aluno
                    let styleClass = "border-border bg-card hover:bg-muted/50 cursor-pointer text-muted-foreground";
                    let icon = <div className="w-5 h-5 rounded-full border-2 border-muted flex items-center justify-center text-[10px]">{String.fromCharCode(65 + index)}</div>;

                    if (status === 'correct' && isCorrect) {
                        styleClass = "border-success bg-success/10 text-foreground font-medium";
                        icon = <CheckCircle className="w-5 h-5 text-success fill-success/10" />;
                    } else if (isSelectedNow && status === 'wrong') {
                        styleClass = "border-destructive bg-destructive/10 text-destructive";
                        icon = <XCircle className="w-5 h-5 text-destructive" />;
                    } else if (isOriginalError && status === 'pending') {
                        styleClass = "border-destructive/30 bg-destructive/5 text-muted-foreground opacity-70 border-dashed";
                        icon = <XCircle className="w-5 h-5 text-destructive/50" />;
                    } else if (status === 'correct' && !isCorrect) {
                        styleClass = "border-border/50 bg-muted/20 text-muted-foreground/50 opacity-50 cursor-default";
                    }

                    return (
                        <div
                            key={index}
                            onClick={() => handleAttempt(index)}
                            className={`p-3 rounded-lg border flex items-center gap-3 transition-all duration-200 ${styleClass}`}
                        >
                            {icon}
                            <span className="text-sm flex-1">{opt}</span>

                            {isOriginalError && status === 'pending' && (
                                <span className="text-[10px] text-destructive uppercase font-bold tracking-wider px-2 py-0.5 bg-destructive/10 rounded-full">
                                    Seu erro anterior
                                </span>
                            )}
                        </div>
                    )
                })}
            </div>

            {status === 'correct' && (
                <div className="bg-success/5 p-4 rounded-lg border border-success/20 animate-slide-in-up">
                    <h4 className="font-bold text-success text-sm mb-2 flex items-center gap-2">
                        <Target className="w-4 h-4" />
                        Gabarito & Comentário
                    </h4>
                    <p className="text-sm text-foreground/90 leading-relaxed">
                        {item.question.rationale || "Sem comentário disponível."}
                    </p>
                </div>
            )}

            {status === 'wrong' && (
                <div className="mt-2 text-center text-destructive text-sm font-medium animate-shake">
                    Ops! Tente novamente. Recomeçar é parte do aprendizado.
                </div>
            )}
        </div>
    );
};

const StudentErrorsPage = () => {
    const navigate = useNavigate();
    const [errors, setErrors] = useState<QuestionError[]>([]);
    const [isLoading, setIsLoading] = useState(true);
    const [filter, setFilter] = useState<'all' | 'portugues' | 'matematica'>('all');

    useEffect(() => {
        const fetchErrors = async () => {
            try {
                const data = await api.get("/exam/errors");
                setErrors(data);
            } catch (error) {
                console.error("Error fetching errors:", error);
            } finally {
                setIsLoading(false);
            }
        };
        fetchErrors();
    }, []);

    const filteredErrors = errors.filter(item =>
        filter === 'all' ? true : item.question.subject === filter
    );

    if (isLoading) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-background">
                <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-navy"></div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-background pb-12">
            <header className="bg-card border-b border-border sticky top-0 z-40 shadow-sm">
                <div className="container mx-auto px-4 py-4">
                    <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div className="flex items-center gap-4">
                            <Button variant="ghost" size="icon" onClick={() => navigate("/aluno/dashboard")}>
                                <ArrowLeft className="w-5 h-5" />
                            </Button>
                            <div>
                                <h1 className="font-bold text-lg text-foreground flex items-center gap-2">
                                    <BookOpen className="w-5 h-5 text-destructive" />
                                    Caderno de Erros
                                </h1>
                                <p className="text-xs text-muted-foreground hidden md:block">
                                    Transforme suas falhas em aprendizado. Tente responder novamente.
                                </p>
                            </div>
                        </div>

                        {/* Filtros */}
                        <div className="flex items-center gap-2 p-1 bg-muted rounded-lg overflow-x-auto">
                            <Button
                                variant={filter === 'all' ? 'navy' : 'ghost'}
                                size="sm"
                                onClick={() => setFilter('all')}
                                className="text-xs h-8"
                            >
                                Todas
                            </Button>
                            <Button
                                variant={filter === 'portugues' ? 'navy' : 'ghost'}
                                size="sm"
                                onClick={() => setFilter('portugues')}
                                className="text-xs h-8"
                            >
                                Português
                            </Button>
                            <Button
                                variant={filter === 'matematica' ? 'navy' : 'ghost'}
                                size="sm"
                                onClick={() => setFilter('matematica')}
                                className="text-xs h-8"
                            >
                                Matemática
                            </Button>
                        </div>
                    </div>
                </div>
            </header>

            <main className="container mx-auto px-4 py-8 max-w-4xl">
                {errors.length === 0 ? (
                    <div className="text-center py-12 card-elevated">
                        <CheckCircle className="w-16 h-16 text-success mx-auto mb-4 opacity-50" />
                        <h2 className="text-xl font-bold text-foreground mb-2">Sem erros pendentes!</h2>
                        <p className="text-muted-foreground mb-6">
                            Você não errou nenhuma questão nos últimos 20 simulados ou ainda não começou.
                        </p>
                        <Button onClick={() => navigate("/aluno/dashboard")} variant="navy">
                            Ir para o Dashboard
                        </Button>
                    </div>
                ) : (
                    <>
                        <div className="mb-6 flex items-center justify-between text-sm text-muted-foreground">
                            <span>Exibindo <strong>{filteredErrors.length}</strong> questões pendentes</span>
                            {filteredErrors.length === 0 && filter !== 'all' && (
                                <span className="flex items-center gap-1 text-accent cursor-pointer" onClick={() => setFilter('all')}>
                                    <RefreshCw className="w-3 h-3" /> Limpar filtros
                                </span>
                            )}
                        </div>

                        {filteredErrors.length === 0 ? (
                            <div className="text-center py-12 border-2 border-dashed border-border rounded-xl">
                                <p className="text-muted-foreground">Nenhuma questão encontrada neste filtro.</p>
                            </div>
                        ) : (
                            <div className="space-y-6">
                                {filteredErrors.map((item, index) => (
                                    <ErrorReviewCard key={`${item.question.id}-${index}`} item={item} />
                                ))}
                            </div>
                        )}
                    </>
                )}
            </main>
        </div>
    );
};

export default StudentErrorsPage;
