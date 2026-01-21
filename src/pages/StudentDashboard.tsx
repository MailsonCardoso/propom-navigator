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
    AlertTriangle,
    Target,
    ArrowRight,
    BookOpen,
    Flag,
    TrendingDown,
    Minus
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
import { ThemeToggle } from "@/components/ThemeToggle";

interface TopicStats {
    name: string;
    subject: string;
    performance: number;
    total: number;
    correct: number;
}

interface UserStats {
    total_attempts: number;
    passed_attempts: number;
    failed_attempts: number;
    average_score: number;
    best_score: number;
    subjects?: {
        portugues: number;
        matematica: number;
    };
    topics?: TopicStats[];
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
    const [selectedBlock, setSelectedBlock] = useState<number | null>(null);

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

    const handleStartExam = () => {
        if (selectedBlock) {
            navigate(`/aluno/prova?block=${selectedBlock}`);
            setSelectedBlock(null);
        }
    };

    // --- Lógica do Gráfico Sparkline ---
    const getTrendData = () => {
        if (!history || history.length < 2) return null;
        // Pega as últimas 5 tentativas, inverte para ordem cronológica (mais antiga -> mais nova)
        const recentAttempts = history.slice(0, 5).reverse();

        const points = recentAttempts.map(a => Math.round((a.score / a.total_questions) * 100)); // % de acerto

        // Se todas as notas forem 0, evita gráfico plano feio
        if (points.every(p => p === 0)) return null;

        const min = Math.min(...points);
        const max = Math.max(...points);
        // Normalização para altura do SVG (0 a 40px)
        // Se min == max (notas iguais), evita divisão por zero
        const range = max - min || 1;

        // Gera strings de coordenadas "x,y"
        // Largura SVG 100px. Espaçamento = 100 / (n-1)
        const stepX = 100 / (points.length - 1);

        const svgPoints = points.map((val, i) => {
            const x = i * stepX;
            // Y invertido (0 é topo). 40 é altura. Margem de 5px.
            // (val - min) / range -> normaliza 0..1
            const normalized = (val - min) / range;
            const y = 35 - (normalized * 30); // 35 (base) a 5 (topo)
            return `${x},${y}`;
        }).join(" ");

        // Determina tendência (último vs penúltimo)
        const last = points[points.length - 1];
        const previous = points[points.length - 2];
        let trend: 'up' | 'down' | 'neutral' = 'neutral';
        if (last > previous) trend = 'up';
        if (last < previous) trend = 'down';

        return { svgPoints, trend, points };
    };

    const trendData = getTrendData();
    // -----------------------------------

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
            <header className="bg-card border-b border-border sticky top-0 z-40 shadow-sm">
                <div className="container mx-auto px-4 py-4">
                    <div className="flex items-center justify-between">
                        <div className="flex items-center gap-3">
                            <div className="w-11 h-11 rounded-xl bg-white shadow-lg border border-border/50 flex items-center justify-center shrink-0">
                                <Anchor className="w-6 h-6 text-[#002f5d]" />
                            </div>
                            <div>
                                <h1 className="font-bold text-lg text-foreground">Área do Aluno</h1>
                                <p className="text-xs text-muted-foreground mb-1">PREPOM 2026</p>
                                <div className="flex items-center gap-1.5 px-2 py-1 bg-destructive/10 border border-destructive/20 rounded-md max-w-fit">
                                    <AlertTriangle className="w-3 h-3 text-destructive shrink-0" />
                                    <span className="text-[10px] font-bold text-destructive leading-tight hidden lg:inline">
                                        Monitorado: Compartilhamento de senha gera bloqueio.
                                    </span>
                                    <span className="text-[10px] font-bold text-destructive leading-tight lg:hidden">
                                        Acesso Monitorado
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div className="flex items-center gap-3">
                            <Button variant="outline" size="sm" onClick={() => setShowChangePasswordDialog(true)} className="hidden md:flex">
                                Alterar Senha
                            </Button>
                            <ThemeToggle />
                            <Button variant="ghost" size="sm" onClick={handleLogout} className="text-muted-foreground hover:text-destructive">
                                <LogOut className="w-4 h-4 mr-2" />
                                Sair
                            </Button>
                        </div>
                    </div>
                </div>
            </header>

            <main className="container mx-auto px-4 py-8">

