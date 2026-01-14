import { useState, useEffect } from "react";
import { api } from "@/lib/api";
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from "@/components/ui/card";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import { Badge } from "@/components/ui/badge";
import { Loader2, RefreshCw, Eye, AlertTriangle, CheckCircle, XCircle } from "lucide-react";
import { Button } from "@/components/ui/button";

interface AccessLog {
    id: number;
    ip_address: string;
    action: string;
    user_agent: string | null;
    details: any;
    created_at: string;
}

export function MonitoramentoView() {
    const [logs, setLogs] = useState<AccessLog[]>([]);
    const [loading, setLoading] = useState(true);

    const fetchLogs = async () => {
        setLoading(true);
        try {
            const data = await api.get("/access-logs");
            setLogs(data.data); // Laravel paginate returns inside data key
        } catch (error) {
            console.error("Erro ao buscar logs:", error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchLogs();
    }, []);

    const getActionBadge = (action: string) => {
        switch (action) {
            case "VIEW_DEMO":
                return <Badge variant="secondary" className="bg-blue-100 text-blue-800 hover:bg-blue-200"><Eye className="w-3 h-3 mr-1" /> Simulado Demo</Badge>;
            case "LOGIN_SUCCESS":
                return <Badge variant="outline" className="bg-emerald-100 text-emerald-800 border-emerald-200"><CheckCircle className="w-3 h-3 mr-1" /> Login Sucesso</Badge>;
            case "LOGIN_FAILED":
                return <Badge variant="destructive" className="bg-red-100 text-red-800 hover:bg-red-200 border-red-200"><XCircle className="w-3 h-3 mr-1" /> Falha Login</Badge>;
            default:
                return <Badge variant="outline">{action}</Badge>;
        }
    };

    const formatDetails = (details: any) => {
        if (!details) return "-";
        // Tenta parsear se for string json, ou usa direto se ja for obj
        try {
            const obj = typeof details === 'string' ? JSON.parse(details) : details;
            return Object.entries(obj).map(([key, value]) => (
                <div key={key} className="text-xs text-muted-foreground">
                    <span className="font-semibold">{key}:</span> {String(value)}
                </div>
            ));
        } catch (e) {
            return "-";
        }
    };

    return (
        <div className="space-y-6 animate-fade-in">
            <div className="flex items-center justify-between">
                <div>
                    <h2 className="text-3xl font-bold tracking-tight text-navy-900">Monitoramento em Tempo Real</h2>
                    <p className="text-muted-foreground mt-1">Acompanhe quem está acessando o sistema e realizando testes.</p>
                </div>
                <Button onClick={fetchLogs} variant="outline" className="gap-2">
                    <RefreshCw className={`w-4 h-4 ${loading ? 'animate-spin' : ''}`} />
                    Atualizar
                </Button>
            </div>

            <Card>
                <CardHeader>
                    <CardTitle>Últimos Acessos</CardTitle>
                    <CardDescription>Registro de IPs e ações realizadas no sistema.</CardDescription>
                </CardHeader>
                <CardContent>
                    <div className="rounded-md border">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Data/Hora</TableHead>
                                    <TableHead>IP</TableHead>
                                    <TableHead>Ação</TableHead>
                                    <TableHead>Detalhes</TableHead>
                                    <TableHead className="hidden md:table-cell">Navegador (User Agent)</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {loading && logs.length === 0 ? (
                                    <TableRow>
                                        <TableCell colSpan={5} className="h-24 text-center">
                                            <div className="flex items-center justify-center gap-2">
                                                <Loader2 className="w-4 h-4 animate-spin" />
                                                Carregando...
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                ) : logs.length === 0 ? (
                                    <TableRow>
                                        <TableCell colSpan={5} className="h-24 text-center text-muted-foreground">
                                            Nenhum registro encontrado.
                                        </TableCell>
                                    </TableRow>
                                ) : (
                                    logs.map((log) => (
                                        <TableRow key={log.id} className="group hover:bg-slate-50">
                                            <TableCell className="whitespace-nowrap font-medium text-xs">
                                                {new Date(log.created_at).toLocaleString('pt-BR')}
                                            </TableCell>
                                            <TableCell className="font-mono text-xs">{log.ip_address}</TableCell>
                                            <TableCell>{getActionBadge(log.action)}</TableCell>
                                            <TableCell>{formatDetails(log.details)}</TableCell>
                                            <TableCell className="hidden md:table-cell max-w-[200px] truncate text-xs text-muted-foreground" title={log.user_agent || ''}>
                                                {log.user_agent}
                                            </TableCell>
                                        </TableRow>
                                    ))
                                )}
                            </TableBody>
                        </Table>
                    </div>
                </CardContent>
            </Card>
        </div>
    );
}
