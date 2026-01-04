import { useState, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import {
  Anchor,
  Users,
  DollarSign,
  CheckCircle,
  LogOut,
  PlusCircle,
  BarChart3,
  TrendingUp,
  User,
  ShieldAlert,
  ActivitySquare,
  AlertTriangle,
  Zap,
  UserX,
  XCircle
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
import { ChangePasswordDialog } from "@/components/ChangePasswordDialog";

interface AdminStats {
  engagement_today: number;
  at_risk_count: number;
  at_risk_students: Array<{
    id: number;
    name: string;
    cpf: string;
    last_activity: string;
    days_inactive: string | number;
  }>;
  top_wrong_questions: Array<{
    question_id: number;
    text: string;
    subject: string;
    block: number;
    total_attempts: number;
    wrong_count: number;
    error_rate: number;
  }>;
}

const AdminDashboard = () => {
  const navigate = useNavigate();
  const { logout, students } = useApp();
  const [showChangePasswordDialog, setShowChangePasswordDialog] = useState(false);
  const [showLogoutDialog, setShowLogoutDialog] = useState(false);
  const [adminStats, setAdminStats] = useState<AdminStats | null>(null);
  const [showAtRiskDialog, setShowAtRiskDialog] = useState(false);

  const activeStudents = students.filter((s) => s.active).length;
  const totalRevenue = students.length * 35; // Valor da inscrição R$ 35,00

  useEffect(() => {
    const fetchAdminStats = async () => {
      try {
        const data = await api.get('/admin/stats');
        setAdminStats(data);
      } catch (error) {
        console.error("Error fetching admin stats:", error);
      }
    };
    fetchAdminStats();
  }, []);

  const handleLogout = () => {
    setShowLogoutDialog(true);
  };

  const confirmLogout = () => {
    logout();
    navigate("/");
  };

  const stats = [
    {
      icon: Users,
      label: "Total de Alunos",
      value: students.length,
      color: "bg-accent/10 text-accent",
    },
    {
      icon: CheckCircle,
      label: "Acessos Liberados",
      value: activeStudents,
      color: "bg-success/10 text-success",
    },
    {
      icon: DollarSign,
      label: "Valor Total (Estimado)",
      value: new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(totalRevenue),
      color: "bg-warning/10 text-warning",
    },
  ];

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
                <h1 className="font-bold text-lg text-foreground">Painel Administrativo</h1>
                <p className="text-xs text-muted-foreground">PREPOM 2026</p>
              </div>
            </div>
            <div className="flex items-center gap-3">
              <Link to="/admin/alunos">
                <Button variant="outline" size="sm">
                  <Users className="w-4 h-4 mr-2" />
                  Gerenciar Alunos
                </Button>
              </Link>
              <Button variant="outline" size="sm" onClick={() => setShowChangePasswordDialog(true)}>
                Alterar Senha
              </Button>
              <Button variant="ghost" size="sm" onClick={handleLogout}>
                <LogOut className="w-4 h-4 mr-2" />
                Sair
              </Button>
            </div>
          </div>
        </div>
      </header>

      <main className="container mx-auto px-4 py-8">
        {/* Welcome */}
        <div className="mb-8">
          <h2 className="text-2xl font-bold text-foreground mb-2">Painel de Controle</h2>
          <p className="text-muted-foreground">Gestão em tempo real dos candidatos</p>
        </div>

        {/* Stats Cards */}
        <div className="grid md:grid-cols-3 gap-6 mb-8">
          {stats.map((stat, index) => (
            <div
              key={stat.label}
              className="card-elevated p-6 animate-fade-in"
              style={{ animationDelay: `${index * 0.1}s` }}
            >
              <div className="flex items-center justify-between mb-4">
                <div className={`w-12 h-12 rounded-xl ${stat.color} flex items-center justify-center`}>
                  <stat.icon className="w-6 h-6" />
                </div>
                <TrendingUp className="w-5 h-5 text-success" />
              </div>
              <p className="text-sm text-muted-foreground mb-1">{stat.label}</p>
              <p className="text-3xl font-bold text-foreground">{stat.value}</p>
            </div>
          ))}
        </div>

        {/* ENGAGEMENT & AT-RISK CARDS (NEW!) */}
        <div className="grid md:grid-cols-2 gap-6 mb-8">
          {/* Engajamento Hoje */}
          <div className="card-elevated bg-gradient-to-br from-green-500/10 via-emerald-500/5 to-transparent border-l-4 border-green-500 p-6 relative overflow-hidden">
            <div className="absolute top-2 right-2 opacity-10">
              <Zap className="w-24 h-24 text-green-500" />
            </div>
            <div className="relative z-10">
              <div className="flex items-center gap-2 mb-2">
                <ActivitySquare className="w-5 h-5 text-green-600" />
                <h3 className="font-semibold text-foreground">Engajamento Hoje</h3>
              </div>
              <p className="text-4xl font-bold text-green-600 mb-2">
                {adminStats?.engagement_today ?? '...'}
              </p>
              <p className="text-sm text-muted-foreground">
                Alunos ativos nas últimas 24 horas
              </p>
              <div className="mt-4 pt-4 border-t border-border">
                <p className="text-xs text-muted-foreground italic">
                  💡 {adminStats?.engagement_today && adminStats.engagement_today > 0
                    ? "Ótimo! Seus alunos estão engajados."
                    : "Nenhuma atividade recente. Considere enviar um lembrete."}
                </p>
              </div>
            </div>
          </div>

          {/* Risco de Abandono */}
          <div
            className="card-elevated bg-gradient-to-br from-orange-500/10 via-red-500/5 to-transparent border-l-4 border-orange-500 p-6 relative overflow-hidden cursor-pointer hover:shadow-lg transition-shadow"
            onClick={() => setShowAtRiskDialog(true)}
          >
            <div className="absolute top-2 right-2 opacity-10">
              <UserX className="w-24 h-24 text-orange-500" />
            </div>
            <div className="relative z-10">
              <div className="flex items-center gap-2 mb-2">
                <AlertTriangle className="w-5 h-5 text-orange-600" />
                <h3 className="font-semibold text-foreground">Risco de Abandono</h3>
              </div>
              <p className="text-4xl font-bold text-orange-600 mb-2">
                {adminStats?.at_risk_count ?? '...'}
              </p>
              <p className="text-sm text-muted-foreground">
                Alunos inativos há 7+ dias
              </p>
              <div className="mt-4 pt-4 border-t border-border">
                <p className="text-xs text-muted-foreground italic flex items-center gap-1">
                  <span>👆 Clique para ver a lista completa</span>
                </p>
              </div>
            </div>
          </div>
        </div>

        {/* Info Section */}
        <div className="grid lg:grid-cols-2 gap-6 mb-8">
          <div className="card-elevated p-6">
            <div className="flex items-center gap-2 mb-6">
              <Users className="w-5 h-5 text-accent" />
              <h3 className="font-semibold text-foreground">Últimos Alunos Ativados</h3>
            </div>
            <div className="space-y-4">
              {students.filter(s => s.active).slice(0, 5).map((student) => (
                <div key={student.id} className="flex items-center justify-between border-b border-border/50 pb-2">
                  <div className="flex items-center gap-3">
                    <div className="w-8 h-8 rounded-full bg-muted flex items-center justify-center">
                      <User className="w-4 h-4 text-muted-foreground" />
                    </div>
                    <div>
                      <p className="font-medium text-sm text-foreground">{student.name}</p>
                      <p className="text-xs text-muted-foreground">{student.cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4")}</p>
                    </div>
                  </div>
                  <CheckCircle className="w-4 h-4 text-success" />
                </div>
              ))}
              {students.filter(s => s.active).length === 0 && (
                <p className="text-sm text-muted-foreground text-center py-4">Nenhum aluno ativo no momento.</p>
              )}
            </div>
          </div>

          <div className="card-elevated p-6">
            <div className="flex items-center gap-2 mb-6">
              <BarChart3 className="w-5 h-5 text-accent" />
              <h3 className="font-semibold text-foreground">Distribuição de Status</h3>
            </div>
            <div className="space-y-6">
              <div className="space-y-2">
                <div className="flex justify-between text-sm">
                  <span className="text-muted-foreground">Alunos Ativos</span>
                  <span className="font-bold text-success">{activeStudents}</span>
                </div>
                <div className="h-3 w-full bg-muted rounded-full overflow-hidden">
                  <div
                    className="h-full bg-success transition-all duration-1000"
                    style={{ width: `${students.length ? (activeStudents / students.length) * 100 : 0}%` }}
                  />
                </div>
              </div>
              <div className="space-y-2">
                <div className="flex justify-between text-sm">
                  <span className="text-muted-foreground">Alunos Inativos</span>
                  <span className="font-bold text-muted-foreground">{students.length - activeStudents}</span>
                </div>
                <div className="h-3 w-full bg-muted rounded-full overflow-hidden">
                  <div
                    className="h-full bg-muted-foreground/30 transition-all duration-1000"
                    style={{ width: `${students.length ? ((students.length - activeStudents) / students.length) * 100 : 0}%` }}
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* TOP 5 QUESTÕES MAIS ERRADAS */}
        <div className="card-elevated p-6 mb-8">
          <div className="flex items-center gap-2 mb-6">
            <XCircle className="w-5 h-5 text-destructive" />
            <h3 className="font-semibold text-foreground">Top 5 Questões Mais Erradas</h3>
          </div>
          <div className="space-y-4">
            {adminStats && adminStats.top_wrong_questions.length > 0 ? (
              adminStats.top_wrong_questions.map((q, index) => (
                <div key={q.question_id} className="p-4 border border-border rounded-lg hover:bg-muted/30 transition-colors">
                  <div className="flex items-start gap-3">
                    <div className={`flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm ${q.error_rate >= 70 ? 'bg-destructive/10 text-destructive' :
                      q.error_rate >= 50 ? 'bg-orange-500/10 text-orange-600' :
                        'bg-yellow-500/10 text-yellow-600'
                      }`}>
                      {index + 1}
                    </div>
                    <div className="flex-1 min-w-0">
                      <div className="flex items-start justify-between gap-2 mb-2">
                        <p className="text-sm font-medium text-foreground line-clamp-2">{q.text}</p>
                        <div className="flex-shrink-0 text-right">
                          <span className={`text-2xl font-bold ${q.error_rate >= 70 ? 'text-destructive' :
                            q.error_rate >= 50 ? 'text-orange-600' :
                              'text-yellow-600'
                            }`}>
                            {q.error_rate}%
                          </span>
                          <p className="text-[10px] text-muted-foreground">erro</p>
                        </div>
                      </div>
                      <div className="flex items-center gap-4 text-xs text-muted-foreground">
                        <span className={`px-2 py-0.5 rounded-full ${q.subject === 'portugues' ? 'bg-blue-500/10 text-blue-600' : 'bg-green-500/10 text-green-600'
                          }`}>
                          {q.subject === 'portugues' ? 'Português' : 'Matemática'}
                        </span>
                        <span>Bloco {q.block}</span>
                        <span>{q.wrong_count}/{q.total_attempts} erraram</span>
                      </div>
                      {/* Barra de erro */}
                      <div className="mt-2 h-2 w-full bg-muted rounded-full overflow-hidden">
                        <div
                          className={`h-full transition-all duration-1000 ${q.error_rate >= 70 ? 'bg-destructive' :
                            q.error_rate >= 50 ? 'bg-orange-500' :
                              'bg-yellow-500'
                            }`}
                          style={{ width: `${q.error_rate}%` }}
                        />
                      </div>
                    </div>
                  </div>
                </div>
              ))
            ) : (
              <div className="text-center py-8">
                <BarChart3 className="w-12 h-12 mx-auto text-muted-foreground/50 mb-2" />
                <p className="text-sm text-muted-foreground">Aguardando dados suficientes...</p>
                <p className="text-xs text-muted-foreground mt-1">(Mínimo de 3 tentativas por questão)</p>
              </div>
            )}
          </div>
        </div>

        {/* Quick Actions */}
        <div className="card-navy p-6">
          <h3 className="font-semibold text-white mb-4">Ações Rápidas</h3>
          <div className="flex flex-wrap gap-3">
            <Link to="/admin/questoes/demo">
              <Button variant="outline" className="border-accent/20 hover:bg-accent/5 text-accent hover:text-accent">
                <ShieldAlert className="w-4 h-4 mr-2" />
                Questões Demo
              </Button>
            </Link>
            <Link to="/admin/seguranca">
              <Button variant="outline" className="border-destructive/20 hover:bg-destructive/5 text-destructive hover:text-destructive">
                <ShieldAlert className="w-4 h-4 mr-2" />
                Auditoria de Segurança
              </Button>
            </Link>
            <Button
              variant="outline"
              onClick={async () => {
                try {
                  const data = await api.get('/exam/ranking');
                  if (!data || data.length === 0) {
                    alert("Ainda não há dados de simulados para gerar o ranking desta semana.");
                    return;
                  }

                  // Importação dinâmica para não pesar o bundle inicial
                  const { jsPDF } = await import('jspdf');
                  const autoTable = (await import('jspdf-autotable')).default;

                  const doc = new jsPDF();
                  const now = new Date();
                  const dateStr = now.toLocaleDateString('pt-BR');

                  // Cabeçalho Premium
                  doc.setFillColor(0, 31, 63); // Navy Blue
                  doc.rect(0, 0, 210, 45, 'F');

                  doc.setTextColor(255, 255, 255);
                  doc.setFontSize(26);
                  doc.setFont("helvetica", "bold");
                  doc.text("PREPOM 2026", 15, 22);

                  doc.setFontSize(12);
                  doc.setFont("helvetica", "normal");
                  doc.text("Relatório de Desempenho e Ranking Semanal", 15, 32);
                  doc.text(`Gerado em: ${dateStr}`, 155, 32);

                  // Resumo Informativo
                  doc.setTextColor(0, 31, 63);
                  doc.setFontSize(14);
                  doc.setFont("helvetica", "bold");
                  doc.text("Resumo da Semana", 15, 55);

                  doc.setFontSize(10);
                  doc.setFont("helvetica", "normal");
                  doc.setTextColor(100, 100, 100);
                  doc.text(`Total de candidatos participantes: ${data.length}`, 15, 63);
                  doc.text(`Período de análise: Últimos 7 dias.`, 15, 68);

                  // Linha divisória
                  doc.setDrawColor(220, 220, 220);
                  doc.line(15, 73, 195, 73);

                  // Tabela de Ranking
                  const tableRows = data.map((item: any, index: number) => [
                    `${index + 1}º`,
                    item.name.toUpperCase(),
                    `${item.best_score} / 40`,
                    item.attempts,
                    item.performance
                  ]);

                  autoTable(doc, {
                    startY: 80,
                    head: [['Posição', 'Nome do Aluno', 'Melhor Nota', 'Tentativas', 'Aproveitamento']],
                    body: tableRows,
                    theme: 'striped',
                    headStyles: {
                      fillColor: [0, 31, 63],
                      textColor: [255, 255, 255],
                      fontSize: 10,
                      fontStyle: 'bold',
                      halign: 'center',
                      cellPadding: 4
                    },
                    bodyStyles: {
                      fontSize: 10,
                      halign: 'center',
                      textColor: [50, 50, 50],
                      cellPadding: 4
                    },
                    columnStyles: {
                      1: { halign: 'left', fontStyle: 'bold' }, // Nome do Aluno
                    },
                    alternateRowStyles: {
                      fillColor: [245, 247, 250]
                    },
                    margin: { left: 15, right: 15 }
                  });

                  // Rodapé
                  const pageCount = (doc as any).internal.getNumberOfPages();
                  for (let i = 1; i <= pageCount; i++) {
                    doc.setPage(i);
                    doc.setFontSize(8);
                    doc.setTextColor(150, 150, 150);
                    doc.text(
                      "Este documento é gerado automaticamente pelo PREPOM Navigator para acompanhamento pedagógico.",
                      105,
                      288,
                      { align: "center" }
                    );
                  }

                  doc.save(`Ranking_PREPOM_${now.toISOString().split('T')[0]}.pdf`);

                } catch (error) {
                  console.error("Erro ao exportar PDF:", error);
                  alert("Houve um erro técnico ao gerar o PDF. Verifique o console.");
                }
              }}
            >
              <BarChart3 className="w-4 h-4 mr-2" />
              Exportar PDF Ranking
            </Button>
          </div>
        </div>
      </main>

      {/* At-Risk Students Dialog */}
      <AlertDialog open={showAtRiskDialog} onOpenChange={setShowAtRiskDialog}>
        <AlertDialogContent className="max-w-2xl max-h-[80vh] overflow-y-auto">
          <AlertDialogHeader>
            <AlertDialogTitle className="flex items-center gap-2">
              <AlertTriangle className="w-5 h-5 text-orange-600" />
              Alunos em Risco de Abandono
            </AlertDialogTitle>
            <AlertDialogDescription>
              Lista de alunos ativos que não fazem login ou prova há 7+ dias.
            </AlertDialogDescription>
          </AlertDialogHeader>
          <div className="space-y-3 my-4">
            {adminStats && adminStats.at_risk_students.length > 0 ? (
              adminStats.at_risk_students.map((student) => (
                <div key={student.id} className="p-4 border border-border rounded-lg bg-muted/30 hover:bg-muted/50 transition-colors">
                  <div className="flex justify-between items-start">
                    <div>
                      <p className="font-bold text-foreground">{student.name}</p>
                      <p className="text-xs text-muted-foreground">CPF: {student.cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4")}</p>
                    </div>
                    <div className="text-right">
                      <p className="text-xs text-muted-foreground">Última atividade</p>
                      <p className="text-sm font-bold text-orange-600">{student.last_activity}</p>
                      {typeof student.days_inactive === 'number' && (
                        <p className="text-[10px] text-muted-foreground">{student.days_inactive} dias atrás</p>
                      )}
                    </div>
                  </div>
                </div>
              ))
            ) : (
              <div className="text-center py-8">
                <CheckCircle className="w-12 h-12 mx-auto text-green-500 mb-2" />
                <p className="text-muted-foreground">Nenhum aluno em risco no momento! 🎉</p>
              </div>
            )}
          </div>
          <AlertDialogFooter>
            <AlertDialogCancel>Fechar</AlertDialogCancel>
          </AlertDialogFooter>
        </AlertDialogContent>
      </AlertDialog>

      {/* Logout Confirmation Dialog */}
      <AlertDialog open={showLogoutDialog} onOpenChange={setShowLogoutDialog}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle>Deseja realmente sair?</AlertDialogTitle>
            <AlertDialogDescription>
              Sua sessão administrativa será encerrada.
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

export default AdminDashboard;