                {/* Greeting Section (Movido para o Topo) */}
                <div className="mb-8 animate-fade-in-up">
                    <h2 className="text-3xl font-bold text-foreground">Olá, {user?.name.split(' ')[0]}!</h2>
                    <p className="text-muted-foreground">Pronto para superar seus limites hoje?</p>
                </div>

                {/* 1. SEÇÃO DE ESTATÍSTICAS (O COCKPIT) */}
                <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    {/* Card Raio-X de Desempenho (Novo) */}
                    <div className="card-elevated p-4 animate-scale-in flex flex-col justify-center gap-4" style={{ animationDelay: "0.1s" }}>
                        <div className="flex items-center justify-between mb-1">
                            <span className="text-xs font-bold text-muted-foreground uppercase flex items-center gap-1">
                                <Target className="w-3 h-3 text-accent" />
                                Raio-X (Últimos 10)
                            </span>
                        </div>
                        <div className="space-y-3">
                            <div>
                                <div className="flex justify-between text-[10px] mb-1">
                                    <span className="font-bold text-blue-500">Português</span>
                                    <span className="font-bold text-foreground">{stats?.subjects?.portugues || 0}%</span>
                                </div>
                                <div className="h-1.5 bg-muted/50 rounded-full overflow-hidden">
                                    <div
                                        className="h-full bg-blue-500 rounded-full transition-all duration-1000 ease-out"
                                        style={{ width: `${stats?.subjects?.portugues || 0}%` }}
                                    />
                                </div>
                            </div>
                            <div>
                                <div className="flex justify-between text-[10px] mb-1">
                                    <span className="font-bold text-green-500">Matemática</span>
                                    <span className="font-bold text-foreground">{stats?.subjects?.matematica || 0}%</span>
                                </div>
                                <div className="h-1.5 bg-muted/50 rounded-full overflow-hidden">
                                    <div
                                        className="h-full bg-green-500 rounded-full transition-all duration-1000 ease-out"
                                        style={{ width: `${stats?.subjects?.matematica || 0}%` }}
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="card-elevated p-6 animate-scale-in flex flex-col justify-between" style={{ animationDelay: "0.2s" }}>
                        <div className="flex items-center justify-between mb-2">
                            <span className="text-sm font-medium text-muted-foreground">Aprovações</span>
                            <Trophy className="w-5 h-5 text-success opacity-50" />
                        </div>
                        <span className="text-3xl font-bold text-foreground">{stats?.passed_attempts}</span>
                    </div>

                    {/* CARD EVOLUÇÃO (COM SPARKLINE) */}
                    <div className="card-elevated p-6 animate-scale-in flex flex-col justify-between relative overflow-hidden" style={{ animationDelay: "0.3s" }}>
                        <div className="flex items-center justify-between mb-2 relative z-10">
                            <span className="text-sm font-medium text-muted-foreground">Evolução</span>
                            {trendData ? (
                                trendData.trend === 'up' ? <TrendingUp className="w-5 h-5 text-green-500" /> :
                                    trendData.trend === 'down' ? <TrendingDown className="w-5 h-5 text-red-500" /> :
                                        <Minus className="w-5 h-5 text-muted-foreground" />
                            ) : (
                                <BarChart3 className="w-5 h-5 text-secondary opacity-50" />
                            )}
                        </div>
                        <div className="relative z-10">
                            <span className="text-3xl font-bold text-foreground">{stats?.average_score}</span>
                            <span className="text-xs text-muted-foreground ml-2">média geral</span>
                        </div>

                        {/* SVG SPARKLINE */}
                        {trendData && (
                            <div className="absolute bottom-0 left-0 right-0 h-16 opacity-20 pointer-events-none">
                                <svg width="100%" height="100%" viewBox="0 0 100 40" preserveAspectRatio="none">
                                    <polyline
                                        points={trendData.svgPoints}
                                        fill="none"
                                        stroke={trendData.trend === 'up' ? '#22c55e' : trendData.trend === 'down' ? '#ef4444' : '#94a3b8'}
                                        strokeWidth="3"
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        vectorEffect="non-scaling-stroke"
                                    />
                                    <polygon
                                        points={`${trendData.svgPoints} 100,60 0,60`}
                                        fill={trendData.trend === 'up' ? '#22c55e' : trendData.trend === 'down' ? '#ef4444' : '#94a3b8'}
                                        opacity="0.2"
                                    />
                                </svg>
                            </div>
                        )}
                    </div>

