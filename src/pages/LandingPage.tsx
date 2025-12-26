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
    {
      name: "Língua Portuguesa",
      questions: 20,
      topics: [
        "Interpretação de Texto (Textos Base)",
        "Gramática Básica (Classes de Palavras)",
        "Sintaxe e Pontuação (Análise de Orações)",
        "Ortografia Oficial (Novo Acordo)",
        "Plurais e Acentuação Complexa"
      ]
    },
    {
      name: "Matemática Fundamental",
      questions: 20,
      topics: [
        "Aritmética Avançada (MMC e MDC)",
        "Geometria Aplicada (Pitágoras e Áreas)",
        "Álgebra de 1º Grau (Equações)",
        "Razão, Proporção e Regra de Três",
        "Lógica, Porcentagem e Probabilidade"
      ]
    },
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

      {/* Methodology Section */}
      <section className="py-20 bg-accent/5 overflow-hidden">
        <div className="container mx-auto px-4">
          <div className="flex flex-col lg:flex-row items-center gap-12">
            <div className="flex-1 space-y-6">
              <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-accent/10 border border-accent/20 text-accent text-xs font-bold uppercase tracking-wider">
                Inovação Pedagógica
              </div>
              <h3 className="text-3xl md:text-4xl font-bold text-foreground leading-tight">
                Nossa Metodologia <br />
                <span className="text-accent underline decoration-accent/30">Dinamismo Anti-Vício</span>
              </h3>
              <p className="text-muted-foreground leading-relaxed">
                Diferente de simulados em PDF, nossa plataforma utiliza um algoritmo de sorteio inteligente que garante que você nunca decore a ordem das respostas.
              </p>
              <div className="grid sm:grid-cols-2 gap-4 pt-4">
                <div className="p-4 bg-card rounded-xl border border-border">
                  <h5 className="font-bold text-foreground mb-1 flex items-center gap-2">
                    <CheckCircle className="w-4 h-4 text-success" />
                    Fidelidade Total
                  </h5>
                  <p className="text-xs text-muted-foreground">Cronômetro de 3 horas e 40 questões conforme o padrão oficial da Marinha.</p>
                </div>
                <div className="p-4 bg-card rounded-xl border border-border">
                  <h5 className="font-bold text-foreground mb-1 flex items-center gap-2">
                    <CheckCircle className="w-4 h-4 text-success" />
                    Repetição Espaçada
                  </h5>
                  <p className="text-xs text-muted-foreground">Refaça os blocos com questões embaralhadas para fixar o aprendizado real.</p>
                </div>
              </div>
            </div>
            <div className="flex-1 relative">
              <div className="aspect-video gradient-navy rounded-2xl shadow-2xl flex items-center justify-center p-8 overflow-hidden">
                <div className="absolute inset-0 opacity-20 flex flex-wrap gap-4 p-4 pointer-events-none">
                  {Array.from({ length: 20 }).map((_, i) => (
                    <div key={i} className="w-8 h-8 rounded bg-white" />
                  ))}
                </div>
                <div className="relative z-10 text-center">
                  <div className="text-5xl font-bold text-white mb-2">200</div>
                  <div className="text-accent font-bold uppercase tracking-widest text-sm">Questões Inéditas</div>
                </div>
              </div>
              <div className="absolute -bottom-6 -right-6 w-32 h-32 bg-accent/20 rounded-full blur-2xl -z-10" />
            </div>
          </div>
        </div>
      </section>

      {/* Disciplines Section */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <div className="text-center mb-12">
            <h3 className="text-3xl font-bold text-foreground mb-4">
              Conteúdo Programático
            </h3>
            <p className="text-muted-foreground">
              Confira os tópicos abordados em cada disciplina do PREPOM 2026
            </p>
          </div>

          <div className="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            {disciplines.map((discipline, index) => (
              <div
                key={discipline.name}
                className="card-elevated p-8 animate-fade-in hover:border-accent/40 transition-colors"
                style={{ animationDelay: `${index * 0.15}s` }}
              >
                <div className="flex items-center justify-between mb-6">
                  <h4 className="text-2xl font-bold text-foreground">{discipline.name}</h4>
                  <span className="px-4 py-1 rounded-full bg-accent/10 text-accent font-bold text-sm">
                    {discipline.questions} questões
                  </span>
                </div>
                <div className="grid gap-3">
                  {discipline.topics.map((topic) => (
                    <div
                      key={topic}
                      className="flex items-center gap-3 p-3 rounded-xl bg-muted/30 text-muted-foreground text-sm border border-transparent hover:border-border hover:bg-muted/50 transition-all"
                    >
                      <CheckCircle className="w-4 h-4 text-success shrink-0" />
                      <span className="font-medium">{topic}</span>
                    </div>
                  ))}
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 mb-10">
        <div className="container mx-auto px-4">
          <div className="card-elevated gradient-navy p-12 text-center rounded-3xl relative overflow-hidden">
            <div className="absolute top-0 right-0 p-8 opacity-10 pointer-events-none">
              <Anchor className="w-64 h-64 text-white -rotate-12" />
            </div>
            <h3 className="text-3xl md:text-5xl font-bold text-white mb-6 relative z-10">
              Garanta sua Vaga na Marinha!
            </h3>
            <p className="text-white/80 mb-10 max-w-2xl mx-auto text-lg relative z-10">
              Acesso vitalício a todos os 5 blocos de simulados por pagamento único de R$ 35,00.
              Comece a praticar com o tempo real de prova agora mesmo.
            </p>
            <div className="flex flex-col sm:flex-row items-center justify-center gap-4 relative z-10">
              <Link to="/comprar">
                <Button variant="hero" size="xl" className="shadow-lg shadow-accent/20">
                  Garantir meu acesso
                </Button>
              </Link>
            </div>
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
