import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { api } from "@/lib/api";
import { format } from "date-fns";
import { ptBR } from "date-fns/locale";
import { Input } from "@/components/ui/input";
import { toast } from "sonner";
import {
    MoreHorizontal,
    Copy,
    ExternalLink,
    ShieldAlert,
    ArrowLeft,
    Search,
    Calendar,
    User as UserIcon,
    Globe,
    Info,
    ChevronLeft,
    ChevronRight,
    ShieldCheck
} from "lucide-react";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from "@/components/ui/alert-dialog";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { Badge } from "@/components/ui/badge";

interface SecurityLog {
    id: number;
    user_id: number;
    ip_address: string;
    browser_info: string;
    type: string;
    description: string;
    created_at: string;
    user: {
        id: number;
        name: string;
        cpf: string;
        role: string;
    };
}

interface PaginatedResponse {
    data: SecurityLog[];
    current_page: number;
    last_page: number;
    total: number;
}

const SecurityLogs = () => {
    const [logs, setLogs] = useState<SecurityLog[]>([]);
    const [loading, setLoading] = useState(true);
    const [page, setPage] = useState(1);
    const [lastPage, setLastPage] = useState(1);
    const [searchTerm, setSearchTerm] = useState("");
    const [total, setTotal] = useState(0);
    const [selectedDeviceInfo, setSelectedDeviceInfo] = useState<string | null>(null);

    const copySecurityProof = (log: SecurityLog) => {
        const dateStr = format(new Date(log.created_at), "dd/MM/yyyy 'às' HH:mm:ss");
        const appUrl = window.location.origin;

        const message = `*PREPOM 2026 - NOTIFICAÇÃO DE SEGURANÇA*

Olá, *${log.user.name}*. 

Detectamos uma atividade irregular em sua conta que viola nossos termos de segurança:

*Evento:* ${log.type === 'simultaneous_access' ? "ACESSO SIMULTÂNEO" : log.type.toUpperCase()}
*Data/Hora:* ${dateStr}
*Endereço IP:* ${log.ip_address}
*Plataforma:* ${appUrl}

Lembramos que o acesso ao simulado é individual. O sistema registrou múltiplas conexões ou tentativas de acesso de locais diferentes ao mesmo tempo.

Para sua segurança, pedimos que não compartilhe seus dados de acesso. 

_Caso não reconheça este acesso, recomendamos alterar sua senha imediatamente._`;

        // Fallback para contextos não-HTTPS (como acesso por IP)
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(message)
                .then(() => toast.success("Prova copiada! Cole no WhatsApp do aluno."))
                .catch(() => fallbackCopyTextToClipboard(message));
        } else {
            fallbackCopyTextToClipboard(message);
        }
    };

    const fallbackCopyTextToClipboard = (text: string) => {
        // Limpa qualquer seleção existente para não haver conflito
        const selection = window.getSelection();
        if (selection) {
            selection.removeAllRanges();
        }

        const textArea = document.createElement("textarea");
        textArea.value = text;

        // Assegura que o textarea não seja visível mas esteja no DOM
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        textArea.style.width = "2em";
        textArea.style.height = "2em";
        textArea.style.padding = "0";
        textArea.style.border = "none";
        textArea.style.outline = "none";
        textArea.style.boxShadow = "none";
        textArea.style.background = "transparent";

        document.body.appendChild(textArea);

        textArea.focus();
        textArea.select();

        try {
            const successful = document.execCommand('copy');
            if (successful) {
                toast.success("Prova copiada! Cole no WhatsApp do aluno.");
            } else {
                toast.error("Não foi possível copiar automaticamente.");
            }
        } catch (err) {
            toast.error("Erro ao copiar mensagem.");
        }

        document.body.removeChild(textArea);
    };

    const fetchLogs = async (currentPage: number) => {
        setLoading(true);
        try {
            const response: PaginatedResponse = await api.get(`/security-logs?page=${currentPage}`);
            setLogs(response.data);
            setLastPage(response.last_page);
            setTotal(response.total);
        } catch (error) {
            console.error("Error fetching security logs:", error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchLogs(page);
    }, [page]);

    const filteredLogs = logs.filter(log =>
        log.user.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
        log.user.cpf.includes(searchTerm) ||
        log.ip_address.includes(searchTerm)
    );

    return (
        <div className="min-h-screen bg-background">
            {/* Header */}
            <header className="bg-card border-b border-border sticky top-0 z-40">
                <div className="container mx-auto px-4 py-4">
                    <div className="flex items-center justify-between">
                        <div className="flex items-center gap-4">
                            <Link to="/admin/dashboard">
                                <Button variant="ghost" size="icon">
                                    <ArrowLeft className="w-5 h-5" />
                                </Button>
                            </Link>
                            <div className="flex items-center gap-3">
                                <div className="w-10 h-10 rounded-lg bg-destructive/10 flex items-center justify-center">
                                    <ShieldAlert className="w-6 h-6 text-destructive" />
                                </div>
                                <div>
                                    <h1 className="font-bold text-lg text-foreground">Logs de Segurança</h1>
                                    <p className="text-xs text-muted-foreground">Monitoramento de acessos e auditoria</p>
                                </div>
                            </div>
                        </div>
                        <div className="flex items-center gap-2">
                            <Badge variant="outline" className="font-mono">
                                {total} Registros
                            </Badge>
                        </div>
                    </div>
                </div>
            </header>

            <main className="container mx-auto px-4 py-8">
                <div className="flex flex-col gap-6">
                    {/* Filters */}
                    <div className="flex items-center gap-4">
                        <div className="relative flex-1 max-w-sm">
                            <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                            <Input
                                placeholder="Buscar por aluno, CPF ou IP..."
                                className="pl-9"
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                            />
                        </div>
                        <Button variant="outline" onClick={() => fetchLogs(page)} disabled={loading}>
                            Atualizar
                        </Button>
                    </div>

                    {/* Table */}
                    <div className="card-elevated overflow-hidden">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead className="w-[180px]">Data/Hora</TableHead>
                                    <TableHead>Aluno</TableHead>
                                    <TableHead>IP</TableHead>
                                    <TableHead>Evento</TableHead>
                                    <TableHead>Descrição</TableHead>
                                    <TableHead className="w-[80px]">Ação</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {loading ? (
                                    Array.from({ length: 5 }).map((_, i) => (
                                        <TableRow key={i}>
                                            {Array.from({ length: 6 }).map((_, j) => (
                                                <TableCell key={j}>
                                                    <div className="h-4 bg-muted animate-pulse rounded" />
                                                </TableCell>
                                            ))}
                                        </TableRow>
                                    ))
                                ) : filteredLogs.length === 0 ? (
                                    <TableRow>
                                        <TableCell colSpan={6} className="h-32 text-center text-muted-foreground">
                                            <div className="flex flex-col items-center gap-2">
                                                <ShieldCheck className="w-8 h-8 opacity-20" />
                                                <p>Nenhum log de segurança encontrado.</p>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                ) : (
                                    filteredLogs.map((log) => (
                                        <TableRow key={log.id}>
                                            <TableCell className="font-mono text-xs">
                                                <div className="flex items-center gap-2">
                                                    <Calendar className="w-3 h-3 text-muted-foreground" />
                                                    {format(new Date(log.created_at), "dd/MM/yyyy HH:mm:ss")}
                                                </div>
                                            </TableCell>
                                            <TableCell>
                                                <div className="flex items-center gap-2">
                                                    <UserIcon className="w-3 h-3 text-muted-foreground" />
                                                    <div>
                                                        <p className="font-medium text-sm leading-none mb-1">{log.user.name}</p>
                                                        <p className="text-[10px] text-muted-foreground font-mono">
                                                            CPF: {log.user.cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4")}
                                                        </p>
                                                    </div>
                                                </div>
                                            </TableCell>
                                            <TableCell>
                                                <div className="flex items-center gap-2 font-mono text-xs">
                                                    <Globe className="w-3 h-3 text-muted-foreground" />
                                                    {log.ip_address}
                                                </div>
                                            </TableCell>
                                            <TableCell>
                                                <Badge variant={log.type === 'simultaneous_access' ? "destructive" : "outline"} className="text-[10px] uppercase">
                                                    {log.type === 'simultaneous_access' ? "Acesso Simultâneo" : log.type}
                                                </Badge>
                                            </TableCell>
                                            <TableCell className="text-xs text-muted-foreground max-w-[300px] truncate">
                                                {log.description}
                                            </TableCell>
                                            <TableCell>
                                                <DropdownMenu>
                                                    <DropdownMenuTrigger asChild>
                                                        <Button variant="ghost" size="icon" className="h-8 w-8">
                                                            <MoreHorizontal className="w-4 h-4" />
                                                        </Button>
                                                    </DropdownMenuTrigger>
                                                    <DropdownMenuContent align="end" className="w-56">
                                                        <DropdownMenuLabel>Ações</DropdownMenuLabel>
                                                        <DropdownMenuSeparator />
                                                        <DropdownMenuItem onClick={() => copySecurityProof(log)} className="cursor-pointer">
                                                            <Copy className="w-4 h-4 mr-2" />
                                                            Copiar Prova (WhatsApp)
                                                        </DropdownMenuItem>
                                                        <DropdownMenuItem onClick={() => setSelectedDeviceInfo(log.browser_info)} className="cursor-pointer">
                                                            <Info className="w-4 h-4 mr-2" />
                                                            Ver Info do Navegador
                                                        </DropdownMenuItem>
                                                    </DropdownMenuContent>
                                                </DropdownMenu>
                                            </TableCell>
                                        </TableRow>
                                    ))
                                )}
                            </TableBody>
                        </Table>
                    </div>

                    <AlertDialog open={!!selectedDeviceInfo} onOpenChange={() => setSelectedDeviceInfo(null)}>
                        <AlertDialogContent>
                            <AlertDialogHeader>
                                <AlertDialogTitle>Informações do Dispositivo</AlertDialogTitle>
                                <AlertDialogDescription className="bg-muted p-4 rounded-lg font-mono text-[10px] break-all">
                                    {selectedDeviceInfo}
                                </AlertDialogDescription>
                            </AlertDialogHeader>
                            <AlertDialogFooter>
                                <AlertDialogAction onClick={() => setSelectedDeviceInfo(null)}>Fechar</AlertDialogAction>
                            </AlertDialogFooter>
                        </AlertDialogContent>
                    </AlertDialog>

                    {/* Pagination */}
                    {lastPage > 1 && (
                        <div className="flex items-center justify-center gap-4 mt-4">
                            <Button
                                variant="outline"
                                size="sm"
                                onClick={() => setPage(page - 1)}
                                disabled={page === 1}
                            >
                                <ChevronLeft className="w-4 h-4 mr-2" /> Anterior
                            </Button>
                            <span className="text-sm font-medium">
                                Página {page} de {lastPage}
                            </span>
                            <Button
                                variant="outline"
                                size="sm"
                                onClick={() => setPage(page + 1)}
                                disabled={page === lastPage}
                            >
                                Próxima <ChevronRight className="w-4 h-4 ml-2" />
                            </Button>
                        </div>
                    )}
                </div>
            </main>
        </div>
    );
};

export default SecurityLogs;
