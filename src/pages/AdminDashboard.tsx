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
import WhatsAppButton from "@/components/WhatsAppButton";

const AdminDashboard = () => {
  const navigate = useNavigate();
  const { logout, students } = useApp();

  const activeStudents = students.filter((s) => s.active).length;
  const totalRevenue = activeStudents * 35;

  const handleLogout = () => {
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
      label: "Valor Arrecadado",
      value: `R$ ${totalRevenue.toFixed(2).replace(".", ",")}`,
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
          <h2 className="text-2xl font-bold text-foreground mb-2">Bem-vindo, Administrador</h2>
          <p className="text-muted-foreground">Acompanhe as estatísticas do seu simulado</p>
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

        {/* Chart Section */}
        <div className="grid lg:grid-cols-2 gap-6 mb-8">
          <div className="card-elevated p-6">
            <div className="flex items-center gap-2 mb-6">
              <BarChart3 className="w-5 h-5 text-accent" />
              <h3 className="font-semibold text-foreground">Cadastros por Mês</h3>
            </div>
            <div className="h-48 flex items-end justify-around gap-2">
              {[40, 65, 45, 80, 55, 90].map((height, i) => (
                <div key={i} className="flex-1 flex flex-col items-center gap-2">
                  <div 
                    className="w-full bg-accent/20 rounded-t-lg relative overflow-hidden"
                    style={{ height: `${height}%` }}
                  >
                    <div 
                      className="absolute bottom-0 left-0 right-0 bg-accent rounded-t-lg animate-fade-in"
                      style={{ height: "100%", animationDelay: `${i * 0.1}s` }}
                    />
                  </div>
                  <span className="text-xs text-muted-foreground">
                    {["Jan", "Fev", "Mar", "Abr", "Mai", "Jun"][i]}
                  </span>
                </div>
              ))}
            </div>
          </div>

          <div className="card-elevated p-6">
            <div className="flex items-center gap-2 mb-6">
              <Users className="w-5 h-5 text-accent" />
              <h3 className="font-semibold text-foreground">Últimos Cadastros</h3>
            </div>
            <div className="space-y-4">
              {students.slice(0, 4).map((student) => (
                <div key={student.id} className="flex items-center justify-between">
                  <div className="flex items-center gap-3">
                    <div className="w-10 h-10 rounded-full bg-muted flex items-center justify-center">
                      <User className="w-5 h-5 text-muted-foreground" />
                    </div>
                    <div>
                      <p className="font-medium text-foreground">{student.name}</p>
                      <p className="text-sm text-muted-foreground">{student.login}</p>
                    </div>
                  </div>
                  <span className={`px-2 py-1 rounded-full text-xs font-medium ${
                    student.active 
                      ? "bg-success/10 text-success" 
                      : "bg-muted text-muted-foreground"
                  }`}>
                    {student.active ? "Ativo" : "Inativo"}
                  </span>
                </div>
              ))}
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

      <WhatsAppButton />
    </div>
  );
};

export default AdminDashboard;
