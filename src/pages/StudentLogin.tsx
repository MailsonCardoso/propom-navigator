import { useState, useEffect } from "react";
import { useNavigate, Link, useSearchParams } from "react-router-dom";
import { Anchor, User, Lock, ArrowRight, ShieldCheck, CheckCircle2 } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { useApp } from "@/contexts/AppContext";
import { toast } from "sonner";
import { api } from "@/lib/api";
import { useTheme } from "next-themes";

const StudentLogin = () => {
  const { setTheme } = useTheme();

  useEffect(() => {
    setTheme("light");
  }, [setTheme]);

  const [cpf, setCpf] = useState("");
  const [password, setPassword] = useState("");
  const [mustChange, setMustChange] = useState(false);
  const [newPassword, setNewPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");

  const navigate = useNavigate();
  const { login: doLogin } = useApp();
  const [searchParams] = useSearchParams();
  const [successMessage, setSuccessMessage] = useState<string | null>(null);

  const formatCPF = (value: string) => {
    return value
      .replace(/\D/g, "")
      .replace(/(\d{3})(\d)/, "$1.$2")
      .replace(/(\d{3})(\d)/, "$1.$2")
      .replace(/(\d{3})(\d{1,2})/, "$1-$2")
      .replace(/(-\d{2})\d+?$/, "$1");
  };

  useEffect(() => {
    const status = searchParams.get("status");
    const collectionStatus = searchParams.get("collection_status");

    if (status === "success" || collectionStatus === "approved") {
      setSuccessMessage("Pagamento confirmado com sucesso!");
      toast.success("Pagamento aprovado! Faça login agora.");
    } else if (status === "failure" || collectionStatus === "rejected") {
      toast.error("O pagamento falhou ou foi cancelado.");
    } else if (status === "pending" || collectionStatus === "in_process") {
      toast.info("Pagamento em processamento. Aguarde a confirmação.");
    }
  }, [searchParams]);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    const result = await doLogin(cpf.replace(/\D/g, ""), password, "student");

    if (result.success) {
      if (result.mustChangePassword) {
        setMustChange(true);
      } else {
        navigate("/aluno/dashboard");
      }
    }
  };

  const handleChangePassword = async (e: React.FormEvent) => {
    e.preventDefault();
    if (newPassword !== confirmPassword) {
      toast.error("As senhas não coincidem!");
      return;
    }
    if (newPassword.length < 6) {
      toast.error("A senha deve ter pelo menos 6 caracteres.");
      return;
    }

    try {
      await api.post("/auth/change-password", {
        password: newPassword,
        password_confirmation: confirmPassword
      });
      toast.success("Senha alterada com sucesso! Bem-vindo.");
      navigate("/aluno/dashboard");
    } catch (error: any) {
      toast.error(error.message || "Erro ao alterar senha");
    }
  };

  return (
    <div className="min-h-screen gradient-hero flex items-center justify-center p-4">
      <div className="absolute inset-0 opacity-10">
        <div className="absolute top-20 left-10 w-64 h-64 rounded-full bg-accent blur-3xl" />
        <div className="absolute bottom-20 right-10 w-96 h-96 rounded-full bg-secondary blur-3xl" />
      </div>

      <div className="w-full max-w-md relative z-10">
        <div className="card-elevated p-8 animate-scale-in">
          <div className="text-center mb-8">
            <Link to="/" className="inline-flex items-center gap-3 mb-6">
              <div className="w-12 h-12 rounded-xl gradient-navy flex items-center justify-center">
                <Anchor className="w-7 h-7 text-primary-foreground" />
              </div>
            </Link>

            {mustChange ? (
              <>
                <h1 className="text-2xl font-bold text-foreground mb-2">Primeiro Acesso</h1>
                <p className="text-muted-foreground">Por segurança, altere sua senha inicial agora.</p>
              </>
            ) : (
              <>
                <h1 className="text-2xl font-bold text-foreground mb-2">Área do Aluno</h1>
                <p className="text-muted-foreground">Acesse sua conta para iniciar o simulado</p>
              </>
            )}
          </div>

          {successMessage && (
            <div className="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-start gap-3 animate-fade-in">
              <CheckCircle2 className="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
              <div className="text-sm">
                <p className="font-bold text-emerald-800">Tudo certo!</p>
                <p className="text-emerald-700 mt-1">
                  Seu acesso foi liberado. Use seu <strong className="font-bold">CPF</strong> e a senha são os <strong className="font-bold">6 primeiros dígitos do seu CPF</strong>.
                </p>
                <p className="text-emerald-600 mt-2 text-xs">
                  📧 Enviamos um email com suas credenciais. <strong>Verifique a caixa de SPAM</strong> caso não encontre na entrada.
                </p>
              </div>
            </div>
          )}

          {/* Info sobre email - sempre visível */}
          <div className="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl flex items-start gap-3">
            <svg className="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div className="text-sm">
              <p className="font-bold text-blue-800">Acabou de comprar?</p>
              <p className="text-blue-700 mt-1">
                Enviamos um email com suas credenciais de acesso. <strong>Verifique sua caixa de SPAM</strong> se não receber em alguns minutos.
              </p>
            </div>
          </div>

          {!mustChange ? (
            <form onSubmit={handleSubmit} className="space-y-5">
              <div className="space-y-2">
                <Label htmlFor="cpf" className="text-foreground">CPF</Label>
                <div className="relative">
                  <User className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" />
                  <Input
                    id="cpf"
                    type="text"
                    placeholder="000.000.000-00"
                    value={cpf}
                    onChange={(e) => setCpf(formatCPF(e.target.value))}
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
                    placeholder="Digite sua senha"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    className="pl-11 h-12"
                    required
                  />
                </div>
              </div>

              <Button type="submit" variant="navy" size="lg" className="w-full">
                Entrar
                <ArrowRight className="w-5 h-5 ml-2" />
              </Button>
            </form>
          ) : (
            <form onSubmit={handleChangePassword} className="space-y-5">
              <div className="space-y-2">
                <Label htmlFor="newPassword" className="text-foreground">Nova Senha</Label>
                <div className="relative">
                  <ShieldCheck className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" />
                  <Input
                    id="newPassword"
                    type="password"
                    placeholder="Pelo menos 6 caracteres"
                    value={newPassword}
                    onChange={(e) => setNewPassword(e.target.value)}
                    className="pl-11 h-12"
                    required
                  />
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="confirmPassword" className="text-foreground">Confirmar Senha</Label>
                <div className="relative">
                  <Lock className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" />
                  <Input
                    id="confirmPassword"
                    type="password"
                    placeholder="Repita a nova senha"
                    value={confirmPassword}
                    onChange={(e) => setConfirmPassword(e.target.value)}
                    className="pl-11 h-12"
                    required
                  />
                </div>
              </div>

              <Button type="submit" variant="navy" size="lg" className="w-full">
                Salvar Nova Senha
                <ArrowRight className="w-5 h-5 ml-2" />
              </Button>
            </form>
          )}

          {!mustChange && (
            <div className="mt-6 text-center">
              <p className="text-sm text-muted-foreground">
                Ainda não tem acesso?{" "}
                <Link to="/comprar" className="text-accent hover:underline font-medium">
                  Compre aqui
                </Link>
              </p>
            </div>
          )}

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

export default StudentLogin;
