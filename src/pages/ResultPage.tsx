import { Link } from "react-router-dom";
import { Anchor, Trophy, XCircle, BarChart3, Home, RotateCcw } from "lucide-react";
import { Button } from "@/components/ui/button";
import { useApp } from "@/contexts/AppContext";
import WhatsAppButton from "@/components/WhatsAppButton";

const ResultPage = () => {
  const { examResult, setExamResult } = useApp();

  if (!examResult) {
    return (
      <div className="min-h-screen gradient-hero flex items-center justify-center p-4">
        <div className="card-elevated p-8 text-center">
          <p className="text-muted-foreground mb-4">Nenhum resultado encontrado.</p>
          <Link to="/aluno/prova">
            <Button variant="navy">Iniciar Simulado</Button>
          </Link>
        </div>
      </div>
    );
  }

  const { correctAnswers, totalQuestions, passed } = examResult;
  const percentage = Math.round((correctAnswers / totalQuestions) * 100);

  const handleRetry = () => {
    setExamResult(null);
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
            <div className="inline-flex items-center gap-3 mb-6">
              <div className="w-12 h-12 rounded-xl gradient-navy flex items-center justify-center">
                <Anchor className="w-7 h-7 text-primary-foreground" />
              </div>
            </div>

            {/* Result Icon */}
            <div className={`w-24 h-24 mx-auto mb-6 rounded-full flex items-center justify-center ${
              passed ? "bg-success/10" : "bg-destructive/10"
            }`}>
              {passed ? (
                <Trophy className="w-12 h-12 text-success" />
              ) : (
                <XCircle className="w-12 h-12 text-destructive" />
              )}
            </div>

            <h1 className={`text-3xl font-bold mb-2 ${
              passed ? "text-success" : "text-destructive"
            }`}>
              {passed ? "Aprovado!" : "Reprovado"}
            </h1>
            <p className="text-muted-foreground">
              {passed 
                ? "Parabéns! Você atingiu a pontuação mínima."
                : "Continue estudando e tente novamente."
              }
            </p>
          </div>

          {/* Stats */}
          <div className="bg-muted/50 rounded-xl p-6 mb-6">
            <div className="flex items-center justify-between mb-4">
              <div className="flex items-center gap-2">
                <BarChart3 className="w-5 h-5 text-accent" />
                <span className="font-medium text-foreground">Seu Desempenho</span>
              </div>
            </div>

            <div className="grid grid-cols-3 gap-4 text-center">
              <div>
                <p className="text-3xl font-bold text-foreground">{correctAnswers}</p>
                <p className="text-sm text-muted-foreground">Acertos</p>
              </div>
              <div>
                <p className="text-3xl font-bold text-foreground">{totalQuestions - correctAnswers}</p>
                <p className="text-sm text-muted-foreground">Erros</p>
              </div>
              <div>
                <p className="text-3xl font-bold text-foreground">{percentage}%</p>
                <p className="text-sm text-muted-foreground">Aproveitamento</p>
              </div>
            </div>

            {/* Progress Bar */}
            <div className="mt-6">
              <div className="flex justify-between text-sm mb-2">
                <span className="text-muted-foreground">Mínimo para aprovação: 31 acertos</span>
                <span className={passed ? "text-success" : "text-destructive"}>
                  {correctAnswers}/40
                </span>
              </div>
              <div className="h-3 bg-muted rounded-full overflow-hidden">
                <div 
                  className={`h-full transition-all duration-1000 ${
                    passed ? "bg-success" : "bg-destructive"
                  }`}
                  style={{ width: `${percentage}%` }}
                />
              </div>
              <div className="relative mt-1">
                <div 
                  className="absolute top-0 w-0.5 h-3 bg-foreground/30"
                  style={{ left: "77.5%" }}
                />
                <span 
                  className="absolute text-xs text-muted-foreground"
                  style={{ left: "77.5%", transform: "translateX(-50%)", top: "12px" }}
                >
                  31
                </span>
              </div>
            </div>
          </div>

          {/* Performance Message */}
          <div className={`p-4 rounded-xl mb-6 ${
            passed ? "bg-success/10 border border-success/20" : "bg-destructive/10 border border-destructive/20"
          }`}>
            <p className={`text-sm ${passed ? "text-success" : "text-destructive"}`}>
              {percentage >= 90 && "Excelente! Você está muito bem preparado!"}
              {percentage >= 77.5 && percentage < 90 && "Muito bom! Continue assim para a prova real."}
              {percentage >= 60 && percentage < 77.5 && "Você precisa melhorar um pouco mais. Estude os pontos fracos."}
              {percentage < 60 && "Dedique mais tempo aos estudos. Revise todo o conteúdo."}
            </p>
          </div>

          {/* Actions */}
          <div className="space-y-3">
            <Link to="/aluno/prova" onClick={handleRetry}>
              <Button variant="navy" size="lg" className="w-full">
                <RotateCcw className="w-5 h-5 mr-2" />
                Tentar Novamente
              </Button>
            </Link>
            <Link to="/">
              <Button variant="outline" size="lg" className="w-full">
                <Home className="w-5 h-5 mr-2" />
                Voltar ao Início
              </Button>
            </Link>
          </div>
        </div>
      </div>

      <WhatsAppButton />
    </div>
  );
};

export default ResultPage;
