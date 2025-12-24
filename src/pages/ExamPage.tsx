import { useState, useEffect, useCallback } from "react";
import { useNavigate } from "react-router-dom";
import { Clock, ChevronLeft, ChevronRight, AlertTriangle, CheckCircle, Anchor } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Progress } from "@/components/ui/progress";
import { useApp } from "@/contexts/AppContext";
import { mockQuestions, Question } from "@/data/questions";
import WhatsAppButton from "@/components/WhatsAppButton";
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

const EXAM_TIME = 90 * 60; // 90 minutes in seconds

const ExamPage = () => {
  const navigate = useNavigate();
  const { setExamResult } = useApp();
  
  const [currentQuestion, setCurrentQuestion] = useState(0);
  const [answers, setAnswers] = useState<(number | null)[]>(new Array(40).fill(null));
  const [timeLeft, setTimeLeft] = useState(EXAM_TIME);
  const [showFinishDialog, setShowFinishDialog] = useState(false);
  const [isTimeWarning, setIsTimeWarning] = useState(false);

  const formatTime = (seconds: number) => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins.toString().padStart(2, "0")}:${secs.toString().padStart(2, "0")}`;
  };

  const finishExam = useCallback(() => {
    const correctAnswers = answers.reduce((count, answer, index) => {
      if (answer === mockQuestions[index].correctAnswer) {
        return count + 1;
      }
      return count;
    }, 0);

    setExamResult({
      totalQuestions: 40,
      correctAnswers,
      passed: correctAnswers >= 31,
      completedAt: new Date(),
    });

    navigate("/aluno/resultado");
  }, [answers, navigate, setExamResult]);

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
    newAnswers[currentQuestion] = optionIndex;
    setAnswers(newAnswers);
  };

  const answeredCount = answers.filter((a) => a !== null).length;
  const progress = (answeredCount / 40) * 100;

  const question: Question = mockQuestions[currentQuestion];

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

            <div className={`flex items-center gap-2 px-4 py-2 rounded-lg ${
              isTimeWarning ? "bg-warning/10 text-warning" : "bg-muted text-foreground"
            }`}>
              <Clock className={`w-5 h-5 ${isTimeWarning ? "animate-pulse" : ""}`} />
              <span className="font-mono font-bold text-lg">{formatTime(timeLeft)}</span>
              {isTimeWarning && <AlertTriangle className="w-4 h-4" />}
            </div>
          </div>
        </div>
      </header>

      {/* Progress Bar */}
      <div className="fixed top-[69px] left-0 right-0 z-30 bg-card border-b border-border px-4 py-3">
        <div className="container mx-auto">
          <div className="flex items-center justify-between mb-2">
            <span className="text-sm text-muted-foreground">
              Questão {currentQuestion + 1} de 40
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
              <span className={`px-3 py-1 rounded-full text-sm font-medium ${
                question.subject === "portugues" 
                  ? "bg-accent/10 text-accent" 
                  : "bg-success/10 text-success"
              }`}>
                {question.subject === "portugues" ? "Português" : "Matemática"}
              </span>
              <span className="text-sm text-muted-foreground">
                Questão {question.id}
              </span>
            </div>

            <h2 className="text-xl md:text-2xl font-semibold text-foreground mb-8 leading-relaxed">
              {question.text}
            </h2>

            <div className="space-y-3">
              {question.options.map((option, index) => (
                <button
                  key={index}
                  onClick={() => handleAnswer(index)}
                  className={`w-full text-left p-4 rounded-xl border-2 transition-all duration-200 ${
                    answers[currentQuestion] === index
                      ? "border-accent bg-accent/10 text-foreground"
                      : "border-border bg-card hover:border-accent/50 hover:bg-muted/50 text-foreground"
                  }`}
                >
                  <div className="flex items-center gap-4">
                    <div className={`w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold ${
                      answers[currentQuestion] === index
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
              {mockQuestions.map((_, index) => (
                <button
                  key={index}
                  onClick={() => setCurrentQuestion(index)}
                  className={`w-8 h-8 rounded-lg text-sm font-medium transition-all ${
                    currentQuestion === index
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
              onClick={() => setCurrentQuestion(Math.max(0, currentQuestion - 1))}
              disabled={currentQuestion === 0}
            >
              <ChevronLeft className="w-5 h-5" />
              Anterior
            </Button>

            <Button
              variant="navy"
              onClick={() => setShowFinishDialog(true)}
            >
              Finalizar Prova
            </Button>

            <Button
              variant="outline"
              onClick={() => setCurrentQuestion(Math.min(39, currentQuestion + 1))}
              disabled={currentQuestion === 39}
            >
              Próxima
              <ChevronRight className="w-5 h-5" />
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
              Você respondeu {answeredCount} de 40 questões.
              {answeredCount < 40 && (
                <span className="block mt-2 text-warning">
                  Atenção: {40 - answeredCount} questões ainda não foram respondidas.
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

      <WhatsAppButton />
    </div>
  );
};

export default ExamPage;
