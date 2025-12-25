import { useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import { Anchor, User, Lock, Shield, ArrowRight } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { useApp } from "@/contexts/AppContext";

const AdminLogin = () => {
  const [login, setLogin] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();
  const { login: doLogin } = useApp();

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    const success = await doLogin(login, password, "admin");
    if (success) {
      navigate("/admin/dashboard");
    }
  };

  return (
    <div className="min-h-screen gradient-hero flex items-center justify-center p-4">
      <div className="absolute inset-0 opacity-10">
        <div className="absolute top-20 right-10 w-64 h-64 rounded-full bg-accent blur-3xl" />
        <div className="absolute bottom-20 left-10 w-96 h-96 rounded-full bg-secondary blur-3xl" />
      </div>

      <div className="w-full max-w-md relative z-10">
        <div className="card-elevated p-8 animate-scale-in">
          <div className="text-center mb-8">
            <Link to="/" className="inline-flex items-center gap-3 mb-6">
              <div className="w-12 h-12 rounded-xl gradient-navy flex items-center justify-center">
                <Anchor className="w-7 h-7 text-primary-foreground" />
              </div>
            </Link>
            <div className="flex items-center justify-center gap-2 mb-2">
              <Shield className="w-5 h-5 text-accent" />
              <h1 className="text-2xl font-bold text-foreground">Administração</h1>
            </div>
            <p className="text-muted-foreground">Acesso restrito para administradores</p>
          </div>

          <form onSubmit={handleSubmit} className="space-y-5">
            <div className="space-y-2">
              <Label htmlFor="login" className="text-foreground">Usuário</Label>
              <div className="relative">
                <User className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" />
                <Input
                  id="login"
                  type="text"
                  placeholder="admin"
                  value={login}
                  onChange={(e) => setLogin(e.target.value)}
                  className="pl-11 h-12"
                  required
                />
              </div>
            </div>

            <div className="space-y-2">
              <Label htmlFor="password" className="text-foreground">Senha</Label>
              <div className="relative">
                <Lock className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" />
                <Input
                  id="password"
                  type="password"
                  placeholder="••••••••"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  className="pl-11 h-12"
                  required
                />
              </div>
            </div>

            <Button type="submit" variant="navy" size="lg" className="w-full">
              Acessar Painel
              <ArrowRight className="w-5 h-5 ml-2" />
            </Button>
          </form>

          <div className="mt-6 pt-6 border-t border-border text-center">
            <Link to="/" className="text-sm text-muted-foreground hover:text-foreground transition-colors">
              ← Voltar ao início
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
};

export default AdminLogin;
