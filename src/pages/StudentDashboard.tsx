import { useState, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import {
    Anchor,
    LogOut,
    Play,
    Clock,
    BarChart3,
    Trophy,
    Calendar,
    History,
    CheckCircle,
    XCircle,
    TrendingUp,
    AlertTriangle
} from "lucide-react";
import { Button } from "@/components/ui/button";
import { useApp } from "@/contexts/AppContext";
import { api } from "@/lib/api";
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from "@/components/ui/alert-dialog";
import { format } from "date-fns";
import { ptBR } from "date-fns/locale";
import { ChangePasswordDialog } from "@/components/ChangePasswordDialog";

interface UserStats {
    total_attempts: number;
    passed_attempts: number;
    failed_attempts: number;
    average_score: number;
    best_score: number;
}

interface Attempt {
    id: number;
    score: number;
    total_questions: number;
    passed: boolean;
    completed_at: string;
    block: number;
}

interface RankingItem {
    name: string;
    best_score: number;
    performance: string;
}

const StudentDashboard = () => {
    const navigate = useNavigate();
    const { user, logout } = useApp();
    const [showLogoutDialog, setShowLogoutDialog] = useState(false);
    const [showChangePasswordDialog, setShowChangePasswordDialog] = useState(false);
    const [stats, setStats] = useState<UserStats | null>(null);
    const [history, setHistory] = useState<Attempt[]>([]);
    const [ranking, setRanking] = useState<RankingItem[]>([]);
    const [blocks, setBlocks] = useState<number[]>([]);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const [statsData, historyData, rankingData, blocksData] = await Promise.all([
                    api.get("/exam/user-stats"),
                    api.get("/exam/history"),
                    api.get("/exam/ranking"),
                    api.get("/questions/blocks"),
                ]);
                setStats(statsData);
                setHistory(historyData);
                setRanking(rankingData);
                setBlocks(blocksData.filter((b: number) => b !== 0));
            } catch (error) {
                console.error("Error fetching student data:", error);
            } finally {
                setIsLoading(false);
            }
        };
        fetchData();
    }, []);

    const handleLogout = () => {
        setShowLogoutDialog(true);
    };

    const confirmLogout = () => {
        logout();
        navigate("/");
    };

    if (isLoading) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-background">
                <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-navy"></div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-background">
            {/* Header */}
            <header className="bg-card border-b border-border sticky top-0 z-40">
                <div className="container mx-auto px-4 py-4">
                    <div className="flex items-center justify-between">
                        <div className="flex items-center gap-3">
                            <div className="w-10 h-10 rounded-lg gradient-navy flex items-center justify-center">
                                <Anchor className="w-6 h-6 text-primary-foreground" />
                            </div>
                            <div>
                                <h1 className="font-bold text-lg text-foreground">Área do Aluno</h1>
                                <p className="text-xs text-muted-foreground mb-1">PREPOM 2026</p>
                                <div className="flex items-center gap-1.5 px-2 py-1 bg-destructive/10 border border-destructive/20 rounded-md max-w-fit">
                                    <AlertTriangle className="w-3 h-3 text-destructive shrink-0" />
                                    <span className="text-[10px] font-bold text-destructive leading-tight">
                                        Acesso Monitorado: O compartilhamento de senha resultará em bloqueio imediato.
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div className="flex items-center gap-3">
                            <Button variant="outline" size="sm" onClick={() => setShowChangePasswordDialog(true)} className="hidden md:flex">
                                Alterar Senha
                            </Button>
                            <Button variant="ghost" size="sm" onClick={handleLogout} className="text-muted-foreground hover:text-destructive">
                                <LogOut className="w-4 h-4 mr-2" />
                                Sair
                            </Button>
                        </div>
                    </div>
                </div>
            </header>

            <main className="container mx-auto px-4 py-8">
                {/* Welcome & Error Notebook */}
                <div className="mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <h2 className="text-2xl font-bold text-foreground mb-1">Olá, {user?.name}!</h2>
                        <p className="text-muted-foreground text-sm flex items-center gap-2">
                            <TrendingUp className="w-4 h-4 text-accent" />
                            Vamos estudar hoje?
                        </p>
                    </div>

                    <Link to="/aluno/erros">
                        <Button variant="outline" className="border-destructive/20 hover:bg-destructive/5 text-destructive hover:text-destructive w-full md:w-auto">
                            <XCircle className="w-4 h-4 mr-2" />
                            Meu Caderno de Erros
                        </Button>
                    </Link>
                </div>

                {/* Blocks Grid */}
                <div className="mb-10">
                    <h3 className="text-lg font-bold text-foreground mb-4 flex items-center gap-2">
                        <Play className="w-5 h-5 text-accent" />
                        Simulados Disponíveis
                    </h3>
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        {blocks.map((blockNum) => (
                            <Link
                                key={blockNum}
                                to={`/aluno/prova?block=${blockNum}`}
                                className="group"
                            >
                                <div className="card-elevated p-6 border-l-4 border-accent hover:bg-muted/50 transition-all duration-300 transform hover:-translate-y-1">
                                    <div className="flex items-center justify-between mb-4">
                                        <div className="w-12 h-12 rounded-xl gradient-navy flex items-center justify-center text-white font-bold text-xl">
                                            {blockNum}
                                        </div>
                                        <div className="bg-accent/10 px-3 py-1 rounded-full">
                                            <span className="text-xs font-bold text-accent tracking-wider uppercase">40 Questões</span>
                                        </div>
                                    </div>
                                    <h4 className="font-bold text-foreground mb-1">Simulado Bloco {blockNum}</h4>
                                    <p className="text-xs text-muted-foreground mb-4">Português e Matemática Fundamental</p>
                                    <Button variant="navy" size="sm" className="w-full">
                                        Começar agora
                                    </Button>
                                </div>
                            </Link>
                        ))}
                        {blocks.length === 0 && (
                            <div className="col-span-full card-elevated p-8 text-center bg-muted/30 border-dashed border-2 border-border">
                                <p className="text-muted-foreground italic">Nenhum simulado disponível no momento.</p>
                            </div>
                        )}
                    </div>
                </div>

                {/* Stats Grid */}
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div className="card-elevated p-6 animate-scale-in" style={{ animationDelay: "0.1s" }}>
                        <div className="flex items-center justify-between mb-2">
                            <History className="w-8 h-8 text-accent opacity-20" />
                            <span className="text-2xl font-bold text-foreground">{stats?.total_attempts}</span>
                        </div>
                        <p className="text-sm text-muted-foreground">Total de Tentativas</p>
                    </div>

                    <div className="card-elevated p-6 animate-scale-in" style={{ animationDelay: "0.2s" }}>
                        <div className="flex items-center justify-between mb-2">
                            <Trophy className="w-8 h-8 text-success opacity-20" />
                            <span className="text-2xl font-bold text-foreground">{stats?.passed_attempts}</span>
                        </div>
                        <p className="text-sm text-muted-foreground">Vezes Aprovado</p>
                    </div>

                    <div className="card-elevated p-6 animate-scale-in" style={{ animationDelay: "0.3s" }}>
                        <div className="flex items-center justify-between mb-2">
                            <BarChart3 className="w-8 h-8 text-secondary opacity-20" />
                            <span className="text-2xl font-bold text-foreground">{stats?.average_score}</span>
                        </div>
                        <p className="text-sm text-muted-foreground">Média de Acertos</p>
                    </div>

                    <div className="card-elevated p-6 animate-scale-in" style={{ animationDelay: "0.4s" }}>
                        <div className="flex items-center justify-between mb-2">
                            <CheckCircle className="w-8 h-8 text-primary opacity-20" />
                            <span className="text-2xl font-bold text-foreground">{stats?.best_score}</span>
                        </div>
                        <p className="text-sm text-muted-foreground">Melhor Pontuação</p>
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {/* Recent History */}
                    <div className="lg:col-span-2">
                        <h3 className="text-lg font-bold text-foreground mb-4 flex items-center gap-2">
                            <Clock className="w-5 h-5 text-accent" />
                            Histórico Recente
                        </h3>
                        <div className="space-y-3">
                            {history.length === 0 ? (
                                <div className="card-elevated p-12 text-center">
                                    <p className="text-muted-foreground">Você ainda não realizou nenhum simulado.</p>
                                </div>
                            ) : (
                                history.map((attempt) => (
                                    <div
                                        key={attempt.id}
                                        className="card-elevated p-4 flex items-center justify-between transition-transform duration-200 hover:scale-[1.01]"
                                    >
                                        <div className="flex items-center gap-4">
                                            <div className={`w-12 h-12 rounded-xl flex items-center justify-center ${attempt.passed ? "bg-success/10" : "bg-destructive/10"
                                                }`}>
                                                {attempt.passed ? (
                                                    <CheckCircle className="w-6 h-6 text-success" />
                                                ) : (
                                                    <XCircle className="w-6 h-6 text-destructive" />
                                                )}
                                            </div>
                                            <div>
                                                <p className="text-[10px] font-bold text-accent uppercase tracking-wider mb-0.5">
                                                    Simulado Bloco {attempt.block}
                                                </p>
                                                <p className="font-bold text-foreground">
                                                    {attempt.score} de {attempt.total_questions} acertos
                                                </p>
                                                <p className="text-xs text-muted-foreground flex items-center gap-1">
                                                    <Calendar className="w-3 h-3" />
                                                    {format(new Date(attempt.completed_at), "dd 'de' MMMM 'às' HH:mm", { locale: ptBR })}
                                                </p>
                                            </div>
                                        </div>
                                        <div className="flex flex-col items-end gap-2">
                                            <span className={`px-3 py-1 rounded-full text-xs font-bold ${attempt.passed ? "bg-success/20 text-success" : "bg-destructive/20 text-destructive"
                                                }`}>
                                                {attempt.passed ? "APROVADO" : "REPROVADO"}
                                            </span>
                                            <Link to={`/aluno/resultado?attemptId=${attempt.id}`}>
                                                <Button variant="link" size="sm" className="text-accent h-auto p-0 flex items-center gap-1 font-bold">
                                                    <BarChart3 className="w-3 h-3" />
                                                    Ver Revisão
                                                </Button>
                                            </Link>
                                        </div>
                                    </div>
                                ))
                            )}
                        </div>
                    </div>

                    {/* Ranking Widget */}
                    <div>
                        <div className="card-navy p-6 rounded-2xl relative overflow-hidden">
                            <div className="absolute top-0 right-0 p-4 opacity-10">
                                <Trophy className="w-24 h-24 text-yellow-400" />
                            </div>
                            <h3 className="text-lg font-bold text-white mb-4 flex items-center gap-2 relative z-10">
                                <Trophy className="w-5 h-5 text-yellow-400" />
                                Top Alunos da Semana
                            </h3>
                            <div className="space-y-3 relative z-10">
                                {ranking.map((item, index) => (
                                    <div key={index} className="flex items-center justify-between p-3 bg-white/5 rounded-lg border border-white/10">
                                        <div className="flex items-center gap-3">
                                            <span className={`w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold ${index === 0 ? "bg-yellow-400 text-black shadow-[0_0_10px_rgba(250,204,21,0.5)]" :
                                                index === 1 ? "bg-gray-300 text-black" :
                                                    index === 2 ? "bg-amber-600 text-white" :
                                                        "bg-white/10 text-white"
                                                }`}>
                                                {index + 1}
                                            </span>
                                            <div>
                                                <p className="text-sm font-medium text-white truncate max-w-[150px]">{item.name.split(' ')[0]} {item.name.split(' ')[1]?.[0]}.</p>
                                                <p className="text-[10px] text-white/50">Eficiência: {item.performance}</p>
                                            </div>
                                        </div>
                                        <div className="text-right">
                                            <span className="text-sm font-bold text-accent block">{item.best_score} acertos</span>
                                        </div>
                                    </div>
                                ))}
                                {ranking.length === 0 && (
                                    <div className="text-center py-4">
                                        <p className="text-white/50 text-sm italic">Ranking em formação...</p>
                                    </div>
                                )}
                            </div>
                            <div className="mt-4 pt-4 border-t border-white/10 text-center">
                                <p className="text-[10px] text-white/40 italic">O ranking considera a melhor nota dos últimos 7 dias.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            {/* Logout Confirmation Dialog */}
            <AlertDialog open={showLogoutDialog} onOpenChange={setShowLogoutDialog}>
                <AlertDialogContent>
                    <AlertDialogHeader>
                        <AlertDialogTitle>Deseja realmente sair?</AlertDialogTitle>
                        <AlertDialogDescription>
                            Sua sessão será encerrada.
                        </AlertDialogDescription>
                    </AlertDialogHeader>
                    <AlertDialogFooter>
                        <AlertDialogCancel>Permanecer</AlertDialogCancel>
                        <AlertDialogAction onClick={confirmLogout} className="bg-destructive text-destructive-foreground hover:bg-destructive/90">
                            Confirmar e Sair
                        </AlertDialogAction>
                    </AlertDialogFooter>
                </AlertDialogContent>
            </AlertDialog>

            <ChangePasswordDialog
                isOpen={showChangePasswordDialog}
                onOpenChange={setShowChangePasswordDialog}
            />
        </div>
    );
};

export default StudentDashboard;
