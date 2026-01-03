import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import { Anchor, ArrowLeft, Edit, Trash2, Plus, Search, Save, X } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Label } from "@/components/ui/label";
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogFooter,
    DialogDescription,
} from "@/components/ui/dialog";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { RadioGroup, RadioGroupItem } from "@/components/ui/radio-group";
import { api } from "@/lib/api";
import { useToast } from "@/components/ui/use-toast";

interface Question {
    id?: number;
    subject: "portugues" | "matematica";
    text: string;
    base_text?: string;
    options: string[];
    correct_answer: number;
    rationale: string;
    is_demo?: boolean;
    block?: number;
}

const AdminDemoQuestions = () => {
    const { toast } = useToast();
    const [questions, setQuestions] = useState<Question[]>([]);
    const [isLoading, setIsLoading] = useState(true);
    const [searchTerm, setSearchTerm] = useState("");

    // Modal State
    const [isDialogOpen, setIsDialogOpen] = useState(false);
    const [isSaving, setIsSaving] = useState(false);
    const [editingQuestion, setEditingQuestion] = useState<Question | null>(null);

    // Form State
    const [formData, setFormData] = useState<Question>({
        subject: "portugues",
        text: "",
        base_text: "",
        options: ["", "", "", ""],
        correct_answer: 0,
        rationale: "",
        is_demo: true,
        block: 0
    });

    useEffect(() => {
        fetchQuestions();
    }, []);

    const fetchQuestions = async () => {
        try {
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

    const handleOpenDialog = (question?: Question) => {
        if (question) {
            setEditingQuestion(question);
            setFormData({ ...question });
        } else {
            setEditingQuestion(null);
            setFormData({
                subject: "portugues",
                text: "",
                base_text: "",
                options: ["", "", "", ""],
                correct_answer: 0,
                rationale: "",
                is_demo: true,
                block: 0
            });
        }
        setIsDialogOpen(true);
    };

    const handleSave = async () => {
        // Basic validation
        if (!formData.text || formData.options.some(opt => !opt) || !formData.rationale) {
            toast({
                title: "Campos obrigatórios",
                description: "Preencha o enunciado, todas as opções e a justificativa.",
                variant: "destructive",
            });
            return;
        }

        setIsSaving(true);
        try {
            if (editingQuestion?.id) {
                // Update
                const response = await api.put(`/questions/${editingQuestion.id}`, formData);
                setQuestions(questions.map(q => q.id === editingQuestion.id ? response : q));
                toast({ title: "Questão atualizada com sucesso!" });
            } else {
                // Create
                const response = await api.post("/questions", formData);
                setQuestions([...questions, response]);
                toast({ title: "Nova questão criada com sucesso!" });
            }
            setIsDialogOpen(false);
        } catch (error) {
            console.error("Error saving question:", error);
            toast({
                title: "Erro ao salvar",
                description: "Verifique os dados e tente novamente.",
                variant: "destructive",
            });
        } finally {
            setIsSaving(false);
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

    const handleOptionChange = (index: number, value: string) => {
        const newOptions = [...formData.options];
        newOptions[index] = value;
        setFormData({ ...formData, options: newOptions });
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
                    <Button variant="navy" onClick={() => handleOpenDialog()}>
                        <Plus className="w-4 h-4 mr-2" />
                        Adicionar Nova Questão
                    </Button>
                </div>

                {isLoading ? (
                    <div className="flex justify-center p-12">
                        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-navy"></div>
                    </div>
                ) : (
                    <div className="grid gap-4">
                        {filteredQuestions.map((q) => (
                            <div key={q.id} className="card-elevated p-6 flex flex-col md:flex-row gap-6 items-start hover:border-accent/40 transition-colors">
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

                                    <h3 className="font-bold text-foreground text-sm leading-relaxed">{q.text}</h3>

                                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                                        {q.options.map((opt, i) => (
                                            <div key={i} className={`p-2 rounded border ${i === q.correct_answer
                                                    ? "bg-success/5 border-success/30 text-success-foreground font-medium"
                                                    : "bg-background border-border text-muted-foreground"
                                                }`}>
                                                <span className="font-bold mr-1">{String.fromCharCode(65 + i)})</span> {opt}
                                            </div>
                                        ))}
                                    </div>

                                    <div className="text-xs text-muted-foreground bg-accent/5 p-2 rounded border border-accent/10">
                                        <span className="font-bold text-accent">Gabarito Comentado:</span> {q.rationale}
                                    </div>
                                </div>

                                <div className="flex md:flex-col gap-2 shrink-0">
                                    <Button variant="outline" size="sm" onClick={() => handleOpenDialog(q)}>
                                        <Edit className="w-4 h-4 mr-1" /> Editar
                                    </Button>
                                    <Button variant="ghost" size="sm" className="text-destructive hover:bg-destructive/10" onClick={() => q.id && handleDelete(q.id)}>
                                        <Trash2 className="w-4 h-4 mr-1" /> Remover
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

            {/* Editor Modal */}
            <Dialog open={isDialogOpen} onOpenChange={setIsDialogOpen}>
                <DialogContent className="max-w-3xl max-h-[90vh] overflow-y-auto">
                    <DialogHeader>
                        <DialogTitle>{editingQuestion ? "Editar Questão" : "Nova Questão de Demonstração"}</DialogTitle>
                        <DialogDescription>
                            Preencha os detalhes da questão. Ela aparecerá no teste grátis imediatamente.
                        </DialogDescription>
                    </DialogHeader>

                    <div className="grid gap-6 py-4">
                        <div className="grid grid-cols-2 gap-4">
                            <div className="space-y-2">
                                <Label>Matéria</Label>
                                <Select
                                    value={formData.subject}
                                    onValueChange={(value: "portugues" | "matematica") => setFormData({ ...formData, subject: value })}
                                >
                                    <SelectTrigger>
                                        <SelectValue placeholder="Selecione" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="portugues">Língua Portuguesa</SelectItem>
                                        <SelectItem value="matematica">Matemática</SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                        </div>

                        <div className="space-y-2">
                            <Label>Texto Base (Opcional)</Label>
                            <Textarea
                                placeholder="Insira o texto base para interpretação, se houver..."
                                className="h-20"
                                value={formData.base_text || ""}
                                onChange={(e) => setFormData({ ...formData, base_text: e.target.value })}
                            />
                        </div>

                        <div className="space-y-2">
                            <Label>Enunciado da Questão</Label>
                            <Textarea
                                placeholder="Qual é a pergunta?"
                                className="h-24 font-medium"
                                value={formData.text}
                                onChange={(e) => setFormData({ ...formData, text: e.target.value })}
                            />
                        </div>

                        <div className="space-y-4 border border-border p-4 rounded-lg bg-muted/20">
                            <Label>Alternativas e Resposta Correta</Label>
                            <RadioGroup
                                value={formData.correct_answer.toString()}
                                onValueChange={(val) => setFormData({ ...formData, correct_answer: parseInt(val) })}
                            >
                                {formData.options.map((opt, index) => (
                                    <div key={index} className="flex items-center gap-3">
                                        <RadioGroupItem value={index.toString()} id={`opt-${index}`} />
                                        <Label htmlFor={`opt-${index}`} className="w-8 font-bold">{String.fromCharCode(65 + index)}</Label>
                                        <Input
                                            value={opt}
                                            onChange={(e) => handleOptionChange(index, e.target.value)}
                                            placeholder={`Opção ${String.fromCharCode(65 + index)}`}
                                            className={index === formData.correct_answer ? "border-success ring-1 ring-success bg-success/5" : ""}
                                        />
                                    </div>
                                ))}
                            </RadioGroup>
                        </div>

                        <div className="space-y-2">
                            <Label>Justificativa (Gabarito Comentado)</Label>
                            <Textarea
                                placeholder="Explique por que esta é a resposta correta..."
                                className="h-20"
                                value={formData.rationale}
                                onChange={(e) => setFormData({ ...formData, rationale: e.target.value })}
                            />
                        </div>
                    </div>

                    <DialogFooter>
                        <Button variant="outline" onClick={() => setIsDialogOpen(false)} disabled={isSaving}>Cancelar</Button>
                        <Button variant="navy" onClick={handleSave} disabled={isSaving}>
                            {isSaving ? (
                                <><div className="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin mr-2" /> Salvando...</>
                            ) : (
                                <><Save className="w-4 h-4 mr-2" /> Salvar Questão</>
                            )}
                        </Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </div>
    );
};

export default AdminDemoQuestions;
