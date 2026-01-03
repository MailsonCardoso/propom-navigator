import { useState, useEffect, useCallback } from "react";
import { useNavigate } from "react-router-dom";
import { Clock, ChevronLeft, ChevronRight, CheckCircle, Anchor, LogOut, Lightbulb, BookOpen } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Progress } from "@/components/ui/progress";
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
  correct_answer: number;
  rationale: string;
}

const DEMO_TIME = 20 * 60; // 20 minutes for demo

const DemoExamPage = () => {
  const navigate = useNavigate();
  const [questions, setQuestions] = useState<Question[]>([]);
  const [currentQuestion, setCurrentQuestion] = useState(0);
  const [answers, setAnswers] = useState<(number | null)[]>([]);
  const [timeLeft, setTimeLeft] = useState(DEMO_TIME);
  const [showFinishDialog, setShowFinishDialog] = useState(false);
  const [isTimeWarning, setIsTimeWarning] = useState(false);
  const [isLoading, setIsLoading] = useState(true);
  const [showHint, setShowHint] = useState(false);

  useEffect(() => {
    const fetchQuestions = async () => {
      try {
        const data = await api.get("/questions/demo");
        setQuestions(data);
        setAnswers(new Array(data.length).fill(null));
      } catch (error) {
        console.error("Error fetching demo questions:", error);
      } finally {
        setIsLoading(false);
      }
    };
    fetchQuestions();
  }, []);

  const formatTime = (seconds: number) => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins.toString().padStart(2, "0")}:${secs.toString().padStart(2, "0")}`;
  };

  const finishExam = useCallback(() => {
    const results = questions.map((q, index) => ({
      question_id: q.id,
      subject: q.subject,
      text: q.text,
      base_text: q.base_text,
      options: q.options,
      correct_answer: q.correct_answer,
      user_answer: answers[index],
      is_correct: answers[index] === q.correct_answer,
      rationale: q.rationale
    }));

    const score = results.filter(r => r.is_correct).length;

    navigate("/demo/resultado", {
      state: {
        score,
        total: questions.length,
        results
      }
    });
  }, [answers, navigate, questions]);

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
        if (prev === 300) { // 5 minutes warning
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
      newAnswers[currentQuestion] = null;
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

  const answeredCount = answers.filter((a) => a !== null).length;
  const progress = (answeredCount / questions.length) * 100;
  const question = questions[currentQuestion];

  return (
    <div className="min-h-screen bg-background pb-24">
      <header className="fixed top-0 left-0 right-0 z-40 bg-card border-b border-border shadow-sm">
        <div className="container mx-auto px-4 py-2 md:py-3 text-center relative">
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-2">
              <div className="w-8 h-8 rounded-lg gradient-navy flex items-center justify-center">
                <Anchor className="w-5 h-5 text-primary-foreground" />
              </div>
              <div className="text-left">
                <h1 className="font-bold text-foreground text-sm md:text-base">Teste Grátis PREPOM</h1>
                <p className="text-[10px] text-muted-foreground">Demonstração de 20 questões</p>
              </div>
            </div>

            <div className="flex items-center gap-3">
              <div className={`flex items-center gap-1.5 px-3 py-1.5 rounded-lg ${isTimeWarning ? "bg-warning/10 text-warning" : "bg-muted text-foreground"}`}>
                <Clock className={`w-4 h-4 ${isTimeWarning ? "animate-pulse" : ""}`} />
                <span className="font-mono font-bold text-sm md:text-base">{formatTime(timeLeft)}</span>
              </div>
              <Button variant="ghost" size="sm" onClick={() => navigate("/")} className="text-muted-foreground hover:text-destructive">
                <LogOut className="w-4 h-4 mr-2" />
                <span className="hidden sm:inline">Sair</span>
              </Button>
            </div>
          </div>
        </div>
        <div className="h-1 w-full bg-muted">
          <div
            className="h-full bg-accent transition-all duration-300"
            style={{ width: `${progress}%` }}
          />
        </div>
      </header>

      <main className="pt-20 md:pt-24 px-4 container mx-auto max-w-3xl">
        <div className="card-elevated p-6 md:p-8 animate-fade-in mb-6">
          <div className="flex items-center gap-2 mb-6">
            <span className={`px-2 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider ${question.subject === "portugues" ? "bg-accent/10 text-accent" : "bg-success/10 text-success"}`}>
              {question.subject === "portugues" ? "Português" : "Matemática"}
            </span>
            <span className="text-xs text-muted-foreground font-medium">Questão {currentQuestion + 1} de {questions.length}</span>
          </div>

          {question.base_text && (
            <div className={`mb-8 p-6 bg-${question.subject === 'portugues' ? 'accent' : 'success'}/5 rounded-xl border border-${question.subject === 'portugues' ? 'accent' : 'success'}/20 italic text-sm md:text-base leading-relaxed font-serif relative`}>
              <div className={`absolute top-0 left-6 -translate-y-1/2 bg-background px-2 text-[10px] font-bold text-${question.subject === 'portugues' ? 'accent' : 'success'} uppercase tracking-widest border border-${question.subject === 'portugues' ? 'accent' : 'success'}/20 rounded`}>Texto Base</div>
              {question.base_text}
            </div>
          )}

          <h2 className="text-xl md:text-2xl font-bold text-foreground mb-8 leading-tight">
            {question.text}
          </h2>

          <div className="space-y-3">
            {question.options.map((option, index) => (
              <button
                key={index}
                onClick={() => handleAnswer(index)}
                className={`w-full text-left p-4 rounded-xl border-2 transition-all duration-200 flex items-center gap-4 ${answers[currentQuestion] === index
                  ? question.subject === 'portugues'
                    ? "border-accent bg-accent/10 shadow-sm"
                    : "border-success bg-success/10 shadow-sm"
                  : "border-border bg-card hover:border-accent/40 hover:bg-muted/50"
                  }`}
              >
                <div className={`w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold shrink-0 ${answers[currentQuestion] === index
                  ? question.subject === 'portugues' ? "bg-accent text-white" : "bg-success text-white"
                  : "bg-muted text-muted-foreground"
                  }`}>
                  {String.fromCharCode(65 + index)}
                </div>
                <span className="flex-1 font-medium">{option}</span>
                {answers[currentQuestion] === index && <CheckCircle className={`w-5 h-5 text-${question.subject === 'portugues' ? 'accent' : 'success'}`} />}
              </button>
            ))}
          </div>
        </div>

        <div className="flex flex-wrap gap-1.5 justify-center mb-8">
          {questions.map((q, index) => (
            <button
              key={index}
              onClick={() => setCurrentQuestion(index)}
              className={`w-8 h-8 rounded-md text-[10px] font-bold transition-all border-2 ${currentQuestion === index
                  ? q.subject === 'portugues'
                    ? "bg-accent border-accent text-white scale-110 shadow-lg shadow-accent/20"
                    : "bg-success border-success text-white scale-110 shadow-lg shadow-success/20"
                  : answers[index] !== null
                    ? q.subject === 'portugues' ? "bg-accent border-accent text-white" : "bg-success border-success text-white"
                    : q.subject === 'portugues'
                      ? "bg-accent/5 border-accent/20 text-accent hover:bg-accent/10"
                      : "bg-success/5 border-success/20 text-success hover:bg-success/10"
                }`}
            >
              {index + 1}
            </button>
          ))}
        </div>
      </main>

      <footer className="fixed bottom-0 left-0 right-0 bg-card border-t border-border p-4 z-40">
        <div className="container mx-auto max-w-3xl flex items-center justify-between">
          <Button variant="outline" onClick={handlePrevious} disabled={currentQuestion === 0}>
            <ChevronLeft className="w-4 h-4 mr-2" /> Anterior
          </Button>
          <Button variant="hero" onClick={handleNext}>
            {currentQuestion === questions.length - 1 ? "Finalizar" : "Próxima"} <ChevronRight className="w-4 h-4 ml-2" />
          </Button>
        </div>
      </footer>

      <AlertDialog open={showFinishDialog} onOpenChange={setShowFinishDialog}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle>Deseja finalizar o teste?</AlertDialogTitle>
            <AlertDialogDescription>
              Você respondeu {answeredCount} de {questions.length} questões.
              Confirme para ver seu resultado e as explicações.
            </AlertDialogDescription>
          </AlertDialogHeader>
          <AlertDialogFooter>
            <AlertDialogCancel>Continuar Teste</AlertDialogCancel>
            <AlertDialogAction onClick={finishExam} className="bg-accent hover:bg-accent/90">
              Ver Resultado
            </AlertDialogAction>
          </AlertDialogFooter>
        </AlertDialogContent>
      </AlertDialog>
    </div>
  );
};

export default DemoExamPage;
