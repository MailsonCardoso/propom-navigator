import { useState } from "react";
import { Link } from "react-router-dom";
import { Anchor, CheckCircle, ShieldCheck, Loader2, CreditCard } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { toast } from "sonner";
import { api } from "@/lib/api";

const PurchasePage = () => {
  const [loading, setLoading] = useState(false);
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    cpf: "",
    phone: ""
  });

  const formatCPF = (value: string) => {
    return value
      .replace(/\D/g, "")
      .replace(/(\d{3})(\d)/, "$1.$2")
      .replace(/(\d{3})(\d)/, "$1.$2")
      .replace(/(\d{3})(\d{1,2})/, "$1-$2")
      .replace(/(-\d{2})\d+?$/, "$1");
  };

  const formatPhone = (value: string) => {
    return value
      .replace(/\D/g, "")
      .replace(/(\d{2})(\d)/, "($1) $2")
      .replace(/(\d{5})(\d)/, "$1-$2")
      .replace(/(-\d{4})\d+?$/, "$1");
  };

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    let formattedValue = value;

    if (name === "cpf") formattedValue = formatCPF(value);
    if (name === "phone") formattedValue = formatPhone(value);

    setFormData((prev) => ({ ...prev, [name]: formattedValue }));
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    // Validação básica
    if (!formData.name || !formData.email || formData.cpf.length < 14 || formData.phone.length < 14) {
      toast.error("Por favor, preencha todos os campos corretamente.");
      return;
    }

    setLoading(true);

    try {
      const response = await api.post("/payment/create", formData);

      if (response && response.init_point) {
        toast.success("Gerando pagamento, aguarde...");
        // Redireciona para o Mercado Pago
        window.location.href = response.init_point;
      } else {
        toast.error("Erro ao gerar link de pagamento.");
      }
    } catch (error) {
      console.error(error);
      toast.error("Erro ao conectar com servidor de pagamento.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="min-h-screen gradient-hero flex items-center justify-center p-4">
      <div className="absolute inset-0 opacity-10">
        <div className="absolute top-20 left-10 w-64 h-64 rounded-full bg-accent blur-3xl" />
        <div className="absolute bottom-20 right-10 w-96 h-96 rounded-full bg-secondary blur-3xl" />
      </div>

      <div className="w-full max-w-lg relative z-10">
        <div className="card-elevated p-8 animate-scale-in">
          <div className="text-center mb-8">
            <Link to="/" className="inline-flex items-center gap-3 mb-6">
              <div className="w-12 h-12 rounded-xl gradient-navy flex items-center justify-center">
                <Anchor className="w-7 h-7 text-primary-foreground" />
              </div>
            </Link>
            <h1 className="text-2xl font-bold text-foreground mb-2">Adquirir Acesso</h1>
            <p className="text-muted-foreground text-sm">Cadastre-se para liberar seu acesso</p>
          </div>

          <div className="bg-muted/50 rounded-xl p-6 mb-8 border border-border">
            <div className="flex items-center justify-between mb-4">
              <span className="text-foreground font-medium">Plano Completo</span>
              <span className="text-2xl font-bold text-foreground">R$ 50,00</span>
            </div>
            <div className="space-y-3">
              <div className="flex items-start gap-3 p-3 bg-background/50 rounded-lg">
                <CheckCircle className="w-5 h-5 text-success shrink-0 mt-0.5" />
                <span className="text-foreground font-medium">Acesso Total ao Banco de Questões</span>
              </div>
              <div className="flex items-start gap-3 p-3 bg-background/50 rounded-lg">
                <CheckCircle className="w-5 h-5 text-success shrink-0 mt-0.5" />
                <span className="text-foreground font-medium">Disponível até a conclusão da prova oficial</span>
              </div>
              <div className="flex items-start gap-3 p-3 bg-accent/10 rounded-lg border border-accent/20">
                <CheckCircle className="w-5 h-5 text-accent shrink-0 mt-0.5" />
                <div className="flex-1">
                  <span className="text-foreground font-bold block">Login: CPF</span>
                  <span className="text-foreground font-bold block">Senha: 6 primeiros dígitos do CPF</span>
                </div>
              </div>
            </div>
          </div>

          <form onSubmit={handleSubmit} className="space-y-4">
            <div className="space-y-2">
              <Label htmlFor="name">Nome Completo</Label>
              <Input
                id="name"
                name="name"
                placeholder="Seu nome"
                value={formData.name}
                onChange={handleChange}
                required
                className="bg-background"
              />
            </div>

            <div className="space-y-2">
              <Label htmlFor="email">E-mail</Label>
              <Input
                id="email"
                name="email"
                type="email"
                placeholder="seu@email.com"
                value={formData.email}
                onChange={handleChange}
                required
                className="bg-background"
              />
            </div>

            <div className="grid grid-cols-2 gap-4">
              <div className="space-y-2">
                <Label htmlFor="cpf">CPF</Label>
                <Input
                  id="cpf"
                  name="cpf"
                  placeholder="000.000.000-00"
                  value={formData.cpf}
                  onChange={handleChange}
                  required
                  maxLength={14}
                  className="bg-background"
                />
              </div>

              <div className="space-y-2">
                <Label htmlFor="phone">Celular</Label>
                <Input
                  id="phone"
                  name="phone"
                  placeholder="(00) 00000-0000"
                  value={formData.phone}
                  onChange={handleChange}
                  required
                  maxLength={15}
                  className="bg-background"
                />
              </div>
            </div>

            <div className="pt-4">
              <Button
                type="submit"
                variant="navy"
                size="lg"
                className="w-full relative overflow-hidden group"
                disabled={loading}
              >
                {loading ? (
                  <>
                    <Loader2 className="w-5 h-5 mr-2 animate-spin" />
                    Processando...
                  </>
                ) : (
                  <>
                    <CreditCard className="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" />
                    Ir para Pagamento Seguro
                  </>
                )}
              </Button>
            </div>
          </form>

          <div className="mt-6 flex items-center justify-center gap-2 text-xs text-muted-foreground">
            <ShieldCheck className="w-4 h-4 text-success" />
            <span>Pagamento processado via Mercado Pago</span>
          </div>

          <div className="mt-6 pt-6 border-t border-border text-center">
            <Link to="/" className="text-sm text-muted-foreground hover:text-foreground transition-colors">
              ← Voltar para home
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
};

export default PurchasePage;
