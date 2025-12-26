import { useState, useEffect, useCallback } from "react";
import { useNavigate, useSearchParams } from "react-router-dom";
import { Clock, ChevronLeft, ChevronRight, AlertTriangle, CheckCircle, Anchor, LogOut, Lightbulb, BookOpen } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Progress } from "@/components/ui/progress";
import { useApp } from "@/contexts/AppContext";
import { api } from "@/lib/api";
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

interface Question {
  id: number;
  subject: "portugues" | "matematica";
  base_text?: string;
  text: string;
  options: string[];
  hint?: string;
}

const EXAM_TIME = 180 * 60; // 180 minutes in seconds (3 hours)

const ExamPage = () => {
  const navigate = useNavigate();
  const [searchParams] = useSearchParams();
  const blockId = searchParams.get("block") || "1";
  const { setExamResult, logout } = useApp();

  const [showLogoutDialog, setShowLogoutDialog] = useState(false);

  const handleLogout = () => {
    setShowLogoutDialog(true);
  };

  const confirmLogout = () => {
    logout();
    navigate("/");
  };

  const [questions, setQuestions] = useState<Question[]>([]);
  const [currentQuestion, setCurrentQuestion] = useState(0);
  const [answers, setAnswers] = useState<(number | null)[]>([]);
  const [timeLeft, setTimeLeft] = useState(EXAM_TIME);
  const [showFinishDialog, setShowFinishDialog] = useState(false);
  const [isTimeWarning, setIsTimeWarning] = useState(false);
  const [isLoading, setIsLoading] = useState(true);
  const [showHint, setShowHint] = useState(false);

  useEffect(() => {
    const fetchQuestions = async () => {
      try {
        const timestamp = new Date().getTime();
        const data = await api.get(`/questions?block=${blockId}&t=${timestamp}`);
        setQuestions(data);
        setAnswers(new Array(data.length).fill(null));
      } catch (error) {
        console.error("Error fetching questions:", error);
      } finally {
        setIsLoading(false);
      }
    };
    fetchQuestions();
  }, [blockId]);

  const formatTime = (seconds: number) => {
    const hours = Math.floor(seconds / 3600);
    const mins = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;
    return `${hours.toString().padStart(2, "0")}:${mins.toString().padStart(2, "0")}:${secs.toString().padStart(2, "0")}`;
  };

  const finishExam = useCallback(async () => {
    try {
      const formattedAnswers = questions.map((q, index) => ({
        question_id: q.id,
        answer: answers[index]
      }));

      const response = await api.post("/exam/submit", {
        block: parseInt(blockId),
        answers: formattedAnswers
      });

      setExamResult({
        totalQuestions: response.total_questions,
        correctAnswers: response.score,
        passed: response.passed,
        completedAt: new Date(response.attempt.completed_at),
      });

      // Passamos os resultados detalhados (com justificativas) via state do Router
      navigate("/aluno/resultado", { state: { details: response.results } });
    } catch (error) {
      console.error("Error submitting exam:", error);
    }
  }, [answers, navigate, setExamResult, blockId]);

  const handleNext = () => {
    if (currentQuestion < questions.length - 1) {
      setCurrentQuestion(currentQuestion + 1);
      setShowHint(false);
    } else {
      setShowFinishDialog(true);
    }
  };

  const handlePrevious = () => {
    if (currentQuestion > 0) {
      setCurrentQuestion(currentQuestion - 1);
      setShowHint(false);
    }
  };

  useEffect(() => {
    const timer = setInterval(() => {
      setTimeLeft((prev) => {
        if (prev <= 1) {
          clearInterval(timer);
          finishExam();
          return 0;
        }
        if (prev === 600) {
          setIsTimeWarning(true);
        }
        return prev - 1;
      });
    }, 1000);

    return () => clearInterval(timer);
  }, [finishExam]);

  const handleAnswer = (optionIndex: number) => {
    const newAnswers = [...answers];
    if (newAnswers[currentQuestion] === optionIndex) {
      newAnswers[currentQuestion] = null; // Desmarcar
    } else {
      newAnswers[currentQuestion] = optionIndex;
    }
    setAnswers(newAnswers);
  };

  if (isLoading) {
    return (
      <div className="min-h-screen flex items-center justify-center bg-background">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-navy"></div>
      </div>
    );
  }

  if (questions.length === 0) {
    return (
      <div className="min-h-screen flex items-center justify-center bg-background">
        <div className="text-center">
          <h2 className="text-xl font-bold">Nenhuma questão encontrada</h2>
          <Button onClick={() => navigate("/")} className="mt-4">Voltar</Button>
        </div>
      </div>
    );
  }

  const answeredCount = answers.filter((a) => a !== null).length;
  const progress = (answeredCount / questions.length) * 100;
  const question = questions[currentQuestion];

  return (
    <div className="min-h-screen bg-background">
      {/* Header */}
      <header className="fixed top-0 left-0 right-0 z-40 bg-card border-b border-border shadow-sm">
        <div className="container mx-auto px-4 py-2 md:py-3">
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-2 md:gap-3">
              <div className="w-8 h-8 rounded-lg gradient-navy flex items-center justify-center shrink-0">
                <Anchor className="w-5 h-5 text-primary-foreground" />
              </div>
              <div className="min-w-0">
                <h1 className="font-bold text-foreground truncate hidden sm:block">Simulado PROPOM 2026</h1>
                <h1 className="font-bold text-foreground truncate text-sm sm:hidden">PROPOM</h1>
                <p className="text-[10px] md:text-xs text-muted-foreground">
                  {question.subject === "portugues" ? "Português" : "Matemática"}
                </p>
              </div>
            </div>

            <div className="flex items-center gap-2 md:gap-4">
              <div className={`flex items-center gap-1.5 md:gap-2 px-2 md:px-4 py-1.5 md:py-2 rounded-lg ${isTimeWarning ? "bg-warning/10 text-warning" : "bg-muted text-foreground"}`}>
                <Clock className={`w-4 h-4 md:w-5 md:h-5 ${isTimeWarning ? "animate-pulse" : ""}`} />
                <span className="font-mono font-bold text-base md:text-lg">{formatTime(timeLeft)}</span>
              </div>

              <Button variant="ghost" size="sm" onClick={handleLogout} className="text-muted-foreground hover:text-destructive px-2 md:px-3">
                <LogOut className="w-4 h-4 md:w-5 md:h-5 md:mr-2" />
                <span className="hidden md:inline">Sair</span>
              </Button>
            </div>
          </div>
        </div>
      </header>

      {/* Progress Bar */}
      <div className="fixed top-[53px] md:top-[69px] left-0 right-0 z-30 bg-card border-b border-border px-4 py-2 md:py-3">
        <div className="container mx-auto">
          <div className="flex items-center justify-between mb-1 md:mb-2 text-[10px] md:text-sm">
            <span className="text-muted-foreground">
              Questão {currentQuestion + 1}/{questions.length}
            </span>
            <span className="font-medium text-foreground">
              {answeredCount} respondidas
            </span>
          </div>
          <Progress value={progress} className="h-1.5 md:h-2" />
        </div>
      </div>

      {/* Question Content */}
      <main className="pt-28 md:pt-36 pb-32 px-4">
        <div className="container mx-auto max-w-3xl">
          <div className="card-elevated p-5 md:p-8 animate-fade-in">
            <div className="flex items-center gap-2 mb-3 md:mb-4">
              <span className={`px-2 py-0.5 rounded-full text-[10px] md:text-sm font-medium ${question.subject === "portugues"
                ? "bg-accent/10 text-accent"
                : "bg-success/10 text-success"
                }`}>
                {question.subject === "portugues" ? "Português" : "Matemática"}
              </span>
              <span className="text-[10px] md:text-sm text-muted-foreground">
                Questão {currentQuestion + 1}
              </span>
            </div>

            {question && question.base_text && question.base_text.trim().length > 0 && (
              <div className="mb-8 p-6 bg-accent/5 rounded-xl border border-accent/20 shadow-sm">
                <div className="flex items-center gap-2 mb-4">
                  <BookOpen className="w-4 h-4 text-accent" />
                  <span className="text-xs font-bold text-accent uppercase tracking-widest">Texto de Interpretação</span>
                </div>
                <div className="text-sm md:text-base text-foreground leading-relaxed whitespace-pre-wrap font-serif italic opacity-90 border-l-4 border-accent/20 pl-4">
                  {question.base_text}
                </div>
              </div>
            )}

            <div className="flex items-center justify-between mb-8">
              <h2 className="text-xl md:text-2xl font-semibold text-foreground leading-relaxed">
                {question.text}
              </h2>
              {question.hint && (
                <Button
                  variant="ghost"
                  size="sm"
                  onClick={() => setShowHint(!showHint)}
                  className={`ml-4 ${showHint ? "text-accent bg-accent/10" : "text-muted-foreground"}`}
                  title="Ver dica"
                >
                  <Lightbulb className={`w-6 h-6 ${showHint ? "fill-accent" : ""}`} />
                </Button>
              )}
            </div>

            {showHint && question.hint && (
              <div className="mb-6 p-4 bg-accent/5 border border-accent/20 rounded-xl animate-scale-in">
                <p className="text-sm text-accent flex items-start gap-2">
                  <Lightbulb className="w-4 h-4 mt-0.5 shrink-0" />
                  <span><strong>Dica:</strong> {question.hint}</span>
                </p>
              </div>
            )}

            <div className="space-y-3">
              {question.options.map((option, index) => (
                <button
                  key={index}
                  onClick={() => handleAnswer(index)}
                  className={`w-full text-left p-4 rounded-xl border-2 transition-all duration-200 ${answers[currentQuestion] === index
                    ? "border-accent bg-accent/10 text-foreground"
                    : "border-border bg-card hover:border-accent/50 hover:bg-muted/50 text-foreground"
                    }`}
                >
                  <div className="flex items-center gap-4">
                    <div className={`w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold ${answers[currentQuestion] === index
                      ? "bg-accent text-accent-foreground"
                      : "bg-muted text-muted-foreground"
                      }`}>
                      {String.fromCharCode(65 + index)}
                    </div>
                    <span className="flex-1">{option}</span>
                    {answers[currentQuestion] === index && (
                      <CheckCircle className="w-5 h-5 text-accent" />
                    )}
                  </div>
                </button>
              ))}
            </div>
          </div>

          {/* Question Navigator */}
          <div className="mt-6 card-navy p-4">
            <div className="flex items-center justify-between mb-4">
              <p className="text-sm text-muted-foreground">Navegação rápida:</p>
              <div className="flex gap-4">
                <div className="flex items-center gap-1.5">
                  <div className="w-2 h-2 rounded-full bg-accent"></div>
                  <span className="text-[10px] text-muted-foreground uppercase font-bold tracking-wider">Português</span>
                </div>
                <div className="flex items-center gap-1.5">
                  <div className="w-2 h-2 rounded-full bg-success"></div>
                  <span className="text-[10px] text-muted-foreground uppercase font-bold tracking-wider">Matemática</span>
                </div>
              </div>
            </div>

            <div className="flex flex-wrap gap-2">
              {questions.map((q, index) => {
                const isCurrent = currentQuestion === index;
                const isAnswered = answers[index] !== null;
                const isMath = q.subject === "matematica";

                return (
                  <button
                    key={index}
                    onClick={() => setCurrentQuestion(index)}
                    className={`w-9 h-9 rounded-lg text-xs font-bold transition-all border-2 relative ${isCurrent
                      ? "bg-foreground text-background scale-110 shadow-lg z-10 border-foreground"
                      : isAnswered
                        ? isMath
                          ? "bg-success text-success-foreground border-success"
                          : "bg-accent text-accent-foreground border-accent"
                        : isMath
                          ? "bg-success/10 text-success border-success/40 hover:border-success hover:bg-success/20"
                          : "bg-accent/10 text-accent border-accent/30 hover:border-accent hover:bg-accent/20"
                      }`}
                  >
                    {index + 1}
                    {!isAnswered && !isCurrent && (
                      <div className={`absolute -top-1 -right-1 w-2 h-2 rounded-full ${isMath ? "bg-success/40" : "bg-accent/40"}`} />
                    )}
                  </button>
                );
              })}
            </div>
          </div>
        </div>
      </main>

      {/* Bottom Navigation */}
      <footer className="fixed bottom-0 left-0 right-0 bg-card border-t border-border shadow-elevated z-30">
        <div className="container mx-auto px-4 py-4">
          <div className="flex items-center justify-between">
            <Button
              variant="outline"
              onClick={handlePrevious}
              disabled={currentQuestion === 0}
            >
              <ChevronLeft className="w-5 h-5 mr-1" />
              Anterior
            </Button>

            <Button
              variant="navy"
              onClick={() => setShowFinishDialog(true)}
              className="hidden md:flex"
            >
              Finalizar Prova
            </Button>

            <Button
              variant={currentQuestion === questions.length - 1 ? "navy" : "outline"}
              onClick={handleNext}
            >
              {currentQuestion === questions.length - 1 ? "Finalizar" : "Próxima"}
              <ChevronRight className="w-5 h-5 ml-1" />
            </Button>
          </div>
        </div>
      </footer>

      {/* Finish Confirmation Dialog */}
      <AlertDialog open={showFinishDialog} onOpenChange={setShowFinishDialog}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle>Finalizar Prova?</AlertDialogTitle>
            <AlertDialogDescription>
              Você respondeu {answeredCount} de {questions.length} questões.
              {answeredCount < questions.length && (
                <span className="block mt-2 text-warning">
                  Atenção: {questions.length - answeredCount} questões ainda não foram respondidas.
                </span>
              )}
              <span className="block mt-2">
                Deseja realmente finalizar a prova?
              </span>
            </AlertDialogDescription>
          </AlertDialogHeader>
          <AlertDialogFooter>
            <AlertDialogCancel>Continuar Prova</AlertDialogCancel>
            <AlertDialogAction onClick={finishExam}>
              Confirmar e Finalizar
            </AlertDialogAction>
          </AlertDialogFooter>
        </AlertDialogContent>
      </AlertDialog>

      {/* Logout Confirmation Dialog */}
      <AlertDialog open={showLogoutDialog} onOpenChange={setShowLogoutDialog}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle>Deseja realmente sair?</AlertDialogTitle>
            <AlertDialogDescription>
              Seu progresso nesta prova será perdido e você será desconectado.
            </AlertDialogDescription>
          </AlertDialogHeader>
          <AlertDialogFooter>
            <AlertDialogCancel>Continuar Prova</AlertDialogCancel>
            <AlertDialogAction onClick={confirmLogout} className="bg-destructive text-destructive-foreground hover:bg-destructive/90">
              Confirmar e Sair
            </AlertDialogAction>
          </AlertDialogFooter>
        </AlertDialogContent>
      </AlertDialog>
    </div>
  );
};

export default ExamPage;
