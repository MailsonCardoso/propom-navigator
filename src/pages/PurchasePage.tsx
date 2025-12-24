import { Link } from "react-router-dom";
import { Anchor, CreditCard, CheckCircle, ShieldCheck } from "lucide-react";
import { Button } from "@/components/ui/button";
import WhatsAppButton from "@/components/WhatsAppButton";

const PurchasePage = () => {
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
            <p className="text-muted-foreground">Complete sua compra para acessar os simulados</p>
          </div>

          <div className="bg-muted/50 rounded-xl p-6 mb-6">
            <div className="flex items-center justify-between mb-4">
              <span className="text-foreground font-medium">Simulados PROPOM 2026</span>
              <span className="text-2xl font-bold text-foreground">R$ 35,00</span>
            </div>
            <div className="space-y-2">
              <div className="flex items-center gap-2 text-sm text-muted-foreground">
                <CheckCircle className="w-4 h-4 text-success" />
                <span>Acesso ilimitado aos simulados</span>
              </div>
              <div className="flex items-center gap-2 text-sm text-muted-foreground">
                <CheckCircle className="w-4 h-4 text-success" />
                <span>40 questões por prova</span>
              </div>
              <div className="flex items-center gap-2 text-sm text-muted-foreground">
                <CheckCircle className="w-4 h-4 text-success" />
                <span>Cronômetro oficial de 90 minutos</span>
              </div>
              <div className="flex items-center gap-2 text-sm text-muted-foreground">
                <CheckCircle className="w-4 h-4 text-success" />
                <span>Português e Matemática</span>
              </div>
              <div className="flex items-center gap-2 text-sm text-muted-foreground">
                <CheckCircle className="w-4 h-4 text-success" />
                <span>Resultado imediato com análise</span>
              </div>
            </div>
          </div>

          <div className="space-y-4">
            <Link to="/login">
              <Button variant="navy" size="lg" className="w-full">
                <CreditCard className="w-5 h-5 mr-2" />
                Confirmar Compra
              </Button>
            </Link>

            <div className="flex items-center justify-center gap-2 text-sm text-muted-foreground">
              <ShieldCheck className="w-4 h-4 text-success" />
              <span>Pagamento 100% seguro</span>
            </div>
          </div>

          <div className="mt-6 pt-6 border-t border-border text-center">
            <Link to="/" className="text-sm text-muted-foreground hover:text-foreground transition-colors">
              ← Voltar ao início
            </Link>
          </div>
        </div>
      </div>

      <WhatsAppButton />
    </div>
  );
};

export default PurchasePage;
