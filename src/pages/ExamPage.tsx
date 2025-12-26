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
        <div className="container mx-auto px-4 py-3">
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-3">
              <div className="w-8 h-8 rounded-lg gradient-navy flex items-center justify-center">
                <Anchor className="w-5 h-5 text-primary-foreground" />
              </div>
              <div>
                <h1 className="font-bold text-foreground">Simulado PROPOM 2026</h1>
                <p className="text-xs text-muted-foreground">
                  {question.subject === "portugues" ? "Português" : "Matemática"}
                </p>
              </div>
            </div>

            <div className="flex items-center gap-4">
              <div className={`flex items-center gap-2 px-4 py-2 rounded-lg ${isTimeWarning ? "bg-warning/10 text-warning" : "bg-muted text-foreground"}`}>
                <Clock className={`w-5 h-5 ${isTimeWarning ? "animate-pulse" : ""}`} />
                <span className="font-mono font-bold text-lg">{formatTime(timeLeft)}</span>
              </div>

              <Button variant="ghost" size="sm" onClick={handleLogout} className="text-muted-foreground hover:text-destructive">
                <LogOut className="w-5 h-5 mr-2" />
                Sair
              </Button>
            </div>
          </div>
        </div>
      </header>

      {/* Progress Bar */}
      <div className="fixed top-[69px] left-0 right-0 z-30 bg-card border-b border-border px-4 py-3">
        <div className="container mx-auto">
          <div className="flex items-center justify-between mb-2">
            <span className="text-sm text-muted-foreground">
              Questão {currentQuestion + 1} de {questions.length}
            </span>
            <span className="text-sm font-medium text-foreground">
              {answeredCount} respondidas
            </span>
          </div>
          <Progress value={progress} className="h-2" />
        </div>
      </div>

      {/* Question Content */}
      <main className="pt-36 pb-32 px-4">
        <div className="container mx-auto max-w-3xl">
          <div className="card-elevated p-6 md:p-8 animate-fade-in">
            <div className="flex items-center gap-2 mb-4">
              <span className={`px-3 py-1 rounded-full text-sm font-medium ${question.subject === "portugues"
                ? "bg-accent/10 text-accent"
                : "bg-success/10 text-success"
                }`}>
                {question.subject === "portugues" ? "Português" : "Matemática"}
              </span>
              <span className="text-sm text-muted-foreground">
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
            <p className="text-sm text-muted-foreground mb-3">Navegação rápida:</p>
            <div className="flex flex-wrap gap-2">
              {questions.map((_, index) => (
                <button
                  key={index}
                  onClick={() => setCurrentQuestion(index)}
                  className={`w-8 h-8 rounded-lg text-sm font-medium transition-all ${currentQuestion === index
                    ? "bg-accent text-accent-foreground"
                    : answers[index] !== null
                      ? "bg-success/20 text-success border border-success/30"
                      : "bg-muted text-muted-foreground hover:bg-muted/80"
                    }`}
                >
                  {index + 1}
                </button>
              ))}
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
