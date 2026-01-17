import { useLocation, useNavigate, Link } from "react-router-dom";
import { CheckCircle2, XCircle, Trophy, ArrowRight, Home, ShoppingCart, RefreshCcw } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Progress } from "@/components/ui/progress";

interface ResultDetail {
    question_id: number;
    subject: "portugues" | "matematica";
    text: string;
    base_text?: string;
    options: string[];
    correct_answer: number;
    user_answer: number | null;
    is_correct: boolean;
    rationale: string;
}

const DemoResultPage = () => {
    const location = useLocation();
    const navigate = useNavigate();
    const { score, total, results } = location.state || { score: 0, total: 0, results: [] as ResultDetail[] };

    if (results.length === 0) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-background">
                <div className="text-center">
                    <h2 className="text-xl font-bold mb-4">Resultado não encontrado</h2>
                    <Button onClick={() => navigate("/")}>Voltar para o Início</Button>
                </div>
            </div>
        );
    }

    const percentage = Math.round((score / total) * 100);

    return (
        <div className="min-h-screen bg-background pb-20 pt-10 px-4">
            <div className="container mx-auto max-w-3xl">
                <div className="card-elevated p-8 md:p-12 text-center mb-8 relative overflow-hidden">
                    <div className="absolute top-0 right-0 p-8 opacity-5 pointer-events-none">
                        <Trophy className="w-48 h-48" />
                    </div>

                    <div className="inline-flex p-4 rounded-3xl bg-accent/10 mb-6">
                        <Trophy className="w-12 h-12 text-accent" />
                    </div>

                    <h1 className="text-3xl md:text-5xl font-black text-foreground mb-4">Seu Desempenho</h1>
                    <p className="text-muted-foreground mb-8 text-lg">Você acertou {score} de {total} questões do teste.</p>

                    <div className="flex flex-col items-center gap-4 mb-10">
                        <div className="w-full max-w-md bg-muted rounded-full h-4 overflow-hidden">
                            <div
                                className="h-full bg-accent transition-all duration-1000"
                                style={{ width: `${percentage}%` }}
                            />
                        </div>
                        <span className="text-4xl font-black text-accent">{percentage}%</span>
                    </div>

                    <div className="bg-navy/5 border border-navy/10 rounded-3xl p-8 mb-8">
                        <h2 className="text-2xl font-bold text-navy mb-4">Gostou da experiência?</h2>
                        <p className="text-navy/70 mb-8 max-w-md mx-auto">
                            Este foi apenas um pequeno teste. No <strong>PREPOM 2026</strong> completo você tem acesso ao <strong>Banco Master de Questões Reais</strong>, Preparação Completa (Módulos I a VI+) com cronômetro real e suporte VIP.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <Link to="/comprar">
                                <Button size="xl" className="bg-accent hover:bg-accent/90 text-white w-full sm:w-auto shadow-lg shadow-accent/20">
                                    <ShoppingCart className="w-5 h-5 mr-2" /> Liberar Acesso Completo
                                </Button>
                            </Link>
                        </div>
                    </div>
                </div>

                <h3 className="text-2xl font-bold text-foreground mb-6 flex items-center gap-2">
                    <CheckCircle2 className="w-6 h-6 text-accent" /> Revisão do Teste
                </h3>

                <div className="space-y-6">
                    {results.map((result: ResultDetail, index: number) => (
                        <div key={index} className={`card-elevated p-6 border-l-4 ${result.is_correct ? "border-l-success" : "border-l-destructive"}`}>
                            <div className="flex items-center gap-2 mb-4">
                                <span className="text-xs font-bold uppercase tracking-widest text-muted-foreground">Questão {index + 1}</span>
                                <span className={`px-2 py-0.5 rounded-full text-[10px] font-bold ${result.subject === "portugues" ? "bg-accent/10 text-accent" : "bg-success/10 text-success"}`}>
                                    {result.subject === "portugues" ? "Português" : "Matemática"}
                                </span>
                                {result.is_correct ? (
                                    <span className="flex items-center gap-1 text-success text-[10px] font-bold uppercase">
                                        <CheckCircle2 className="w-3 h-3" /> Correta
                                    </span>
                                ) : (
                                    <span className="flex items-center gap-1 text-destructive text-[10px] font-bold uppercase">
                                        <XCircle className="w-3 h-3" /> Incorreta
                                    </span>
                                )}
                            </div>

                            <h4 className="text-lg font-bold text-foreground mb-6">{result.text}</h4>

                            <div className="grid gap-3 mb-6">
                                {result.options.map((option, optIndex) => {
                                    const isCorrect = optIndex === result.correct_answer;
                                    const isSelected = optIndex === result.user_answer;

                                    return (
                                        <div
                                            key={optIndex}
                                            className={`p-3 rounded-xl border text-sm flex items-center gap-3 ${isCorrect
                                                ? "bg-success/10 border-success/30 text-success-foreground font-bold"
                                                : isSelected
                                                    ? "bg-destructive/10 border-destructive/30 text-destructive-foreground"
                                                    : "bg-muted/30 border-transparent text-muted-foreground"
                                                }`}
                                        >
                                            <div className={`w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold shrink-0 ${isCorrect ? "bg-success text-white" : isSelected ? "bg-destructive text-white" : "bg-muted text-muted-foreground"
                                                }`}>
                                                {String.fromCharCode(65 + optIndex)}
                                            </div>
                                            <span className="flex-1">{option}</span>
                                            {isCorrect && <CheckCircle2 className="w-4 h-4" />}
                                        </div>
                                    );
                                })}
                            </div>

                            <div className="bg-accent/5 rounded-2xl p-6 border border-accent/10">
                                <h5 className="flex items-center gap-2 text-accent font-bold text-sm mb-3 uppercase tracking-tighter">
                                    Explicação
                                </h5>
                                <p className="text-sm text-foreground/80 leading-relaxed italic border-l-2 border-accent/20 pl-4">
                                    {result.rationale}
                                </p>
                            </div>
                        </div>
                    ))}
                </div>

                <div className="mt-12 text-center p-12 bg-card rounded-[3rem] border border-border">
                    <h2 className="text-3xl font-black text-foreground mb-4">Pronto para a Aprovação?</h2>
                    <p className="text-muted-foreground mb-10 max-w-md mx-auto">
                        Não perca tempo com questões desatualizadas. Tenha em mãos o melhor material preparatório para a Marinha Mercante.
                    </p>
                    <div className="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <Link to="/comprar" className="w-full sm:w-auto">
                            <Button size="xl" variant="hero" className="w-full">
                                Começar agora por R$ 50,00
                            </Button>
                        </Link>
                        <Link to="/" className="w-full sm:w-auto">
                            <Button size="xl" variant="ghost" className="w-full">
                                Voltar ao Início
                            </Button>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default DemoResultPage;