                    <div className="card-elevated p-6 animate-scale-in flex flex-col justify-between" style={{ animationDelay: "0.4s" }}>
                        <div className="flex items-center justify-between mb-2">
                            <span className="text-sm font-medium text-muted-foreground">Melhor Nota</span>
                            <CheckCircle className="w-5 h-5 text-primary opacity-50" />
                        </div>
                        <span className="text-3xl font-bold text-foreground">{stats?.best_score}</span>
                    </div>
                </div>

                {/* 1.1 ANÁLISE POR ASSUNTO (NOVO) */}
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-8">
                    <div className="card-elevated p-5 animate-scale-in lg:col-span-2 flex flex-col" style={{ animationDelay: "0.5s" }}>
                        <div className="flex items-center justify-between mb-4">
                            <div>
                                <h3 className="text-lg font-bold text-foreground flex items-center gap-2">
                                    <BookOpen className="w-5 h-5 text-primary" />
                                    Fortalezas e Fraquezas por Assunto
                                </h3>
                                <p className="text-xs text-muted-foreground">Seu desempenho detalhado nas últimas 10 tentativas.</p>
                            </div>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                            {stats?.topics && stats.topics.length > 0 ? (
                                stats.topics.map((topic, i) => (
                                    <div key={i} className="group">
                                        <div className="flex justify-between items-center mb-1.5">
                                            <div className="flex flex-col">
                                                <span className="text-sm font-bold text-foreground group-hover:text-primary transition-colors">
                                                    {topic.name}
                                                </span>
                                                <span className="text-[10px] uppercase text-muted-foreground font-medium">
                                                    {topic.subject === 'portugues' ? 'Português' : 'Matemática'}
                                                </span>
                                            </div>
                                            <div className="text-right">
                                                <span className={`text-sm font-black ${topic.performance >= 75 ? 'text-green-500' :
                                                        topic.performance >= 50 ? 'text-yellow-500' : 'text-destructive'
                                                    }`}>
                                                    {topic.performance}%
                                                </span>
                                                <p className="text-[9px] text-muted-foreground">
                                                    {topic.correct}/{topic.total} acertos
                                                </p>
                                            </div>
                                        </div>
                                        <div className="h-2 bg-muted/30 rounded-full overflow-hidden border border-border/5">
                                            <div
                                                className={`h-full rounded-full transition-all duration-1000 ease-out ${topic.performance >= 75 ? 'bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.4)]' :
                                                        topic.performance >= 50 ? 'bg-yellow-500 shadow-[0_0_8px_rgba(234,179,8,0.4)]' :
                                                            'bg-destructive shadow-[0_0_8px_rgba(239,68,68,0.4)]'
                                                    }`}
                                                style={{ width: `${topic.performance}%` }}
                                            />
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <div className="col-span-full py-8 flex flex-col items-center justify-center text-center opacity-60">
                                    <div className="w-12 h-12 rounded-full bg-muted flex items-center justify-center mb-3">
                                        <BarChart3 className="w-6 h-6 text-muted-foreground" />
                                    </div>
                                    <h4 className="font-bold text-foreground">Ainda sem dados de análise</h4>
                                    <p className="text-xs text-muted-foreground max-w-[250px] mx-auto">
                                        Continue realizando simulados para que possamos traçar seu perfil de desempenho por assunto.
                                    </p>
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Dica do Especialista Baseada em Dados (Placeholder Dinâmico) */}
                    <div className="card-elevated p-5 animate-scale-in flex flex-col border-l-4 border-l-primary" style={{ animationDelay: "0.6s" }}>
                        <div className="flex items-center gap-2 mb-4">
                            <div className="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                                <TrendingUp className="w-4 h-4 text-primary" />
                            </div>
                            <h3 className="font-bold text-foreground">Dica do Mentor</h3>
                        </div>

                        <div className="flex-1 space-y-4">
                            {stats?.topics && stats.topics.length > 0 ? (
                                <>
                                    <p className="text-sm text-foreground leading-relaxed">
                                        Analisando seus últimos resultados, notamos que você está com excelente desempenho em
                                        <strong className="text-primary"> {stats.topics[0].name}</strong>.
                                    </p>
                                    <div className="p-3 bg-muted/50 rounded-lg border border-border/50">
                                        <p className="text-xs font-medium text-foreground mb-1">Foco de Estudo Sugerido:</p>
                                        <p className="text-xs text-muted-foreground italic">
                                            "{stats.topics.find(t => t.performance < 60)?.name || 'Reforce a base e mantenha a constância!'} - Dedique 30 min extras a este tópico na sua próxima sessão."
                                        </p>
                                    </div>
                                    <Button className="w-full mt-auto gradient-navy" size="sm" onClick={() => setSelectedBlock(10)}>
                                        Praticar Agora
                                    </Button>
                                </>
                            ) : (
                                <p className="text-sm text-muted-foreground italic leading-relaxed">
                                    "O segredo da aprovação é a constância. Comece seu primeiro simulado hoje para receber dicas personalizadas."
                                </p>
                            )}
                        </div>
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {/* 2. COLUNA DA ESQUERDA (AÇÃO E ESTUDO) */}
                    <div className="lg:col-span-2 space-y-8">

                        {/* Bem-vindo e Caderno de Erros */}
                        <div className="flex flex-col gap-4">
                            {/* CARD CTA: CADERNO DE ERROS */}
                            <Link to="/aluno/erros" className="group block">
                                <div className="card-elevated bg-gradient-to-r from-destructive/5 via-orange-500/5 to-transparent border-l-4 border-destructive p-6 relative overflow-hidden hover:shadow-lg transition-all duration-300">
                                    <div className="absolute top-2 right-2 opacity-10 group-hover:opacity-20 transition-opacity">
                                        <Target className="w-24 h-24 text-destructive" />
                                    </div>
                                    <div className="relative z-10 flex items-center justify-between">
                                        <div>
                                            <h3 className="text-lg font-bold text-foreground flex items-center gap-2">
                                                <Target className="w-5 h-5 text-destructive" />
                                                Revisão Inteligente
                                            </h3>
                                            <p className="text-sm text-muted-foreground mt-1 max-w-md">
                                                Acesse seu <strong>Caderno de Erros</strong>. Focar nas questões que você errou é a forma mais rápida de aumentar sua nota.
                                            </p>
                                        </div>
                                        <div className="bg-card/50 p-2 rounded-full border border-border group-hover:bg-destructive group-hover:border-destructive transition-colors">
                                            <ArrowRight className="w-6 h-6 text-muted-foreground group-hover:text-white" />
                                        </div>
                                    </div>
                                </div>
                            </Link>
                        </div>

                        {/* Lista de Simulados SMART CARDS */}
                        <div>
                            <h3 className="text-lg font-bold text-foreground mb-4 flex items-center gap-2">
                                <Play className="w-5 h-5 text-accent" />
                                Simulados Disponíveis
                            </h3>
                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                {blocks.map((blockNum) => {
                                    // Smart Logic for Card Status
                                    const blockHistory = history.filter(h => h.block === blockNum);
                                    const hasAttempts = blockHistory.length > 0;
                                    const passed = blockHistory.some(h => h.passed);
                                    const bestScore = hasAttempts ? Math.max(...blockHistory.map(h => h.score)) : 0;

                                    let statusBadge;
                                    let borderColor = "border-accent"; // Default Blue

                                    if (!hasAttempts) {
                                        statusBadge = (
                                            <span className="text-[10px] font-bold bg-accent/10 text-accent px-2 py-1 rounded-full uppercase tracking-wider">
                                                Novo
                                            </span>
                                        );
                                    } else if (passed) {
                                        borderColor = "border-green-500";
                                        statusBadge = (
                                            <span className="text-[10px] font-bold bg-green-500/10 text-green-600 px-2 py-1 rounded-full uppercase tracking-wider flex items-center gap-1">
                                                <CheckCircle className="w-3 h-3" /> Aprovado
                                            </span>
                                        );
                                    } else {
                                        borderColor = "border-orange-500";
                                        statusBadge = (
                                            <span className="text-[10px] font-bold bg-orange-500/10 text-orange-600 px-2 py-1 rounded-full uppercase tracking-wider flex items-center gap-1">
                                                <AlertTriangle className="w-3 h-3" /> Tente Novamente
                                            </span>
                                        );
                                    }

                                    return (
                                        <div
                                            key={blockNum}
                                            onClick={() => setSelectedBlock(blockNum)}
                                            className="group cursor-pointer"
                                        >
                                            <div className={`card-elevated p-5 border-l-4 ${borderColor} hover:bg-muted/50 transition-all duration-300 transform hover:-translate-y-1 h-full flex flex-col justify-between`}>
                                                <div>
                                                    <div className="flex items-center justify-between mb-3">
                                                        <div className="w-10 h-10 rounded-lg gradient-navy flex items-center justify-center text-white font-bold text-lg">
                                                            {blockNum}
                                                        </div>
                                                        {statusBadge}
                                                    </div>
                                                    <h4 className="font-bold text-foreground">Simulado Módulo {blockNum}</h4>
                                                    <div className="flex justify-between items-end mb-4">
                                                        <p className="text-xs text-muted-foreground">40 Questões • Port/Mat</p>
                                                        {hasAttempts && (
                                                            <div className="text-right">
                                                                <span className="text-[10px] text-muted-foreground block">Melhor Nota</span>
                                                                <span className={`text-sm font-bold ${passed ? 'text-green-600' : 'text-orange-600'}`}>
                                                                    {bestScore}/40
                                                                </span>
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                                <Button variant="navy" size="sm" className="w-full gap-2 group-hover:bg-navy/90">
                                                    <Play className="w-3 h-3" /> {hasAttempts ? "Refazer Prova" : "Iniciar"}
                                                </Button>
                                            </div>
                                        </div>
                                    );
                                })}
                                {blocks.length === 0 && (
                                    <div className="col-span-full card-elevated p-8 text-center bg-muted/30 border-dashed border-2 border-border">
                                        <p className="text-muted-foreground italic">Nenhum simulado disponível no momento.</p>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* 3. COLUNA DA DIREITA (ANÁLISE) */}
                    <div className="space-y-8">

                        {/* WIDGET DE RANKING */}
                        <div className="card-navy p-6 rounded-2xl relative overflow-hidden shadow-lg transform transition-all hover:scale-[1.01]">
                            <div className="absolute top-0 right-0 p-4 opacity-10">
                                <Trophy className="w-24 h-24 text-yellow-400" />
                            </div>
                            <h3 className="text-lg font-bold text-white mb-4 flex items-center gap-2 relative z-10">
                                <Trophy className="w-5 h-5 text-yellow-400" />
                                Top Alunos (7 dias)
                            </h3>
                            <div className="space-y-3 relative z-10">
                                {ranking.map((item, index) => (
                                    <div key={index} className="flex items-center justify-between p-3 bg-white/5 rounded-lg border border-white/10 hover:bg-white/10 transition-colors">
                                        <div className="flex items-center gap-3">
                                            <span className={`w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold ${index === 0 ? "bg-yellow-400 text-black shadow-[0_0_15px_rgba(250,204,21,0.6)]" :
                                                index === 1 ? "bg-gray-300 text-black" :
                                                    index === 2 ? "bg-amber-600 text-white" :
                                                        "bg-white/10 text-white"
                                                }`}>
                                                {index + 1}
                                            </span>
                                            <div>
                                                <p className="text-sm font-medium text-white truncate max-w-[120px]">
                                                    {item.name.split(' ')[0]} {item.name.split(' ')[1]?.[0]}.
                                                </p>
                                                <p className="text-[10px] text-white/50">{item.performance} aprv.</p>
                                            </div>
                                        </div>
                                        <div className="text-right">
                                            <span className="text-sm font-bold text-accent block">{item.best_score} pts</span>
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
                                <p className="text-[10px] text-white/40 italic">O ranking considera a melhor nota dos últimos 7 dias. Supere seus limites!</p>
                            </div>
                        </div>

                        {/* WIDGET DE HISTÓRICO RECENTE */}
                        <div>
                            <h3 className="text-lg font-bold text-foreground mb-4 flex items-center gap-2">
                                <Clock className="w-5 h-5 text-accent" />
                                Histórico Recente
                            </h3>
                            <div className="space-y-3">
                                {history.slice(0, 5).map((attempt) => (
                                    <div key={attempt.id} className="card-elevated p-4 flex items-center justify-between hover:bg-muted/30 transition-colors">
                                        <div>
                                            <p className="text-xs font-bold text-muted-foreground uppercase mb-0.5">Módulo {attempt.block}</p>
                                            <p className={`font-bold ${attempt.passed ? "text-success" : "text-destructive"}`}>
                                                {attempt.score}/{attempt.total_questions} acertos
                                            </p>
                                            <p className="text-[10px] text-muted-foreground">
                                                {format(new Date(attempt.completed_at), "dd/MM - HH:mm", { locale: ptBR })}
                                            </p>
                                        </div>

                                        <Link to={`/aluno/resultado?attemptId=${attempt.id}`}>
                                            <Button variant="ghost" size="icon" className="h-8 w-8">
                                                <BarChart3 className="w-4 h-4 text-accent" />
                                            </Button>
                                        </Link>
                                    </div>
                                ))}
                                {history.length === 0 && (
                                    <div className="text-center py-8 text-muted-foreground text-sm card-elevated bg-muted/30">
                                        Nenhuma tentativa recente.
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            {/* Exam Briefing Dialog */}
            <AlertDialog open={!!selectedBlock} onOpenChange={(open) => !open && setSelectedBlock(null)}>
                <AlertDialogContent className="max-w-md">
                    <AlertDialogHeader>
                        <div className="flex items-center gap-3 mb-2">
                            <div className="w-10 h-10 rounded-lg gradient-navy flex items-center justify-center">
                                <span className="text-white font-bold">{selectedBlock}</span>
                            </div>
                            <AlertDialogTitle className="text-xl">Simulado Módulo {selectedBlock}</AlertDialogTitle>
                        </div>
                        <AlertDialogDescription className="space-y-4 pt-4">
                            <div className="grid grid-cols-3 gap-3">
                                <div className="bg-muted/50 p-2.5 rounded-lg text-center flex flex-col items-center justify-center h-24">
                                    <Clock className="w-5 h-5 mb-1.5 text-accent" />
                                    <span className="text-[10px] text-muted-foreground font-medium uppercase tracking-wide">Tempo</span>
                                    <span className="font-bold text-foreground text-sm">3h 00m</span>
                                </div>
                                <div className="bg-muted/50 p-2.5 rounded-lg text-center flex flex-col items-center justify-center h-24">
                                    <BookOpen className="w-5 h-5 mb-1.5 text-accent" />
                                    <span className="text-[10px] text-muted-foreground font-medium uppercase tracking-wide">Itens</span>
                                    <span className="font-bold text-foreground text-sm">40 Qts</span>
                                </div>
                                <div className="bg-muted/50 p-2.5 rounded-lg text-center flex flex-col items-center justify-center h-24">
                                    <div className="relative">
                                        <Flag className="w-5 h-5 mb-1.5 text-accent" />
                                        <div className="absolute -top-1 -right-1 w-2 h-2 bg-yellow-400 rounded-full animate-pulse" />
                                    </div>
                                    <span className="text-[10px] text-muted-foreground font-medium uppercase tracking-wide">Revisão</span>
                                    <span className="font-bold text-foreground text-[10px] leading-tight px-1">Marcar p/ depois</span>
                                </div>
                            </div>

                            <div className="p-3 bg-yellow-500/10 border border-yellow-500/20 rounded-lg flex gap-3 text-left">
                                <AlertTriangle className="w-5 h-5 text-yellow-600 shrink-0 mt-0.5" />
                                <div className="text-xs text-yellow-800 dark:text-yellow-200">
                                    <strong className="block mb-0.5">Atenção:</strong>
                                    O cronômetro inicia ao clicar no botão abaixo. Use o recurso de <strong>Marcar Revisão</strong> durante a prova para questões difíceis.
                                </div>
                            </div>
                        </AlertDialogDescription>
                    </AlertDialogHeader>
                    <AlertDialogFooter className="mt-4 gap-2">
                        <AlertDialogCancel className="mt-0 border-slate-200">Cancelar</AlertDialogCancel>
                        <AlertDialogAction onClick={handleStartExam} className="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold h-10 shadow-lg">
                            COMEÇAR PROVA
                        </AlertDialogAction>
                    </AlertDialogFooter>
                </AlertDialogContent>
            </AlertDialog>

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
        </div >
    );
};

export default StudentDashboard;
