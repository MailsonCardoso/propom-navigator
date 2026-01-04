import { useState, useEffect, useCallback } from "react";
import { useNavigate, useSearchParams } from "react-router-dom";
import { Clock, ChevronLeft, ChevronRight, AlertTriangle, CheckCircle, Anchor, LogOut, Lightbulb, BookOpen, Flag } from "lucide-react";
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
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import {
  Sheet,
  SheetContent,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from "@/components/ui/sheet";
import { Badge } from "@/components/ui/badge";

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
  const { setExamResult, logout, user } = useApp();
  const backupKey = `exam_backup_${user?.id}_block_${blockId}`;

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
  const [markedForReview, setMarkedForReview] = useState<number[]>([]);
  const [mobileTab, setMobileTab] = useState<string>("question");

  const toggleReview = () => {
    if (markedForReview.includes(currentQuestion)) {
      setMarkedForReview(markedForReview.filter(i => i !== currentQuestion));
    } else {
      setMarkedForReview([...markedForReview, currentQuestion]);
    }
  };

  useEffect(() => {
    // Reset tab when changing question
    setMobileTab("question");
  }, [currentQuestion]);

  useEffect(() => {
    const fetchQuestions = async () => {
      try {
        const timestamp = new Date().getTime();
        const data = await api.get(`/questions?block=${blockId}&t=${timestamp}`);
        setQuestions(data);

        // Check for backup
        const backup = localStorage.getItem(backupKey);
        if (backup) {
          const { answers: savedAnswers, timeLeft: savedTime, questionIndex } = JSON.parse(backup);

          // Verify if backup matches current exam size
          if (savedAnswers && savedAnswers.length === data.length) {
            setAnswers(savedAnswers);
            setTimeLeft(savedTime); // Resume time
            setCurrentQuestion(questionIndex || 0);
            console.log("Exam restored from backup");
          } else {
            setAnswers(new Array(data.length).fill(null));
          }
        } else {
          setAnswers(new Array(data.length).fill(null));
        }
      } catch (error) {
        console.error("Error fetching questions:", error);
      } finally {
        setIsLoading(false);
      }
    };
    fetchQuestions();
  }, [blockId, user?.id, backupKey]);

  // Auto-Save Effect
  useEffect(() => {
    if (!isLoading && questions.length > 0 && timeLeft > 0) {
      const backupData = {
        answers,
        timeLeft,
        questionIndex: currentQuestion,
        updatedAt: new Date().getTime()
      };
      localStorage.setItem(backupKey, JSON.stringify(backupData));
    }
  }, [answers, timeLeft, currentQuestion, isLoading, questions.length, backupKey]);

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

      // Clear backup on success
      localStorage.removeItem(backupKey);

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
  }, [answers, navigate, setExamResult, blockId, questions, backupKey]);

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
      {/* Header Compacto */}
      <header className="fixed top-0 left-0 right-0 z-40 bg-card border-b border-border shadow-sm">
        <div className="container mx-auto px-4 py-2">
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-2">
              <div className="w-8 h-8 rounded-lg gradient-navy flex items-center justify-center shrink-0">
                <Anchor className="w-5 h-5 text-primary-foreground" />
              </div>
              <div className="min-w-0">
                <h1 className="font-bold text-foreground text-sm md:text-base truncate">PREPOM 2026</h1>
                <div className="flex items-center gap-2">
                  <Badge variant="outline" className={`text-[9px] h-4 px-1.5 uppercase font-bold border-none ${question.subject === "portugues" ? "bg-accent/10 text-accent" : "bg-success/10 text-success"}`}>
                    {question.subject === "portugues" ? "Português" : "Matemática"}
                  </Badge>
                </div>
              </div>
            </div>

            <div className="flex items-center gap-2">
              <div className={`flex items-center gap-1.5 px-2 py-1 rounded-md ${isTimeWarning ? "bg-warning/10 text-warning" : "bg-muted text-foreground"}`}>
                <Clock className={`w-3.5 h-3.5 ${isTimeWarning ? "animate-pulse" : ""}`} />
                <span className="font-mono font-bold text-sm md:text-base">{formatTime(timeLeft)}</span>
              </div>

              <Button variant="ghost" size="icon" onClick={handleLogout} className="text-muted-foreground hover:text-destructive h-8 w-8">
                <LogOut className="w-4 h-4" />
              </Button>
            </div>
          </div>
        </div>
      </header>

      {/* Progress Bar Integrada */}
      <div className="fixed top-[49px] left-0 right-0 z-30 bg-card/80 backdrop-blur-sm px-4 py-1.5">
        <div className="container mx-auto">
          <div className="flex items-center justify-between mb-1 text-[9px] md:text-xs">
            <span className="text-muted-foreground font-medium uppercase tracking-wider">
              Questão {currentQuestion + 1} de {questions.length}
            </span>
            <span className="font-bold text-foreground">
              {answeredCount}/{questions.length} Concluído
            </span>
          </div>
          <Progress value={progress} className="h-1" />
        </div>
      </div>

      {/* Question Content */}
      <main className="pt-28 md:pt-36 pb-32 px-3 md:px-6">
        <div className="container mx-auto max-w-4xl">
          <div className="card-elevated p-6 md:p-10 animate-fade-in">
            <div className="flex items-center gap-2 mb-4 md:mb-6">
              <span className={`px-3 py-1 rounded-full text-xs md:text-sm font-medium ${question.subject === "portugues"
                ? "bg-accent/10 text-accent"
                : "bg-success/10 text-success"
                }`}>
                {question.subject === "portugues" ? "Português" : "Matemática"}
              </span>
              <span className="text-xs md:text-sm text-muted-foreground">
                Questão {currentQuestion + 1}
              </span>
            </div>

            {/* Desktop View ou Mobile sem texto longo */}
            <div className="hidden md:block">
              {question && question.base_text && question.base_text.trim().length > 0 && (
                <div className="mb-8 md:mb-10 p-5 md:p-7 bg-accent/5 rounded-xl border border-accent/20 shadow-sm transition-all">
                  <div className="flex items-center gap-2 mb-4">
                    <BookOpen className="w-5 h-5 text-accent" />
                    <span className="text-xs md:text-sm font-bold text-accent uppercase tracking-widest">Texto de Apoio</span>
                  </div>
                  <div className="text-base md:text-lg text-foreground leading-relaxed whitespace-pre-wrap font-serif italic opacity-90 border-l-4 border-accent/20 pl-5">
                    {question.base_text}
                  </div>
                </div>
              )}
            </div>

            {/* Mobile View: Tabs (apenas se houver texto base) */}
            <div className="md:hidden">
              {question && question.base_text && question.base_text.trim().length > 0 ? (
                <Tabs value={mobileTab} onValueChange={setMobileTab} className="w-full mb-6">
                  <TabsList className="grid w-full grid-cols-2 h-10 bg-muted/30 p-1 rounded-lg">
                    <TabsTrigger value="text" className="data-[state=active]:bg-navy data-[state=active]:text-white transition-all rounded-md">
                      <BookOpen className="w-4 h-4 mr-2" /> Texto
                    </TabsTrigger>
                    <TabsTrigger value="question" className="data-[state=active]:bg-navy data-[state=active]:text-white transition-all rounded-md">
                      <Lightbulb className="w-4 h-4 mr-2" /> Pergunta
                    </TabsTrigger>
                  </TabsList>

                  <TabsContent value="text" className="mt-4 animate-in fade-in slide-in-from-left-2 transition-all">
                    <div className="p-4 bg-accent/5 rounded-xl border border-accent/20 font-serif italic text-sm leading-relaxed whitespace-pre-wrap">
                      {question.base_text}
                    </div>
                  </TabsContent>

                  <TabsContent value="question" className="mt-0 animate-in fade-in slide-in-from-right-2 transition-all">
                    {/* Pergunta renderizada abaixo */}
                  </TabsContent>
                </Tabs>
              ) : null}
            </div>

            {/* Content Switcher logic (apenas esconde texto no mobile se tab for 'text') */}
            <div className={`${(mobileTab === 'text' && question.base_text) ? 'hidden' : 'block'} md:block transition-all`}>
              <div className="flex items-start justify-between mb-6 md:mb-10 gap-3">
                <h2 className="text-lg md:text-2xl font-semibold text-foreground leading-relaxed flex-1">
                  {question.text}
                </h2>
                <div className="flex gap-1 flex-shrink-0">
                  <Button
                    variant="ghost"
                    size="icon"
                    onClick={toggleReview}
                    className={`h-8 w-8 ${markedForReview.includes(currentQuestion) ? "text-warning bg-warning/10" : "text-muted-foreground"}`}
                  >
                    <Flag className={`w-4 h-4 md:w-5 md:h-5 ${markedForReview.includes(currentQuestion) ? "fill-warning" : ""}`} />
                  </Button>
                  {question.hint && (
                    <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => setShowHint(!showHint)}
                      className={`h-8 w-8 ${showHint ? "text-accent bg-accent/10" : "text-muted-foreground"}`}
                    >
                      <Lightbulb className={`w-4 h-4 md:w-5 md:h-5 ${showHint ? "fill-accent" : ""}`} />
                    </Button>
                  )}
                </div>
              </div>

              {showHint && question.hint && (
                <div className="mb-6 p-4 bg-accent/5 border border-accent/20 rounded-xl animate-scale-in">
                  <p className="text-xs md:text-base text-accent flex items-start gap-2">
                    <Lightbulb className="w-4 h-4 mt-0.5 shrink-0" />
                    <span><strong>Dica:</strong> {question.hint}</span>
                  </p>
                </div>
              )}

              <div className="space-y-2 md:space-y-4">
                {question.options.map((option, index) => (
                  <button
                    key={index}
                    onClick={() => handleAnswer(index)}
                    className={`w-full text-left p-3 md:p-5 rounded-xl border-2 transition-all duration-200 ${answers[currentQuestion] === index
                      ? "border-accent bg-accent/10 text-foreground"
                      : "border-border bg-card hover:border-accent/40 hover:bg-muted/50 text-foreground"
                      }`}
                  >
                    <div className="flex items-center gap-3 md:gap-4">
                      <div className={`w-7 h-7 md:w-9 md:h-9 rounded-full flex items-center justify-center text-xs md:text-sm font-bold notranslate ${answers[currentQuestion] === index
                        ? "bg-navy text-white"
                        : "bg-muted text-muted-foreground"
                        }`}
                        translate="no"
                      >
                        {String.fromCharCode(65 + index)}
                      </div>
                      <span className="flex-1 text-sm md:text-base leading-snug md:leading-relaxed">{option}</span>
                      {answers[currentQuestion] === index && (
                        <CheckCircle className="w-4 h-4 md:w-5 md:h-5 text-accent flex-shrink-0" />
                      )}
                    </div>
                  </button>
                ))}
              </div>
            </div>
          </div>

          {/* Question Navigator (Escondido no Mobile, substituído por Drawer) */}
          <div className="hidden md:block mt-8 card-navy p-6 rounded-2xl">
            <div className="flex items-center justify-between mb-5">
              <p className="text-sm text-white/80 font-medium">Navegação rápida:</p>
              <div className="flex gap-6">
                <div className="flex items-center gap-2">
                  <div className="w-2.5 h-2.5 rounded-full bg-accent"></div>
                  <span className="text-[10px] text-white/70 uppercase font-bold tracking-wider">Português</span>
                </div>
                <div className="flex items-center gap-2">
                  <div className="w-2.5 h-2.5 rounded-full bg-success"></div>
                  <span className="text-[10px] text-white/70 uppercase font-bold tracking-wider">Matemática</span>
                </div>
              </div>
            </div>

            <div className="flex flex-wrap gap-2">
              {questions.map((q, index) => {
                const isCurrent = currentQuestion === index;
                const isAnswered = answers[index] !== null;
                const isMath = q.subject === "matematica";
                const isMarked = markedForReview.includes(index);

                return (
                  <button
                    key={index}
                    onClick={() => setCurrentQuestion(index)}
                    className={`w-10 h-10 rounded-lg text-xs font-bold transition-all border-2 relative ${isCurrent
                      ? "bg-foreground text-background scale-110 shadow-lg z-10 border-foreground"
                      : isMarked
                        ? "bg-warning/20 text-warning border-warning border-dashed"
                        : isAnswered
                          ? isMath
                            ? "bg-success text-success-foreground border-success"
                            : "bg-accent text-accent-foreground border-accent"
                          : isMath
                            ? "bg-success/10 text-success border-success/40"
                            : "bg-accent/10 text-accent border-accent/30"
                      }`}
                  >
                    {index + 1}
                    {isMarked && (
                      <div className="absolute -top-1.5 -right-1.5 bg-background rounded-full p-0.5 border border-border">
                        <Flag className="w-2 h-2 text-warning fill-warning" />
                      </div>
                    )}
                  </button>
                );
              })}
            </div>
          </div>
        </div>
      </main>

      {/* Bottom Navigation */}
      <footer className="fixed bottom-0 left-0 right-0 bg-card border-t border-border shadow-elevated z-30 pb-safe">
        <div className="container mx-auto px-4 py-4 pb-6 md:pb-4">
          <div className="flex items-center justify-between">
            <Button
              variant="outline"
              onClick={handlePrevious}
              disabled={currentQuestion === 0}
              size="sm"
              className="px-2 md:px-4 text-[10px] md:text-sm h-9"
            >
              <ChevronLeft className="w-4 h-4 mr-1" />
              <span className="xs:inline">Anterior</span>
            </Button>

            {/* Mobile Navigation Drawer Trigger */}
            <div className="md:hidden">
              <Sheet>
                <SheetTrigger asChild>
                  <Button variant="outline" size="sm" className="h-9 px-3 gap-2 border-dashed">
                    <div className="flex -space-x-1">
                      <div className="w-2 h-2 rounded-full bg-accent" />
                      <div className="w-2 h-2 rounded-full bg-success" />
                    </div>
                    <span className="text-[10px] font-bold">MAPA</span>
                  </Button>
                </SheetTrigger>
                <SheetContent side="bottom" className="h-[75vh] rounded-t-[32px] border-t-4 border-navy p-0 overflow-hidden">
                  <SheetHeader className="p-6 pb-2 border-b border-border/50">
                    <SheetTitle className="text-center font-bold text-navy flex items-center justify-center gap-2 text-xl">
                      <Anchor className="w-6 h-6" /> Mapa da Prova
                    </SheetTitle>
                    <div className="flex justify-center gap-6 text-[11px] py-2 font-bold uppercase tracking-wider notranslate" translate="no">
                      <div className="flex items-center gap-2 transition-all"><div className="w-3 h-3 rounded-full bg-accent shadow-sm" /> Português</div>
                      <div className="flex items-center gap-2 transition-all"><div className="w-3 h-3 rounded-full bg-success shadow-sm" /> Matemática</div>
                    </div>
                  </SheetHeader>
                  <div className="overflow-y-auto h-full p-6 pb-28">
                    <div className="grid grid-cols-5 gap-3">
                      {questions.map((q, index) => {
                        const isCurrent = currentQuestion === index;
                        const isAnswered = answers[index] !== null;
                        const isMath = q.subject === "matematica";
                        const isMarked = markedForReview.includes(index);

                        return (
                          <button
                            key={index}
                            onClick={() => setCurrentQuestion(index)}
                            translate="no"
                            className={`aspect-square rounded-2xl text-base font-black transition-all border-2 relative flex items-center justify-center notranslate ${isCurrent
                              ? "bg-navy text-white shadow-[0_8px_16px_rgba(30,41,59,0.3)] border-navy scale-105 z-10"
                              : isMarked
                                ? "bg-warning/10 text-warning border-warning border-dashed"
                                : isAnswered
                                  ? isMath
                                    ? "bg-success/20 text-success border-success"
                                    : "bg-accent/20 text-accent border-accent"
                                  : "bg-muted/30 text-muted-foreground border-transparent"
                              }`}
                          >
                            {index + 1}
                            {isMarked && (
                              <div className="absolute -top-1 -right-1 bg-warning text-white rounded-full p-0.5 shadow-sm">
                                <Flag className="w-2.5 h-2.5 fill-current" />
                              </div>
                            )}
                            {isAnswered && !isCurrent && (
                              <div className="absolute -bottom-1 -right-1 bg-white rounded-full">
                                <CheckCircle className={`w-3.5 h-3.5 ${isMath ? 'text-success' : 'text-accent'} fill-current`} />
                              </div>
                            )}
                          </button>
                        );
                      })}
                    </div>
                  </div>
                </SheetContent>
              </Sheet>
            </div>

            <Button
              variant="navy"
              onClick={() => setShowFinishDialog(true)}
              size="sm"
              className="px-3 md:px-6 text-[10px] md:text-sm font-bold shadow-lg h-9"
            >
              <CheckCircle className="w-3.5 h-3.5 md:mr-2" />
              <span>Finalizar</span>
            </Button>

            <Button
              variant={currentQuestion === questions.length - 1 ? "navy" : "outline"}
              onClick={handleNext}
              size="sm"
              className="px-2 md:px-4 text-[10px] md:text-sm h-9"
            >
              <span className="xs:inline">{currentQuestion === questions.length - 1 ? "Finalizar" : "Próxima"}</span>
              <ChevronRight className="w-4 h-4 ml-1" />
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
              Seu progresso salvo será mantido, mas o tempo continuará contando se você voltar muito tarde.
              Recomendamos finalizar a prova.
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
