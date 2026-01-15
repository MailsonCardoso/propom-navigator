import { Anchor, Clock, BookOpen, Award, Users, CheckCircle, Trophy } from "lucide-react";
import { Link } from "react-router-dom";
import { Button } from "@/components/ui/button";
import WhatsAppButton from "@/components/WhatsAppButton";

const LandingPage = () => {
  const features = [
    {
      icon: Clock,
      title: "Simulados Cronometrados",
      description: "Provas com tempo real de 180 minutos (3 horas), igual ao PREPOM oficial",
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
              <h1 className="font-bold text-lg text-foreground">PREPOM 2026</h1>
              <p className="text-xs text-muted-foreground">Simulados Marinha Mercante</p>
            </div>
          </div>
          <div className="flex items-center gap-3">
            <Link to="/admin/login">
              <Button variant="ghost" size="sm" className="hidden sm:flex text-muted-foreground hover:text-foreground">Administrador</Button>
            </Link>
            <Link to="/login">
              <Button variant="navy" size="sm" className="font-bold shadow-lg shadow-navy/20">
                <Users className="w-4 h-4 mr-2" />
                Login Aluno
              </Button>
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
              <span className="text-sm text-white/90 font-medium">O preparatório prático que te coloca à frente da concorrência</span>
            </div>

            <h2 className="text-3xl md:text-5xl font-bold text-white mb-6 animate-fade-in leading-tight" style={{ animationDelay: "0.1s" }}>
              Simulado{" "}
              <span className="text-accent block mt-4 text-xl md:text-4xl relative z-20">CFAC-MOC | CFAC-MOM | CAAQ-TCS | CCAQ-ELT</span>
            </h2>

            <p className="text-lg md:text-xl text-white/80 mb-8 animate-fade-in" style={{ animationDelay: "0.2s" }}>
              Prepare-se para o Processo Seletivo da Marinha Mercante com simulados
              completos e cronometrados. Pratique nas mesmas condições da prova real.
            </p>

            <div className="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in" style={{ animationDelay: "0.3s" }}>
              <Link to="/comprar" className="w-full sm:w-auto">
                <Button variant="hero" size="xl" className="w-full">
                  Garantir minha vaga a bordo
                </Button>
              </Link>
              <Link to="/demo/prova" className="w-full sm:w-auto">
                <Button variant="default" size="xl" className="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold shadow-[0_0_20px_rgba(16,185,129,0.3)] border-2 border-emerald-400">
                  Fazer simulado grátis
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
              o formato e dificuldade do PREPOM.
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
      </section >

      {/* Methodology Section */}
      < section className="py-24 relative overflow-hidden bg-card" >
        <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-accent/20 to-transparent" />

        <div className="container mx-auto px-4">
          <div className="flex flex-col lg:flex-row items-center gap-16">
            <div className="flex-1 space-y-8">
              <div className="space-y-4">
                <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-accent/10 border border-accent/20 text-accent text-xs font-bold uppercase tracking-widest">
                  Baseado no Edital Oficial
                </div>
                <h3 className="text-4xl md:text-5xl font-extrabold text-foreground leading-[1.1] tracking-tight">
                  Metodologia de <br />
                  <span className="text-accent bg-clip-text text-transparent bg-gradient-to-r from-accent to-accent/60">Alto Rendimento</span>
                </h3>
                <p className="text-lg text-muted-foreground leading-relaxed max-w-xl">
                  Esqueça simulados estáticos em PDF. Nossa plataforma foi construída para simular a pressão e a dinâmica real da prova da Marinha Mercante.
                </p>
              </div>

              <div className="grid gap-6">
                <div className="group flex gap-5 p-6 rounded-2xl bg-muted/30 border border-border hover:border-accent/30 hover:bg-accent/5 transition-all duration-300">
                  <div className="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <Clock className="w-7 h-7 text-accent" />
                  </div>
                  <div>
                    <h5 className="font-bold text-xl text-foreground mb-1">Dinamismo Anti-Vício</h5>
                    <p className="text-sm text-muted-foreground leading-relaxed">Algoritmo de sorteio inteligente: questões embaralhadas a cada tentativa para garantir aprendizado real, não memorização.</p>
                  </div>
                </div>

                <div className="group flex gap-5 p-6 rounded-2xl bg-muted/30 border border-border hover:border-accent/30 hover:bg-accent/5 transition-all duration-300">
                  <div className="w-14 h-14 rounded-2xl bg-success/10 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <CheckCircle className="w-7 h-7 text-success" />
                  </div>
                  <div>
                    <h5 className="font-bold text-xl text-foreground mb-1">Simulação de Combate</h5>
                    <p className="text-sm text-muted-foreground leading-relaxed">Cronômetro de 3 horas (180 min) rigoroso e 40 questões por bloco, seguindo exatamente o peso de cada matéria no edital.</p>
                  </div>
                </div>
              </div>
            </div>

            <div className="flex-1 w-full max-w-2xl lg:max-w-none">
              <div className="relative group">
                {/* Decorative blobs */}
                <div className="absolute -top-10 -left-10 w-40 h-40 bg-accent/20 rounded-full blur-[80px] animate-pulse" />
                <div className="absolute -bottom-10 -right-10 w-40 h-40 bg-secondary/20 rounded-full blur-[80px] animate-pulse" style={{ animationDelay: '1s' }} />

                <div className="relative z-10 card-navy p-1 rounded-3xl overflow-hidden shadow-2xl">
                  <div className="bg-navy/90 rounded-[calc(1.5rem-1px)] p-12 pb-32 flex flex-col items-center justify-center relative overflow-hidden min-h-[500px]">
                    {/* Background Pattern */}
                    <div className="absolute inset-0 opacity-10" style={{ backgroundImage: 'radial-gradient(circle at 2px 2px, white 1px, transparent 0)', backgroundSize: '24px 24px' }} />

                    {/* Floating Icons decoration */}
                    <Anchor className="absolute top-10 right-10 w-24 h-24 text-white/5 -rotate-12" />
                    <BookOpen className="absolute bottom-10 left-10 w-24 h-24 text-white/5 rotate-12" />

                    <div className="relative z-20 text-center space-y-8">
                      <div className="inline-block p-6 rounded-3xl bg-white/5 backdrop-blur-xl border border-white/10 mb-2">
                        <Trophy className="w-14 h-14 text-accent" />
                      </div>
                      <div className="space-y-2">
                        <div className="text-8xl md:text-9xl font-black text-white tracking-tighter leading-none">200</div>
                        <div className="text-accent font-black uppercase tracking-[0.3em] text-xs md:text-sm">Questões Reais</div>
                      </div>
                      <p className="text-white/60 text-sm md:text-base max-w-[320px] mx-auto leading-relaxed">
                        Extraídas e profissionalizadas com base nas últimas provas oficiais.
                      </p>
                    </div>

                    {/* Stats strip */}
                    <div className="absolute bottom-0 left-0 w-full p-8 bg-white/10 backdrop-blur-xl border-t border-white/10 flex justify-around">
                      <div className="text-center">
                        <div className="text-white font-bold">5</div>
                        <div className="text-[10px] text-white/40 uppercase font-black">Blocos</div>
                      </div>
                      <div className="w-px h-8 bg-white/10" />
                      <div className="text-center">
                        <div className="text-white font-bold">100%</div>
                        <div className="text-[10px] text-white/40 uppercase font-black">Edital</div>
                      </div>
                      <div className="w-px h-8 bg-white/10" />
                      <div className="text-center">
                        <div className="text-white font-bold">VIP</div>
                        <div className="text-[10px] text-white/40 uppercase font-black">Suporte</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section >

      {/* Disciplines Section */}
      < section className="py-20" >
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
      </section >

      {/* CTA Section */}
      < section className="py-20 mb-10" >
        <div className="container mx-auto px-4">
          <div className="card-elevated gradient-navy p-12 text-center rounded-3xl relative overflow-hidden">
            <div className="absolute top-0 right-0 p-8 opacity-10 pointer-events-none">
              <Anchor className="w-64 h-64 text-white -rotate-12" />
            </div>
            <h3 className="text-3xl md:text-5xl font-bold text-white mb-6 relative z-10">
              Garanta sua Vaga na Marinha!
            </h3>
            <p className="text-white/80 mb-10 max-w-2xl mx-auto text-lg relative z-10">
              Acesso completo a todos os 5 blocos de simulados por pagamento único de R$ 50,00.
              Disponível até a conclusão da prova oficial. Comece a praticar agora mesmo!
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
      </section >

      {/* Footer */}
      < footer className="py-8 border-t border-border" >
        <div className="container mx-auto px-4">
          <div className="flex flex-col md:flex-row items-center justify-between gap-4">
            <div className="flex items-center gap-3">
              <div className="w-8 h-8 rounded-lg gradient-navy flex items-center justify-center">
                <Anchor className="w-4 h-4 text-primary-foreground" />
              </div>
              <span className="text-sm text-muted-foreground">
                © 2026 PREPOM Simulados. Todos os direitos reservados.
              </span>
            </div>
            <div className="flex items-center gap-6 text-sm text-muted-foreground">
              <a href="#" className="hover:text-foreground transition-colors">Termos de Uso</a>
              <a href="#" className="hover:text-foreground transition-colors">Privacidade</a>
              <a href="#" className="hover:text-foreground transition-colors">Contato</a>
            </div>
          </div>
        </div>
      </footer >

      <WhatsAppButton />
    </div >
  );
};

export default LandingPage;
