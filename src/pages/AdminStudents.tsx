import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { 
  Anchor, 
  Users, 
  LogOut, 
  PlusCircle,
  User,
  Search,
  ToggleLeft,
  ToggleRight,
  ArrowLeft,
  X
} from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { useApp } from "@/contexts/AppContext";
import WhatsAppButton from "@/components/WhatsAppButton";
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogFooter,
} from "@/components/ui/dialog";

const AdminStudents = () => {
  const navigate = useNavigate();
  const { logout, students, addStudent, toggleStudentStatus } = useApp();
  const [searchTerm, setSearchTerm] = useState("");
  const [showAddModal, setShowAddModal] = useState(false);
  const [newStudent, setNewStudent] = useState({
    name: "",
    login: "",
    password: "",
  });

  const handleLogout = () => {
    logout();
    navigate("/");
  };

  const handleAddStudent = () => {
    if (newStudent.name && newStudent.login && newStudent.password) {
      addStudent({
        name: newStudent.name,
        login: newStudent.login,
        role: "student",
        active: true,
      });
      setNewStudent({ name: "", login: "", password: "" });
      setShowAddModal(false);
    }
  };

  const filteredStudents = students.filter(
    (student) =>
      student.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
      student.login.toLowerCase().includes(searchTerm.toLowerCase())
  );

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
                <h1 className="font-bold text-lg text-foreground">Gerenciar Alunos</h1>
                <p className="text-xs text-muted-foreground">PROPOM 2026</p>
              </div>
            </div>
            <div className="flex items-center gap-3">
              <Link to="/admin/dashboard">
                <Button variant="outline" size="sm">
                  <ArrowLeft className="w-4 h-4 mr-2" />
                  Dashboard
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
        {/* Actions Bar */}
        <div className="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
          <div className="relative flex-1 max-w-md">
            <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" />
            <Input
              placeholder="Buscar por nome ou login..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="pl-11"
            />
          </div>
          <Button variant="navy" onClick={() => setShowAddModal(true)}>
            <PlusCircle className="w-4 h-4 mr-2" />
            Criar Aluno
          </Button>
        </div>

        {/* Students Table */}
        <div className="card-elevated overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full">
              <thead className="bg-muted/50 border-b border-border">
                <tr>
                  <th className="text-left px-6 py-4 font-medium text-muted-foreground">Aluno</th>
                  <th className="text-left px-6 py-4 font-medium text-muted-foreground">Login</th>
                  <th className="text-left px-6 py-4 font-medium text-muted-foreground">Status</th>
                  <th className="text-right px-6 py-4 font-medium text-muted-foreground">Ações</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-border">
                {filteredStudents.map((student) => (
                  <tr key={student.id} className="hover:bg-muted/30 transition-colors">
                    <td className="px-6 py-4">
                      <div className="flex items-center gap-3">
                        <div className="w-10 h-10 rounded-full bg-muted flex items-center justify-center">
                          <User className="w-5 h-5 text-muted-foreground" />
                        </div>
                        <span className="font-medium text-foreground">{student.name}</span>
                      </div>
                    </td>
                    <td className="px-6 py-4 text-muted-foreground">{student.login}</td>
                    <td className="px-6 py-4">
                      <span className={`inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium ${
                        student.active 
                          ? "bg-success/10 text-success" 
                          : "bg-muted text-muted-foreground"
                      }`}>
                        {student.active ? "Ativo" : "Inativo"}
                      </span>
                    </td>
                    <td className="px-6 py-4">
                      <div className="flex items-center justify-end gap-2">
                        <Button
                          variant="ghost"
                          size="sm"
                          onClick={() => toggleStudentStatus(student.id)}
                          className={student.active ? "text-success" : "text-muted-foreground"}
                        >
                          {student.active ? (
                            <>
                              <ToggleRight className="w-5 h-5 mr-1" />
                              Desativar
                            </>
                          ) : (
                            <>
                              <ToggleLeft className="w-5 h-5 mr-1" />
                              Ativar
                            </>
                          )}
                        </Button>
                      </div>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>

          {filteredStudents.length === 0 && (
            <div className="p-12 text-center">
              <Users className="w-12 h-12 mx-auto text-muted-foreground/50 mb-4" />
              <p className="text-muted-foreground">Nenhum aluno encontrado</p>
            </div>
          )}
        </div>

        {/* Summary */}
        <div className="mt-6 flex items-center justify-between text-sm text-muted-foreground">
          <span>
            Mostrando {filteredStudents.length} de {students.length} alunos
          </span>
          <span>
            {students.filter((s) => s.active).length} ativos • {students.filter((s) => !s.active).length} inativos
          </span>
        </div>
      </main>

      {/* Add Student Modal */}
      <Dialog open={showAddModal} onOpenChange={setShowAddModal}>
        <DialogContent>
          <DialogHeader>
            <DialogTitle>Criar Novo Aluno</DialogTitle>
          </DialogHeader>
          <div className="space-y-4 py-4">
            <div className="space-y-2">
              <Label htmlFor="name">Nome completo</Label>
              <Input
                id="name"
                placeholder="Nome do aluno"
                value={newStudent.name}
                onChange={(e) => setNewStudent({ ...newStudent, name: e.target.value })}
              />
            </div>
            <div className="space-y-2">
              <Label htmlFor="studentLogin">Login</Label>
              <Input
                id="studentLogin"
                placeholder="Login de acesso"
                value={newStudent.login}
                onChange={(e) => setNewStudent({ ...newStudent, login: e.target.value })}
              />
            </div>
            <div className="space-y-2">
              <Label htmlFor="studentPassword">Senha</Label>
              <Input
                id="studentPassword"
                type="password"
                placeholder="Senha de acesso"
                value={newStudent.password}
                onChange={(e) => setNewStudent({ ...newStudent, password: e.target.value })}
              />
            </div>
          </div>
          <DialogFooter>
            <Button variant="outline" onClick={() => setShowAddModal(false)}>
              Cancelar
            </Button>
            <Button variant="navy" onClick={handleAddStudent}>
              Criar Aluno
            </Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>

      <WhatsAppButton />
    </div>
  );
};

export default AdminStudents;
