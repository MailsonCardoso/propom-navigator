import { useState, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { Anchor, ArrowLeft, Edit, Trash2, Plus, Search } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { api } from "@/lib/api";
import { useToast } from "@/components/ui/use-toast";

interface Question {
    id: number;
    subject: "portugues" | "matematica";
    text: string;
    base_text?: string;
    options: string[];
    correct_answer: number;
    rationale: string;
}

const AdminDemoQuestions = () => {
    const navigate = useNavigate();
    const { toast } = useToast();
    const [questions, setQuestions] = useState<Question[]>([]);
    const [isLoading, setIsLoading] = useState(true);
    const [searchTerm, setSearchTerm] = useState("");

    useEffect(() => {
        fetchQuestions();
    }, []);

    const fetchQuestions = async () => {
        try {
            // Reusing the public demo endpoint since it returns exactly what we need (is_demo=true)
            const data = await api.get("/questions/demo");
            setQuestions(data);
        } catch (error) {
            console.error("Error fetching demo questions:", error);
            toast({
                title: "Erro ao carregar questões",
                description: "Não foi possível buscar as questões de demonstração.",
                variant: "destructive",
            });
        } finally {
            setIsLoading(false);
        }
    };

    const handleDelete = async (id: number) => {
        if (!confirm("Tem certeza que deseja remover esta questão da demonstração?")) return;

        try {
            await api.delete(`/questions/${id}`);
            setQuestions(questions.filter(q => q.id !== id));
            toast({
                title: "Questão removida",
                description: "A questão foi removida da demonstração com sucesso.",
            });
        } catch (error) {
            console.error("Error deleting question:", error);
            toast({
                title: "Erro ao remover",
                description: "Não foi possível remover a questão.",
                variant: "destructive",
            });
        }
    };

    const filteredQuestions = questions.filter(
        (q) =>
            q.text.toLowerCase().includes(searchTerm.toLowerCase()) ||
            q.subject.toLowerCase().includes(searchTerm.toLowerCase())
    );

    return (
        <div className="min-h-screen bg-background">
            <header className="bg-card border-b border-border sticky top-0 z-40">
                <div className="container mx-auto px-4 py-4">
                    <div className="flex items-center gap-4">
                        <Link to="/admin/dashboard">
                            <Button variant="ghost" size="icon">
                                <ArrowLeft className="w-5 h-5" />
                            </Button>
                        </Link>
                        <div className="flex items-center gap-3">
                            <div className="w-10 h-10 rounded-lg gradient-navy flex items-center justify-center">
                                <Anchor className="w-6 h-6 text-primary-foreground" />
                            </div>
                            <div>
                                <h1 className="font-bold text-lg text-foreground">Questões de Demonstração</h1>
                                <p className="text-xs text-muted-foreground">Gerenciando {questions.length} questões</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main className="container mx-auto px-4 py-8">
                <div className="flex flex-col md:flex-row justify-between gap-4 mb-8">
                    <div className="relative w-full md:w-96">
                        <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                        <Input
                            placeholder="Buscar por texto..."
                            value={searchTerm}
                            onChange={(e) => setSearchTerm(e.target.value)}
                            className="pl-10"
                        />
                    </div>
                    <Button variant="navy" disabled>
                        <Plus className="w-4 h-4 mr-2" />
                        Adicionar Nova (Em Breve)
                    </Button>
                </div>

                {isLoading ? (
                    <div className="flex justify-center p-12">
                        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-navy"></div>
                    </div>
                ) : (
                    <div className="grid gap-4">
                        {filteredQuestions.map((q) => (
                            <div key={q.id} className="card-elevated p-6 flex flex-col md:flex-row gap-6 items-start">
                                <div className="flex-1 space-y-4">
                                    <div className="flex items-center gap-2">
                                        <span className={`px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider ${q.subject === "portugues" ? "bg-accent/10 text-accent" : "bg-success/10 text-success"
                                            }`}>
                                            {q.subject}
                                        </span>
                                        <span className="text-xs text-muted-foreground">ID: {q.id}</span>
                                    </div>

                                    {q.base_text && (
                                        <div className="text-sm italic text-muted-foreground bg-muted/30 p-3 rounded-lg border border-border">
                                            <span className="font-bold text-[10px] uppercase block mb-1">Texto Base:</span>
                                            {q.base_text.substring(0, 150)}...
                                        </div>
                                    )}

                                    <h3 className="font-bold text-foreground">{q.text}</h3>

                                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                                        {q.options.map((opt, i) => (
                                            <div key={i} className={`p-2 rounded border ${i === q.correct_answer
                                                    ? "bg-success/10 border-success/30 text-success-foreground font-medium"
                                                    : "bg-background border-border text-muted-foreground"
                                                }`}>
                                                {String.fromCharCode(65 + i)}) {opt}
                                            </div>
                                        ))}
                                    </div>

                                    <div className="text-xs text-muted-foreground">
                                        <span className="font-bold text-accent">Explicação:</span> {q.rationale}
                                    </div>
                                </div>

                                <div className="flex md:flex-col gap-2 shrink-0">
                                    <Button variant="ghost" size="sm" className="text-destructive hover:bg-destructive/10" onClick={() => handleDelete(q.id)}>
                                        <Trash2 className="w-4 h-4" />
                                    </Button>
                                </div>
                            </div>
                        ))}

                        {filteredQuestions.length === 0 && (
                            <div className="text-center py-12 text-muted-foreground">
                                Nenhuma questão encontrada.
                            </div>
                        )}
                    </div>
                )}
            </main>
        </div>
    );
};

export default AdminDemoQuestions;
