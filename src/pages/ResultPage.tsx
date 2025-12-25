import { useState } from "react";
import { Link, useNavigate, useLocation } from "react-router-dom";
import { Anchor, Trophy, XCircle, BarChart3, Home, RotateCcw, LogOut, CheckCircle2, ChevronDown, ChevronUp, AlertCircle, CheckCircle } from "lucide-react";
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

interface Detail {
  question_id: number;
  user_answer: number | null;
  correct_answer: number;
  is_correct: boolean;
  rationale: string;
}

const ResultPage = () => {
  const navigate = useNavigate();
  const location = useLocation();
  const details = (location.state as { details?: Detail[] })?.details;
  const { examResult, setExamResult, logout } = useApp();
  const [showLogoutDialog, setShowLogoutDialog] = useState(false);
  const [showDetails, setShowDetails] = useState(false);

  const handleLogout = () => {
    setShowLogoutDialog(true);
  };

  const confirmLogout = () => {
    logout();
    navigate("/");
  };

  if (!examResult) {
    return (
      <div className="min-h-screen gradient-hero flex items-center justify-center p-4">
        <div className="card-elevated p-8 text-center">
          <p className="text-muted-foreground mb-4">Nenhum resultado encontrado.</p>
          <Link to="/aluno/dashboard">
            <Button variant="navy">Voltar ao Painel</Button>
          </Link>
        </div>
      </div>
    );
  }

  const { correctAnswers, totalQuestions, passed } = examResult;
  const percentage = Math.round((correctAnswers / totalQuestions) * 100);

  return (
    <div className="min-h-screen bg-background flex flex-col items-center py-12 px-4 overflow-y-auto">
      <div className="absolute inset-0 opacity-10 pointer-events-none overflow-hidden">
        <div className="absolute top-20 left-10 w-64 h-64 rounded-full bg-accent blur-3xl" />
        <div className="absolute bottom-20 right-10 w-96 h-96 rounded-full bg-secondary blur-3xl" />
      </div>

      <div className="w-full max-w-2xl relative z-10 space-y-6">
        <div className="card-elevated p-8 animate-scale-in">
          <div className="text-center mb-8">
            <div className="flex items-center justify-between mb-6">
              <div className="w-12 h-12 rounded-xl gradient-navy flex items-center justify-center">
                <Anchor className="w-7 h-7 text-primary-foreground" />
              </div>
              <Button variant="ghost" size="sm" onClick={handleLogout} className="text-muted-foreground hover:text-destructive">
                <LogOut className="w-5 h-5 mr-2" />
                Sair
              </Button>
            </div>

            {/* Result Icon */}
            <div className={`w-24 h-24 mx-auto mb-6 rounded-full flex items-center justify-center ${passed ? "bg-success/10" : "bg-destructive/10"
              }`}>
              {passed ? (
                <Trophy className="w-12 h-12 text-success" />
              ) : (
                <XCircle className="w-12 h-12 text-destructive" />
              )}
            </div>

            <h1 className={`text-3xl font-bold mb-2 ${passed ? "text-success" : "text-destructive"
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
          <div className="bg-muted/50 rounded-xl p-6 mb-8">
            <div className="flex items-center justify-between mb-4">
              <div className="flex items-center gap-2">
                <BarChart3 className="w-5 h-5 text-accent" />
                <span className="font-medium text-foreground">Resumo do Simulado</span>
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
                <span className="text-muted-foreground">Mínimo para aprovação: 77.5%</span>
                <span className={passed ? "text-success" : "text-destructive"}>
                  {correctAnswers}/{totalQuestions}
                </span>
              </div>
              <div className="h-3 bg-muted rounded-full overflow-hidden">
                <div
                  className={`h-full transition-all duration-1000 ${passed ? "bg-success" : "bg-destructive"
                    }`}
                  style={{ width: `${percentage}%` }}
                />
              </div>
            </div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <Link to="/aluno/dashboard" className="w-full">
              <Button variant="outline" className="w-full h-12">
                <Home className="w-5 h-5 mr-2" />
                Ir para o Painel
              </Button>
            </Link>
            <Button
              variant="navy"
              className="w-full h-12 shadow-glow"
              onClick={() => setShowDetails(!showDetails)}
            >
              <BarChart3 className="w-5 h-5 mr-2" />
              {showDetails ? "Ocultar Revisão" : "Ver Revisão Detalhada"}
              {showDetails ? <ChevronUp className="ml-2 w-4 h-4" /> : <ChevronDown className="ml-2 w-4 h-4" />}
            </Button>
          </div>
        </div>

        {/* Detailed Review Section */}
        {showDetails && details && (
          <div className="space-y-4 animate-in fade-in slide-in-from-top-4 duration-500">
            <h3 className="text-xl font-bold text-foreground flex items-center gap-2 px-2">
              <CheckCircle2 className="w-6 h-6 text-accent" />
              Justificativas por Questão
            </h3>
            <div className="space-y-4">
              {details.map((item, index) => (
                <div
                  key={index}
                  className={`card-elevated overflow-hidden border-l-4 ${item.is_correct ? "border-success" : "border-destructive"}`}
                >
                  <div className="p-5">
                    <div className="flex items-start justify-between gap-4 mb-3">
                      <div className="flex items-center gap-3">
                        <span className="font-bold text-lg text-muted-foreground">#{index + 1}</span>
                        {item.is_correct ? (
                          <div className="flex items-center gap-1.5 text-success text-sm font-bold bg-success/10 px-2 py-0.5 rounded-md">
                            <CheckCircle className="w-4 h-4" />
                            ACERTO
                          </div>
                        ) : (
                          <div className="flex items-center gap-1.5 text-destructive text-sm font-bold bg-destructive/10 px-2 py-0.5 rounded-md">
                            <AlertCircle className="w-4 h-4" />
                            ERRO
                          </div>
                        )}
                      </div>
                    </div>

                    <div className="space-y-3">
                      <div className="flex gap-2 text-sm">
                        <span className="text-muted-foreground font-medium shrink-0">Sua resposta:</span>
                        <span className={item.is_correct ? "text-success font-bold" : "text-destructive font-bold"}>
                          {item.user_answer !== null ? String.fromCharCode(65 + item.user_answer) : "Não respondida"}
                        </span>
                      </div>

                      {!item.is_correct && (
                        <div className="flex gap-2 text-sm">
                          <span className="text-muted-foreground font-medium shrink-0">Resposta correta:</span>
                          <span className="text-success font-bold">
                            {String.fromCharCode(65 + item.correct_answer)}
                          </span>
                        </div>
                      )}

                      <div className="mt-4 p-4 bg-muted/40 rounded-xl border border-border">
                        <h4 className="text-xs font-bold text-muted-foreground uppercase tracking-wider mb-2">Justificativa Acadêmica:</h4>
                        <p className="text-sm text-foreground leading-relaxed italic">
                          "{item.rationale || "Nenhuma explicação disponível para esta questão."}"
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        )}
      </div>

      {/* Logout Confirmation Dialog */}
      <AlertDialog open={showLogoutDialog} onOpenChange={setShowLogoutDialog}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle>Deseja realmente sair?</AlertDialogTitle>
            <AlertDialogDescription>
              Sua sessão será encerrada.
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

export default ResultPage;
