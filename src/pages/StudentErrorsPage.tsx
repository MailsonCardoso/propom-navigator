import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { ArrowLeft, BookOpen, AlertCircle, CheckCircle, XCircle } from "lucide-react";
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
    };
    user_answer: number;
}

const StudentErrorsPage = () => {
    const navigate = useNavigate();
    const [errors, setErrors] = useState<QuestionError[]>([]);
    const [isLoading, setIsLoading] = useState(true);

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

    if (isLoading) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-background">
                <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-navy"></div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-background pb-12">
            <header className="bg-card border-b border-border sticky top-0 z-40">
                <div className="container mx-auto px-4 py-4 flex items-center gap-4">
                    <Button variant="ghost" size="icon" onClick={() => navigate("/aluno/dashboard")}>
                        <ArrowLeft className="w-5 h-5" />
                    </Button>
                    <div>
                        <h1 className="font-bold text-lg text-foreground flex items-center gap-2">
                            <BookOpen className="w-5 h-5 text-destructive" />
                            Caderno de Erros
                        </h1>
                        <p className="text-xs text-muted-foreground">
                            Revise as questões que você errou nos últimos simulados.
                        </p>
                    </div>
                </div>
            </header>

            <main className="container mx-auto px-4 py-8 max-w-4xl">
                {errors.length === 0 ? (
                    <div className="text-center py-12 card-elevated">
                        <CheckCircle className="w-16 h-16 text-success mx-auto mb-4 opacity-50" />
                        <h2 className="text-xl font-bold text-foreground mb-2">Parabéns!</h2>
                        <p className="text-muted-foreground">
                            Você não tem erros recentes registrados ou ainda não realizou simulados suficientes.
                        </p>
                        <Button onClick={() => navigate("/aluno/dashboard")} className="mt-6" variant="navy">
                            Voltar ao Dashboard
                        </Button>
                    </div>
                ) : (
                    <div className="space-y-6">
                        {errors.map((item, index) => (
                            <div key={index} className="card-elevated p-6 animate-fade-in" style={{ animationDelay: `${index * 0.1}s` }}>
                                <div className="flex items-center gap-2 mb-4">
                                    <span className={`px-2 py-0.5 rounded-full text-xs font-bold uppercase ${item.question.subject === 'portugues' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700'
                                        }`}>
                                        {item.question.subject}
                                    </span>
                                    <span className="text-xs text-muted-foreground">Questão #{item.question.id}</span>
                                </div>

                                {item.question.base_text && (
                                    <div className="mb-4 p-4 bg-muted/30 rounded-lg text-sm italic text-muted-foreground border-l-2 border-accent">
                                        {item.question.base_text}
                                    </div>
                                )}

                                <div className="font-medium text-lg text-foreground mb-6">
                                    {item.question.text}
                                </div>

                                <div className="space-y-2 mb-6">
                                    {item.question.options.map((opt, optIndex) => {
                                        const isUserWrong = optIndex === item.user_answer;
                                        const isCorrect = optIndex === item.question.correct_answer;

                                        return (
                                            <div key={optIndex} className={`p-3 rounded-lg border flex items-center gap-3 ${isCorrect ? "bg-success/10 border-success text-success-foreground" :
                                                    isUserWrong ? "bg-destructive/10 border-destructive text-destructive-foreground" :
                                                        "bg-card border-border text-muted-foreground opacity-60"
                                                }`}>
                                                <div className={`w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold shrink-0 ${isCorrect ? "bg-success text-white" :
                                                        isUserWrong ? "bg-destructive text-white" :
                                                            "bg-muted text-muted-foreground"
                                                    }`}>
                                                    {String.fromCharCode(65 + optIndex)}
                                                </div>
                                                <span className="text-sm">{opt}</span>
                                                {isCorrect && <CheckCircle className="w-4 h-4 ml-auto text-success" />}
                                                {isUserWrong && <XCircle className="w-4 h-4 ml-auto text-destructive" />}
                                            </div>
                                        )
                                    })}
                                </div>

                                {item.question.rationale && (
                                    <div className="bg-accent/5 p-4 rounded-lg border border-accent/20">
                                        <h4 className="font-bold text-accent text-sm mb-1 flex items-center gap-2">
                                            <AlertCircle className="w-4 h-4" />
                                            Explicação
                                        </h4>
                                        <p className="text-sm text-foreground/80 leading-relaxed">
                                            {item.question.rationale}
                                        </p>
                                    </div>
                                )}
                            </div>
                        ))}
                    </div>
                )}
            </main>
        </div>
    );
};

export default StudentErrorsPage;
