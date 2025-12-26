import { Anchor, Clock, BookOpen, Award, Users, CheckCircle } from "lucide-react";
import { Link } from "react-router-dom";
import { Button } from "@/components/ui/button";
import WhatsAppButton from "@/components/WhatsAppButton";

const LandingPage = () => {
  const features = [
    {
      icon: Clock,
      title: "Simulados Cronometrados",
      description: "Provas com tempo real de 180 minutos (3 horas), igual ao PROPOM oficial",
    },
    {
      icon: BookOpen,
      title: "40 Questões por Prova",
      description: "Português e Matemática Fundamental, conforme o edital",
    },
    {
      icon: Award,
      title: "Foco na Aprovação",
      description: "Acompanhe sua evolução e garanta sua vaga na Marinha Mercante",
    },
    {
      icon: Users,
      title: "Preparação Focada",
      description: "Conteúdo direto ao ponto para quem busca a vaga na Marinha",
    },
  ];

  const disciplines = [
    { name: "Português", questions: 20, topics: ["Interpretação de Texto", "Gramática Básica", "Sintaxe e Pontuação", "Ortografia Oficial"] },
    { name: "Matemática", questions: 20, topics: ["Aritmética (MMC e MDC)", "Geometria (Pitágoras e Áreas)", "Álgebra (Equações 1º e 2º Grau)", "Regra de Três Composta", "Porcentagem e Conjuntos"] },
  ];

  return (
    <div className="min-h-screen bg-background">
      {/* Header */}
      <header className="fixed top-0 left-0 right-0 z-40 bg-card/80 backdrop-blur-md border-b border-border">
        <div className="container mx-auto px-4 py-4 flex items-center justify-between">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-lg gradient-navy flex items-center justify-center">
              <Anchor className="w-6 h-6 text-primary-foreground" />
            </div>
            <div>
              <h1 className="font-bold text-lg text-foreground">PROPOM 2026</h1>
              <p className="text-xs text-muted-foreground">Simulados Marinha Mercante</p>
            </div>
          </div>
          <div className="flex items-center gap-3">
            <Link to="/login">
              <Button variant="ghost" size="sm">Login Aluno</Button>
            </Link>
            <Link to="/admin/login">
              <Button variant="outline" size="sm">Administrador</Button>
            </Link>
          </div>
        </div>
      </header>

      {/* Hero Section */}
      <section className="relative pt-32 pb-20 gradient-hero overflow-hidden">
        <div className="absolute inset-0 opacity-10">
          <div className="absolute top-20 left-10 w-64 h-64 rounded-full bg-accent blur-3xl" />
          <div className="absolute bottom-20 right-10 w-96 h-96 rounded-full bg-secondary blur-3xl" />
        </div>

        <div className="container mx-auto px-4 relative z-10">
          <div className="max-w-3xl mx-auto text-center">
            <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6 animate-fade-in">
              <Anchor className="w-4 h-4 text-accent" />
              <span className="text-sm text-white/90 font-medium">Preparatório Oficial 2026</span>
            </div>

            <h2 className="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in" style={{ animationDelay: "0.1s" }}>
              Simulados{" "}
              <span className="text-accent">PROPOM 2026</span>
            </h2>

            <p className="text-lg md:text-xl text-white/80 mb-8 animate-fade-in" style={{ animationDelay: "0.2s" }}>
              Prepare-se para o Processo Seletivo da Marinha Mercante com simulados
              completos e cronometrados. Pratique nas mesmas condições da prova real.
            </p>

            <div className="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in" style={{ animationDelay: "0.3s" }}>
              <Link to="/comprar">
                <Button variant="hero" size="xl">
                  Comprar Acesso – R$ 35,00
                </Button>
              </Link>
              <Link to="/login">
                <Button variant="heroOutline" size="xl">
                  Já sou aluno
                </Button>
              </Link>
            </div>
          </div>
        </div>

        {/* Wave decoration */}
        <div className="absolute bottom-0 left-0 right-0">
          <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="hsl(var(--background))" />
          </svg>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <div className="text-center mb-12">
            <h3 className="text-3xl font-bold text-foreground mb-4">
              Por que escolher nossos simulados?
            </h3>
            <p className="text-muted-foreground max-w-2xl mx-auto">
              Desenvolvidos por especialistas, nossos simulados reproduzem fielmente
              o formato e dificuldade do PROPOM.
            </p>
          </div>

          <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            {features.map((feature, index) => (
              <div
                key={feature.title}
                className="card-navy p-6 hover:shadow-elevated transition-shadow duration-300 animate-fade-in"
                style={{ animationDelay: `${index * 0.1}s` }}
              >
                <div className="w-12 h-12 rounded-xl gradient-navy flex items-center justify-center mb-4">
                  <feature.icon className="w-6 h-6 text-primary-foreground" />
                </div>
                <h4 className="font-semibold text-lg text-white mb-2">{feature.title}</h4>
                <p className="text-white/70 text-sm">{feature.description}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Disciplines Section */}
      <section className="py-20 bg-muted/50">
        <div className="container mx-auto px-4">
          <div className="text-center mb-12">
            <h3 className="text-3xl font-bold text-foreground mb-4">
              Disciplinas Avaliadas
            </h3>
            <p className="text-muted-foreground">
              Confira as matérias cobradas no PROPOM 2026
            </p>
          </div>

          <div className="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            {disciplines.map((discipline, index) => (
              <div
                key={discipline.name}
                className="card-elevated p-8 animate-fade-in"
                style={{ animationDelay: `${index * 0.15}s` }}
              >
                <div className="flex items-center justify-between mb-4">
                  <h4 className="text-xl font-bold text-foreground">{discipline.name}</h4>
                  <span className="px-3 py-1 rounded-full bg-accent/10 text-accent font-medium text-sm">
                    {discipline.questions} questões
                  </span>
                </div>
                <div className="flex flex-wrap gap-2">
                  {discipline.topics.map((topic) => (
                    <span
                      key={topic}
                      className="flex items-center gap-1 px-3 py-1 rounded-lg bg-muted text-muted-foreground text-sm"
                    >
                      <CheckCircle className="w-3 h-3 text-success" />
                      {topic}
                    </span>
                  ))}
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <div className="card-elevated gradient-navy p-12 text-center rounded-2xl">
            <h3 className="text-3xl font-bold text-white mb-4">
              Comece sua preparação agora!
            </h3>
            <p className="text-white/80 mb-8 max-w-xl mx-auto">
              Acesso completo a todos os simulados por apenas R$ 35,00.
              Pratique quantas vezes quiser até o dia da prova.
            </p>
            <Link to="/comprar">
              <Button variant="hero" size="xl">
                Garantir meu acesso
              </Button>
            </Link>
          </div>
        </div>
      </section>

      {/* Footer */}
      <footer className="py-8 border-t border-border">
        <div className="container mx-auto px-4">
          <div className="flex flex-col md:flex-row items-center justify-between gap-4">
            <div className="flex items-center gap-3">
              <div className="w-8 h-8 rounded-lg gradient-navy flex items-center justify-center">
                <Anchor className="w-4 h-4 text-primary-foreground" />
              </div>
              <span className="text-sm text-muted-foreground">
                © 2026 PROPOM Simulados. Todos os direitos reservados.
              </span>
            </div>
            <div className="flex items-center gap-6 text-sm text-muted-foreground">
              <a href="#" className="hover:text-foreground transition-colors">Termos de Uso</a>
              <a href="#" className="hover:text-foreground transition-colors">Privacidade</a>
              <a href="#" className="hover:text-foreground transition-colors">Contato</a>
            </div>
          </div>
        </div>
      </footer>

      <WhatsAppButton />
    </div>
  );
};

export default LandingPage;
