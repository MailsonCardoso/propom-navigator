import { useState } from "react";
import { Link } from "react-router-dom";
import { Anchor, CheckCircle, ShieldCheck, QrCode, Copy, Check } from "lucide-react";
import { Button } from "@/components/ui/button";
import { QRCodeSVG } from "qrcode.react";
import { toast } from "sonner";

const PurchasePage = () => {
  const [showPix, setShowPix] = useState(false);
  const [copied, setCopied] = useState(false);
  const pixKey = "00020126360014BR.GOV.BCB.PIX0114+5598988221217520400005303986540535.005802BR5921Mailson Costa Cardoso6009SAO PAULO62140510cyo6U9Q9FI63049E70";

  const handleCopyPix = () => {
    navigator.clipboard.writeText(pixKey);
    setCopied(true);
    toast.success("Chave PIX copiada!");
    setTimeout(() => setCopied(false), 2000);
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
            <p className="text-muted-foreground text-sm">Acesso vitalício aos simulados PROPOM 2026</p>
          </div>

          {!showPix ? (
            <>
              <div className="bg-muted/50 rounded-xl p-6 mb-6">
                <div className="flex items-center justify-between mb-4">
                  <span className="text-foreground font-medium">Plano Completo</span>
                  <span className="text-2xl font-bold text-foreground">R$ 35,00</span>
                </div>
                <div className="space-y-2">
                  <div className="flex items-center gap-2 text-sm text-muted-foreground">
                    <CheckCircle className="w-4 h-4 text-success" />
                    <span>Acesso a todos os blocos de simulados</span>
                  </div>
                  <div className="flex items-center gap-2 text-sm text-muted-foreground">
                    <CheckCircle className="w-4 h-4 text-success" />
                    <span>Cronômetro oficial de 180 minutos</span>
                  </div>
                  <div className="flex items-center gap-2 text-sm text-muted-foreground">
                    <CheckCircle className="w-4 h-4 text-success" />
                    <span>Dicas de Ouro e Racionais Acadêmicos</span>
                  </div>
                  <div className="flex items-center gap-2 text-sm text-muted-foreground">
                    <CheckCircle className="w-4 h-4 text-success" />
                    <span>Ranking e Estatísticas de desempenho</span>
                  </div>
                </div>
              </div>

              <div className="space-y-4">
                <Button variant="navy" size="lg" className="w-full" onClick={() => setShowPix(true)}>
                  <QrCode className="w-5 h-5 mr-2" />
                  Pagar com PIX
                </Button>

                <div className="flex items-center justify-center gap-2 text-sm text-muted-foreground">
                  <ShieldCheck className="w-4 h-4 text-success" />
                  <span>Liberação imediata após envio do comprovante</span>
                </div>
              </div>
            </>
          ) : (
            <div className="space-y-6 animate-fade-in text-center">
              <div className="bg-white p-4 rounded-xl inline-block mx-auto border-2 border-muted shadow-sm">
                <QRCodeSVG value={pixKey} size={200} />
              </div>

              <div className="space-y-2">
                <p className="text-sm font-medium text-foreground">Pix Copia e Cola</p>
                <div className="flex items-center gap-2">
                  <div className="bg-muted p-2 rounded-lg text-[10px] text-left break-all font-mono border border-border flex-1 max-h-16 overflow-hidden">
                    {pixKey}
                  </div>
                  <Button variant="outline" size="icon" onClick={handleCopyPix} className="shrink-0">
                    {copied ? <Check className="w-4 h-4 text-success" /> : <Copy className="w-4 h-4" />}
                  </Button>
                </div>
              </div>

              <div className="bg-accent/10 p-4 rounded-xl border border-accent/20">
                <p className="text-xs text-foreground font-medium mb-3">
                  Após o pagamento, envie o comprovante no WhatsApp para liberar seu acesso.
                </p>
                <a
                  href={`https://wa.me/5598988221217?text=Ol%C3%A1%2C%20acabei%20de%20fazer%20o%20pagamento%20do%20simulado%20PROPOM%202026.%20Segue%20o%20comprovante.`}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="w-full inline-flex items-center justify-center h-10 px-4 py-2 bg-[#25D366] text-white rounded-md font-medium hover:bg-[#128C7E] transition-colors"
                >
                  Enviar Comprovante
                </a>
              </div>

              <Button variant="ghost" size="sm" onClick={() => setShowPix(false)} className="text-muted-foreground text-xs">
                Voltar
              </Button>
            </div>
          )}

          <div className="mt-6 pt-6 border-t border-border text-center">
            <Link to="/" className="text-sm text-muted-foreground hover:text-foreground transition-colors">
              ← Sair da página
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
};

export default PurchasePage;
