import { useState, useEffect } from "react";
import { api } from "@/lib/api";
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from "@/components/ui/card";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import { Badge } from "@/components/ui/badge";
import { Loader2, RefreshCw, Eye, CheckCircle, XCircle, ArrowLeft, Shield, Globe, Clock, Activity } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Link } from "react-router-dom";

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
            setLogs(data.data);
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
                return (
                    <div className="flex items-center gap-2 text-blue-700 bg-blue-50 px-3 py-1 rounded-full w-fit">
                        <Eye className="w-4 h-4" />
                        <span className="font-medium text-xs">Acessou Demo</span>
                    </div>
                );
            case "LOGIN_SUCCESS":
                return (
                    <div className="flex items-center gap-2 text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full w-fit">
                        <CheckCircle className="w-4 h-4" />
                        <span className="font-medium text-xs">Login Realizado</span>
                    </div>
                );
            case "LOGIN_FAILED":
                return (
                    <div className="flex items-center gap-2 text-red-700 bg-red-50 px-3 py-1 rounded-full w-fit">
                        <XCircle className="w-4 h-4" />
                        <span className="font-medium text-xs">Falha Login</span>
                    </div>
                );
            default:
                return <Badge variant="outline">{action}</Badge>;
        }
    };

    const formatDetails = (details: any) => {
        if (!details) return <span className="text-muted-foreground">-</span>;
        try {
            const obj = typeof details === 'string' ? JSON.parse(details) : details;
            return (
                <div className="flex flex-col gap-1">
                    {Object.entries(obj).map(([key, value]) => (
                        <div key={key} className="text-xs flex items-center gap-1 text-muted-foreground bg-slate-50 px-2 py-0.5 rounded border border-slate-100 w-fit">
                            <span className="font-semibold text-slate-700">{key}:</span> {String(value)}
                        </div>
                    ))}
                </div>
            );
        } catch (e) {
            return "-";
        }
    };

    // Stats calculation (mocked for now based on loaded data)
    const totalDemo = logs.filter(l => l.action === 'VIEW_DEMO').length;
    const totalLogin = logs.filter(l => l.action === 'LOGIN_SUCCESS').length;
    const totalFail = logs.filter(l => l.action === 'LOGIN_FAILED').length;

    return (
        <div className="min-h-screen bg-slate-50/50 pb-12">
            {/* Header Premium */}
            <div className="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-sm">
                <div className="container mx-auto px-4 py-4">
                    <div className="flex items-center justify-between">
                        <div className="flex items-center gap-4">
                            <Link to="/admin/dashboard">
                                <Button variant="ghost" size="icon" className="text-slate-500 hover:text-navy-700">
                                    <ArrowLeft className="w-5 h-5" />
                                </Button>
                            </Link>
                            <div>
                                <h1 className="text-xl font-bold text-navy-900 flex items-center gap-2">
                                    <Shield className="w-5 h-5 text-accent" />
                                    Monitoramento de Acessos
                                </h1>
                                <p className="text-xs text-slate-500">Rastreamento de IPs e atividades em tempo real</p>
                            </div>
                        </div>
                        <Button onClick={fetchLogs} variant="outline" className="gap-2 border-slate-200 hover:bg-slate-50 text-navy-700">
                            <RefreshCw className={`w-4 h-4 ${loading ? 'animate-spin' : ''}`} />
                            Atualizar
                        </Button>
                    </div>
                </div>
            </div>

            <div className="container mx-auto px-4 py-8 space-y-6 animate-fade-in">

                {/* KPI Cards */}
                <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div className="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                        <div className="p-3 bg-blue-50 rounded-lg text-blue-600">
                            <Globe className="w-6 h-6" />
                        </div>
                        <div>
                            <p className="text-sm text-slate-500 font-medium">Total Registros</p>
                            <p className="text-2xl font-bold text-navy-900">{logs.length}</p>
                        </div>
                    </div>
                    <div className="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                        <div className="p-3 bg-emerald-50 rounded-lg text-emerald-600">
                            <Activity className="w-6 h-6" />
                        </div>
                        <div>
                            <p className="text-sm text-slate-500 font-medium">Logins Sucesso</p>
                            <p className="text-2xl font-bold text-navy-900">{totalLogin}</p>
                        </div>
                    </div>
                    <div className="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                        <div className="p-3 bg-amber-50 rounded-lg text-amber-600">
                            <Eye className="w-6 h-6" />
                        </div>
                        <div>
                            <p className="text-sm text-slate-500 font-medium">Demos Iniciadas</p>
                            <p className="text-2xl font-bold text-navy-900">{totalDemo}</p>
                        </div>
                    </div>
                    <div className="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                        <div className="p-3 bg-red-50 rounded-lg text-red-600">
                            <Shield className="w-6 h-6" />
                        </div>
                        <div>
                            <p className="text-sm text-slate-500 font-medium">Bloqueios/Falhas</p>
                            <p className="text-2xl font-bold text-navy-900">{totalFail}</p>
                        </div>
                    </div>
                </div>

                {/* Table Card */}
                <Card className="border-0 shadow-md overflow-hidden bg-white">
                    <CardHeader className="bg-slate-50/50 border-b border-slate-100 pb-4">
                        <div className="flex items-center justify-between">
                            <div>
                                <CardTitle className="text-lg text-navy-900">Histórico de Atividades</CardTitle>
                                <CardDescription>Últimos 50 registros de acesso ao sistema.</CardDescription>
                            </div>
                        </div>
                    </CardHeader>
                    <CardContent className="p-0">
                        <div className="overflow-x-auto">
                            <Table>
                                <TableHeader>
                                    <TableRow className="bg-slate-50 hover:bg-slate-50">
                                        <TableHead className="w-[180px] font-semibold text-navy-700">Data e Hora</TableHead>
                                        <TableHead className="font-semibold text-navy-700">Endereço IP</TableHead>
                                        <TableHead className="font-semibold text-navy-700">Ação Realizada</TableHead>
                                        <TableHead className="font-semibold text-navy-700">Detalhes</TableHead>
                                        <TableHead className="hidden md:table-cell font-semibold text-navy-700">Dispositivo</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {loading && logs.length === 0 ? (
                                        <TableRow>
                                            <TableCell colSpan={5} className="h-32 text-center">
                                                <div className="flex flex-col items-center justify-center gap-2 text-slate-400">
                                                    <Loader2 className="w-8 h-8 animate-spin text-accent" />
                                                    <p>Carregando dados de segurança...</p>
                                                </div>
                                            </TableCell>
                                        </TableRow>
                                    ) : logs.length === 0 ? (
                                        <TableRow>
                                            <TableCell colSpan={5} className="h-32 text-center text-muted-foreground">
                                                Nenhum registro de acesso encontrado.
                                            </TableCell>
                                        </TableRow>
                                    ) : (
                                        logs.map((log) => (
                                            <TableRow key={log.id} className="group hover:bg-blue-50/30 transition-colors border-b border-slate-100">
                                                <TableCell className="whitespace-nowrap">
                                                    <div className="flex items-center gap-2 text-slate-600">
                                                        <Clock className="w-3.5 h-3.5 text-slate-400" />
                                                        <span className="font-medium text-xs">
                                                            {new Date(log.created_at).toLocaleDateString('pt-BR')}
                                                            <span className="text-slate-400 mx-1">•</span>
                                                            {new Date(log.created_at).toLocaleTimeString('pt-BR')}
                                                        </span>
                                                    </div>
                                                </TableCell>
                                                <TableCell>
                                                    <div className="font-mono text-xs bg-slate-100 text-slate-600 px-2 py-1 rounded w-fit border border-slate-200">
                                                        {log.ip_address}
                                                    </div>
                                                </TableCell>
                                                <TableCell>{getActionBadge(log.action)}</TableCell>
                                                <TableCell>{formatDetails(log.details)}</TableCell>
                                                <TableCell className="hidden md:table-cell max-w-[250px]">
                                                    <p className="truncate text-xs text-slate-500" title={log.user_agent || ''}>
                                                        {log.user_agent}
                                                    </p>
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
        </div>
    );
}
