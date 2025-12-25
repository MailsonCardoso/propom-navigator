import { useState } from "react";
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
  User
} from "lucide-react";
import { Button } from "@/components/ui/button";
import { useApp } from "@/contexts/AppContext";
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

const AdminDashboard = () => {
  const navigate = useNavigate();
  const { logout, students } = useApp();

  const [showLogoutDialog, setShowLogoutDialog] = useState(false);
  const activeStudents = students.filter((s) => s.active).length;
  const totalRevenue = activeStudents * 35; // Valor da inscrição R$ 35,00

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
                <p className="text-xs text-muted-foreground">PROPOM 2026</p>
              </div>
            </div>
            <div className="flex items-center gap-3">
              <Link to="/admin/alunos">
                <Button variant="outline" size="sm">
                  <Users className="w-4 h-4 mr-2" />
                  Gerenciar Alunos
                </Button>
              </Link>
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
                      <p className="text-xs text-muted-foreground">{student.login}</p>
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

        {/* Quick Actions */}
        <div className="card-navy p-6">
          <h3 className="font-semibold text-foreground mb-4">Ações Rápidas</h3>
          <div className="flex flex-wrap gap-3">
            <Link to="/admin/alunos">
              <Button variant="navy">
                <PlusCircle className="w-4 h-4 mr-2" />
                Adicionar Aluno
              </Button>
            </Link>
            <Button variant="outline">
              <BarChart3 className="w-4 h-4 mr-2" />
              Exportar Relatório
            </Button>
          </div>
        </div>
      </main>

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
    </div>
  );
};

export default AdminDashboard;
