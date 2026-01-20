<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class Module10Seeder extends Seeder
{
    public function run(): void
    {
        // Limpar questões antigas do bloco 10 se existirem
        Question::where('block', 10)->delete();

        $textRadioisotopos = "Marinha e IPEN capacitam militares e iniciam produção de radioisótopo contra o câncer: Material produzido no reator passa a ser utilizado na Radiofarmácia do IPEN, dando origem a radiofármacos vitais para a medicina nuclear.\n\nA Marinha do Brasil (MB) e o Instituto de Pesquisas Energéticas e Nucleares (IPEN) iniciaram uma etapa importante em prol do setor nuclear do País. O reator de pesquisa IEA-R1 passou a operar em regime contínuo, em turnos de revezamento conduzidos por militares da Força Naval e técnicos do IPEN, voltados à produção inicial de radioisótopos, substâncias utilizadas principalmente em aplicações médicas e industriais, por emitirem radiações controladas. O foco inicial é o Lutécio-177, radioisótopo utilizado na marcação de moléculas específicas de alto valor terapêutico, considerado referência no tratamento de tumores neuroendócrinos e no combate ao câncer de próstata.\n\nO Diretor-Geral de Desenvolvimento Nuclear e Tecnológico da Marinha, Almirante de Esquadra Alexandre Rabello de Faria, ressaltou a importância da formação dos militares: “Esse processo de qualificação é muito especial para o Programa Nuclear da Marinha. A gente fica feliz porque é um processo difícil e eles conseguiram. Isso demonstra que nosso pessoal tem potencial e muita capacidade. Essa formação vai ao encontro da natureza da profissão militar, que é servir. Esses militares estão servindo e prestando um serviço para produzir o bem, colaborando com a produção de radiofármacos e com sua entrega ao serviço de saúde”, afirmou o Almirante de Esquadra Rabello.\n\nO presidente da Comissão Nacional de Energia Nuclear (CNEN), Francisco Rondinelli Junior, destacou que a iniciativa simboliza um marco de cooperação institucional e de entrega direta à sociedade. “Este momento entrega para a sociedade profissionais capacitados, capazes de explorar o potencial da área nuclear em termos de aplicações, desenvolvimento e saúde. A utilização na medicina é apenas um dos exemplos, mas o alcance é muito maior. É, sem dúvida, um momento de muita satisfação e de celebração, fruto de uma parceria que deve continuar por muito tempo”, afirmou o presidente da CNEN Rondinelli.\n\nAs primeiras amostras de Lutécio-177 foram marcadas com PSMA (Antígeno de Membrana Específico da Próstata) na Radiofarmácia do IPEN, e os resultados obtidos foram satisfatórios. A divulgação ocorreu na sexta-feira, 29 de agosto, data em que o Instituto celebrou 69 anos de fundação, oficialmente completados em 31 de agosto.\n\nCom a validação confirmada, o IEA-R1 passou a produzir oficialmente o radioisótopo, possibilitando sua transformação em radiofármacos capazes de atender, futuramente, parte da demanda nacional.\n\nA Coordenadora do Centro de Radiofarmácia do IPEN, Dra. Elaine Bortoleti, destacou que a operação contínua do reator representa um marco após mais de uma década. “Já fazia mais de dez anos que o reator não operava de forma contínua. Essa retomada possibilita a produção de amostras de material radioativo que servem como matéria-prima essencial para a fabricação de radiofármacos utilizados na medicina nuclear. Produzir localmente traz autonomia, já que hoje praticamente quase tudo precisa ser importado. Mesmo sendo ainda uma produção experimental e em pequenas quantidades, é um primeiro passo muito importante, que abre expectativa de crescimento e de atender parte da nossa demanda por esses insumos fundamentais para a saúde”, explicou a coordenadora do Centro de Radiofarmácia Elaine.\n\nA conquista representa mais do que um avanço tecnológico: trata-se de um esforço compartilhado para reduzir a dependência externa na área da saúde. Apenas em 2023 e 2024, o Brasil importou cerca de 50 milhões de dólares em radioisótopos como Molibdênio-99, Iodo-131 e o próprio Lutécio-177.\n\nA produção em grande escala tem potencial para gerar economia anual significativa, reforçar a soberania científica e tecnológica e ampliar o acesso da população a terapias nucleares avançadas.\n\nO Coordenador do contrato de parceria, designado pela Marinha, Capitão de Mar e Guerra Enéas Tadeu Fernandes Ervilha, e o Gerente do reator, Dr. Frederico Genezini, destacaram que os avanços obtidos resultam da cooperação entre a MB e o IPEN. O progresso decorre do Acordo de Parceria para Pesquisa, Desenvolvimento e Inovação, firmado entre o CTMSP e o IPEN/CNEN, cujo objetivo é capacitar operadores de reator nuclear e fomentar a pesquisa aplicada à produção de radioisótopos. O Comandante Enéas frisou, ainda, que a experiência dos operadores atende a parte dos requisitos de qualificação técnica nuclear exigidos aos futuros candidatos a operadores do Laboratório de Geração de Energia Nucleoelétrica (LABGENE).\n\nO desempenho dos militares da Marinha foi expressivo. Em 2023, quatro operadores sênior e seis operadores de reator foram licenciados pela CNEN; em 2024, outros nove conquistaram a habilitação. Neste ano, um supervisor e quatro técnicos de proteção radiológica já foram credenciados, enquanto cinco candidatos aprovados na prova escrita aguardam a avaliação prático-oral marcada para setembro. Os militares da Marinha alcançaram 100% de aprovação nos processos de licenciamento da CNEN. Esse resultado permitiu a formação de equipes de turno compostas por operadores da Força Naval e do IPEN, altamente qualificadas e em número suficiente para viabilizar o início da operação destinada à produção do Lutécio-177.\n\nPara o Coordenador do programa de treinamento e professor Dr. José Roberto Berretta, a formação do IPEN é fundamental para preparar operadores de reatores. Ele destaca que a estratégia do curso é compartilhar ao máximo as informações sobre a instalação, proporcionando um aprendizado prático e aprofundado. O professor Berretta também ressalta que um bom operador de reator deve ter um conhecimento amplo de diferentes reatores, e não se limitar a apenas um. Essa abordagem, segundo ele, eleva os padrões de segurança operacional.\n\nDesde o início de agosto, a operação em regime contínuo, com turnos de vinte e quatro horas tem sido conduzida por equipes da Marinha e do IPEN. Após a obtenção da licença, os militares passaram a integrar oficialmente a rotina operacional do reator. O Grupo de Proteção Radiológica é essencial para garantir que a operação em turnos ocorra com total segurança, tanto para o reator quanto para as equipes envolvidas. O trabalho assegura que cada etapa da produção do Lutécio-177 seja conduzida dentro dos mais rigorosos padrões de proteção radiológica e segurança nuclear. O convênio, válido até 2027, prevê ainda a produção nacional de Iodo-131 e a realização de novas pesquisas sobre elementos químicos a serem irradiados.\n\nA superintendente do IPEN, Dra. Isolda Costa, ressaltou que os resultados alcançados demonstram a importância da complementaridade entre as instituições, especialmente para garantir a transferência e a preservação de conhecimentos para as novas gerações. “O benefício dessa parceria é enorme. Sem o IPEN, não haveria transferência de conhecimentos, e sem os militares da Marinha não teríamos pessoal capacitado para operar o reator de forma contínua, inclusive, durante a madrugada. Essa sinergia é fundamental, pois garante a preservação do conhecimento, ao mesmo tempo em que forma novas gerações capazes de levar adiante esse legado para o futuro”, explicou a Dra. Isolda.\n\nCom a validação concluída, a Marinha e o IPEN iniciaram a produção nacional de Lutécio-177, insumo essencial no tratamento do câncer. A iniciativa reduz a dependência de importações e amplia a oferta de radiofármacos, fundamentais para pacientes em todo o País.";

        $textMulheresPaz = "Marinha capacita 86 mulheres, de 23 países, em Curso de Operações de Paz no Rio: Alunas, civis e militares, brasileiras e estrangeiras, passaram por uma imersão de cinco dias no Centro de Operações de Paz e Humanitárias de Caráter Naval.\n\nO Centro de Operações de Paz e Humanitárias de Caráter Naval (COpPazNav) capacitou 86 mulheres, de 23 países, nos últimos cinco dias, para atuar em missões de paz da Organização das Nações Unidas (ONU). O Centro, localizado no Complexo Naval da Ilha do Governador (RJ), realizou o Curso de Operações de Paz para Mulheres, que recebeu civis e militares, brasileiras e estrangeiras, dos cinco continentes, além de estudantes de 10 universidades e jornalistas de quatro veículos de comunicação.\n\nPara o Comandante-Geral do Corpo de Fuzileiros Navais, Almirante de Esquadra (Fuzileiro Naval) Carlos Chagas Vianna Braga, que ministrou a aula inaugural, o curso é um projeto muito bem-sucedido. “Começamos há alguns anos e estamos muito orgulhosos de conduzir mais uma edição desse curso no Centro de Operações de Paz e Humanitárias de Caráter Naval. Especialmente, estamos comemorando 25 anos da agenda Mulheres, Paz e Segurança, momento muito importante no Brasil, nas Nações Unidas e no mundo. Temos aqui reunidas mulheres de todos os continentes do planeta, o que demonstra claramente a contribuição desse Centro para a promoção da paz e a da segurança internacional”, afirmou o Almirante Carlos Chagas.\n\nO Curso de Operações de Paz para Mulheres do COpPazNav é realizado anualmente, nas versões nacional e internacional. O curso conta com a parceria do Ministério da Defesa e da Agência Brasileira de Cooperação (ABC), do Ministério das Relações Exteriores, para que nações em desenvolvimento tenham a oportunidade de realizar o treinamento. Em sua 14ª edição, o treinamento teve como propósito ampliar a capacitação de mulheres em Operações de Paz, destacar o impacto da presença feminina na busca de soluções pacíficas e sustentáveis e incentivar o networking internacional entre as alunas.\n\nUm dos grandes destaques da programação foi a presença da Conselheira Militar para Operações de Paz da Organização das Nações Unidas (ONU), General de Divisão Cheryl Pearce, da Austrália, que proferiu uma palestra para as alunas e acompanhou algumas das atividades. Em sua apresentação, a General Pearce destacou a importância da presença feminina nas missões de paz da ONU. “Muitas das nossas missões têm um mandato explícito de proteção de civis. Para estarmos nas comunidades e interagirmos para entender os seus riscos de segurança, a sua saúde, todas as suas preocupações, precisamos dialogar com homens e mulheres. Muitas das mulheres não estão preparadas para falar com um grupo de homens. Elas querem poder falar com mulheres. Querem poder comunicar num local onde se sintam seguras e poder partilhar os seus pensamentos e preocupações”, afirmou a principal autoridade militar da ONU.\n\nPara a líder de esquadrão da Força Aérea Nigeriana, Abigail Ologun, as palestras foram enriquecedoras: “É muito importante que as mulheres que participaram dessas missões nos falem de suas experiências. Ver colegas mulheres fazendo sucesso, mudando o mundo, é realmente algo encorajador. A General veio e nos fez entender que podemos fazer sucesso. Podemos conseguir mais do que os homens podem na operação de manutenção da paz. Aprendi muito sobre as diferentes missões das Nações Unidas e, tendo o conhecimento sobre aquelas que serviram e nos deram seus testemunhos, poderemos aplicá-lo em uma futura designação para esse tipo de missão”, disse.\n\nDe acordo com a Capitão (Médica) das Forças Armadas de Cabo Verde, Ana Cristina Mendonça, estar no curso é uma oportunidade única: “Há muito tempo já tinha ouvido falar dos ‘capacetes azuis’. Sempre tive essa curiosidade de servir. O meu objetivo é servir ao meu país no mais alto nível, em nível humanitário e em nível mundial. Essa oportunidade foi uma porta de entrada para mim. O curso foi muito proveitoso e enriquecedor. Aprender sempre para melhor servir”, garantiu a médica. O curso também foi uma oportunidade inédita para a Suboficial da Marinha Inglesa Sarah Rushton: “É a minha primeira vez no Brasil e eu não participei de nada sobre as Operações de Paz da ONU antes. É muito interessante, especialmente sob uma perspectiva feminina, ouvir dessas mulheres, de diferentes países, o que elas fizeram e fazem”, relatou. As práticas do curso de Operações de Paz para Mulheres envolveram situações de resgate, sobrevivência e tomada de decisões. Essas habilidades são necessárias para as mulheres atuarem em missões localizadas em países com instabilidades políticas, graves dificuldades sociais e de segurança. A brasileira do Corpo de Bombeiros Militar do Estado do Rio de Janeiro (CBMERJ), Capitão Ana Carolina Panza, considera que o curso contribuiu para a sua formação pessoal e profissional. “Eu recebi a indicação de outras militares do Corpo de Bombeiros que já fizeram esse curso em edições anteriores. Minha expectativa é aprender bastante sobre as missões. Fazer integração com outros povos e culturas de outros países. Fora do Corpo de Bombeiros, eu sou estudante de Geografia, então, para mim, esse curso foi de grande valia”, lembrou.";

        $questions = [
            // PORTUGUÊS (1-20)
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textRadioisotopos,
                'text' => 'Qual é o principal objetivo da produção do radioisótopo Lutécio-177 no Brasil?',
                'options' => [
                    'Promover o desenvolvimento de armas nucleares.',
                    'Exportar radioisótopos para países vizinhos.',
                    'Ampliar o uso da energia nuclear na agricultura.',
                    'Utilizar o material em tratamentos médicos, especialmente contra o câncer.',
                    'Substituir completamente o uso de outros radioisótopos como o Iodo-131.'
                ],
                'correct_answer' => 3,
                'rationale' => 'O texto afirma explicitamente que o Lutécio-177 é utilizado no tratamento de tumores neuroendócrinos e no combate ao câncer de próstata.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textRadioisotopos,
                'text' => 'Segundo o texto, qual instituição colabora com a Marinha do Brasil na produção de radioisótopos?',
                'options' => [
                    'Petrobras',
                    'Instituto Butantan.',
                    'IPEN – Instituto de Pesquisas Energéticas e Nucleares.',
                    'INMETRO',
                    'Ministério da Saúde.'
                ],
                'correct_answer' => 2,
                'rationale' => 'A parceria mencionada em todo o texto é entre a Marinha do Brasil (MB) e o IPEN.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textRadioisotopos,
                'text' => 'Qual foi o resultado do desempenho dos militares nos processos de licenciamento da CNEN?',
                'options' => [
                    'Apenas 50% de aprovação.',
                    'Nenhum militar foi aprovado.',
                    '75% de aprovação, com destaque negativo.',
                    'A maioria desistiu do processo.',
                    '100% de aprovação.'
                ],
                'correct_answer' => 4,
                'rationale' => 'O texto destaca: "Os militares da Marinha alcançaram 100% de aprovação nos processos de licenciamento da CNEN".',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textRadioisotopos,
                'text' => 'Qual dos benefícios abaixo NÃO é citado no texto como resultado da produção nacional de radioisótopos?',
                'options' => [
                    'Redução da dependência externa.',
                    'Geração de economia significativa.',
                    'Aumento da autonomia científica e tecnológica.',
                    'Exportação em larga escala para países da América Latina.',
                    'Ampliação do acesso da população a terapias nucleares.'
                ],
                'correct_answer' => 3,
                'rationale' => 'O texto menciona a redução de importações e autonomia, mas não cita a exportação em larga escala para a América Latina como um benefício atual.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textRadioisotopos,
                'text' => 'Que fato marcou simbolicamente a divulgação dos primeiros resultados da produção de Lutécio-177?',
                'options' => [
                    'A visita do presidente da República ao IPEN.',
                    'A celebração dos 69 anos de fundação do IPEN.',
                    'A inauguração de um novo laboratório em Brasília.',
                    'A criação de um novo curso de medicina nuclear.',
                    'A premiação de cientistas do IPEN no exterior.'
                ],
                'correct_answer' => 1,
                'rationale' => 'O texto informa que a divulgação ocorreu na data em que o Instituto celebrou 69 anos de fundação.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textRadioisotopos,
                'text' => 'De acordo com o texto, o reator IEA-R1 passou a operar em regime contínuo para a produção de:',
                'options' => [
                    'Moléculas de alto valor para a indústria bélica.',
                    'Tecnologia para submarinos nucleares.',
                    'Radioisótopos para aplicações médicas e industriais.',
                    'Energia elétrica para a Radiofarmácia do IPEN.',
                    'Insumos para a agricultura de exportação.'
                ],
                'correct_answer' => 2,
                'rationale' => 'O texto afirma que o reator opera para a produção de radioisótopos, substâncias utilizadas principalmente em aplicações médicas e industriais.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textRadioisotopos,
                'text' => 'No trecho “...esses militares estão servindo e prestando um serviço para produzir o bem...”, o verbo está no modo:',
                'options' => [
                    'Subjuntivo.',
                    'Imperativo.',
                    'Condicional.',
                    'Indicativo.',
                    'Infinitivo.'
                ],
                'correct_answer' => 3,
                'rationale' => 'O modo indicativo expressa uma certeza, um fato real que ocorre no presente.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textRadioisotopos,
                'text' => 'Qual dos pronomes abaixo aparece no texto com valor demonstrativo?',
                'options' => [
                    'Eu.',
                    'Esse.',
                    'Algum.',
                    'Nosso.',
                    'Ninguém.'
                ],
                'correct_answer' => 1,
                'rationale' => '“Esse” é um pronome demonstrativo usado para retomar algo mencionado anteriormente ou indicar proximidade.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textRadioisotopos,
                'text' => 'Em “A gente fica feliz porque é um processo difícil...”, o termo “porque” é uma conjunção:',
                'options' => [
                    'Aditiva.',
                    'Explicativa.',
                    'Causal.',
                    'Concessiva.',
                    'Conclusiva.'
                ],
                'correct_answer' => 2,
                'rationale' => 'Conforme a alteração solicitada (gabarito oficial), o termo "porque" introduz a causa de estarem felizes.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textRadioisotopos,
                'text' => 'Em “...prestando um serviço...”, o artigo “um” é:',
                'options' => [
                    'Definido, pois especifica o serviço.',
                    'Indefinido, pois generaliza o serviço.',
                    'Definido, pois acompanha nome próprio.',
                    'Indefinido, com valor de numeral.',
                    'Indefinido, com valor demonstrativo.'
                ],
                'correct_answer' => 1,
                'rationale' => 'O artigo "um" é indefinido porque não especifica qual serviço exatamente está sendo prestado, tratando-o de forma genérica.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textMulheresPaz,
                'text' => 'Qual foi o objetivo principal do curso promovido pela Marinha no Rio de Janeiro?',
                'options' => [
                    'Treinar soldados para o combate armado.',
                    'Promover o turismo entre mulheres estrangeiras.',
                    'Capacitar mulheres para atuar em missões de paz da ONU.',
                    'Recrutar novas integrantes para a Marinha brasileira.',
                    'Ensinar técnicas de defesa pessoal em áreas de risco.'
                ],
                'correct_answer' => 2,
                'rationale' => 'O texto afirma que o COpPazNav capacitou mulheres para atuar em missões de paz da Organização das Nações Unidas (ONU).',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textMulheresPaz,
                'text' => 'De acordo com o texto, qual foi a nacionalidade da Conselheira Militar da ONU que participou do evento?',
                'options' => [
                    'Brasileira.',
                    'Nigeriana.',
                    'Inglesa.',
                    'Australiana.',
                    'Cabo-verdiana.'
                ],
                'correct_answer' => 3,
                'rationale' => 'A General de Divisão Cheryl Pearce é identificada no texto como sendo da Austrália.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textMulheresPaz,
                'text' => 'Qual foi a motivação da Capitão Ana Carolina Panza, do Corpo de Bombeiros do RJ, para participar do curso?',
                'options' => [
                    'Treinamento obrigatório pela ONU.',
                    'Convite do Ministério da Defesa.',
                    'Indicação de colegas e interesse acadêmico.',
                    'Viagem para o exterior.',
                    'Cumprimento de horas complementares da universidade.'
                ],
                'correct_answer' => 2,
                'rationale' => 'Ela menciona ter recebido indicação de outras militares e que, sendo estudante de Geografia, o curso seria de grande valia.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textMulheresPaz,
                'text' => 'O curso promovido pela Marinha e suas instituições parceiras tem como um dos propósitos principais:',
                'options' => [
                    'Ampliar o contingente militar das forças armadas brasileiras.',
                    'Capacitar mulheres exclusivamente brasileiras para missões da ONU.',
                    'Estimular a rivalidade entre nações em desenvolvimento.',
                    'Ampliar a participação feminina nas Operações de Paz com impacto sustentável e troca internacional.',
                    'Tornar o Brasil referência em formação bélica e estratégica no hemisfério sul.'
                ],
                'correct_answer' => 3,
                'rationale' => 'O treinamento visa destacar o impacto da presença feminina na busca de soluções pacíficas e sustentáveis e incentivar o networking internacional.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'base_text' => $textMulheresPaz,
                'text' => 'A importância do curso é reforçada ao longo do texto por:',
                'options' => [
                    'Focar na capacitação de apenas mulheres brasileiras.',
                    'Estar em sua primeira edição experimental.',
                    'Ser realizado exclusivamente por instituições estrangeiras.',
                    'Reunir mulheres de diferentes países e promover a troca de experiências.',
                    'Ter duração de apenas um dia com atividades teóricas.'
                ],
                'correct_answer' => 3,
                'rationale' => 'A diversidade de participantes (86 mulheres de 23 países) e a troca internacional são pontos centrais do texto.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'text' => 'Na frase “86 mulheres, de 23 países”, os numerais são classificados como:',
                'options' => [
                    'Ordinais.',
                    'Fracionários.',
                    'Multiplicativos.',
                    'Cardinais.',
                    'Indefinidos.'
                ],
                'correct_answer' => 3,
                'rationale' => 'Numerais cardinais são aqueles que indicam quantidade exata (um, dois, oitenta e seis...).',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'text' => 'No trecho “...e incentivar o networking internacional...”, a conjunção “e” é:',
                'options' => [
                    'Alternativa.',
                    'Conclusiva.',
                    'Causal.',
                    'Aditiva.',
                    'Adversativa.'
                ],
                'correct_answer' => 3,
                'rationale' => 'A conjunção "e" liga elementos ou orações indicando soma ou adição de ideias.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'text' => 'A palavra “missões” é:',
                'options' => [
                    'Oxítona terminada em “es”.',
                    'Paroxítona com ditongo decrescente.',
                    'Proparoxítona com hiato.',
                    'Paroxítona terminada em ditongo.',
                    'Oxítona com ditongo nasal.'
                ],
                'correct_answer' => 4,
                'rationale' => 'A sílaba tônica é a última (mis-SÕES), caracterizando uma oxítona. O final possui um ditongo nasal (ões).',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'text' => 'Em “As mulheres participaram do curso”, o sujeito é:',
                'options' => [
                    'Simples.',
                    'Composto.',
                    'Oculto.',
                    'Inexistente.',
                    'Indeterminado.'
                ],
                'correct_answer' => 0,
                'rationale' => 'O sujeito possui apenas um núcleo (mulheres), sendo classificado como simples.',
            ],
            [
                'subject' => 'portugues',
                'block' => 10,
                'text' => 'Na frase: “A general proferiu uma palestra”, “uma palestra” é:',
                'options' => [
                    'Complemento nominal',
                    'Adjunto adverbial.',
                    'Objeto direto.',
                    'Objeto indireto.',
                    'Aposto.'
                ],
                'correct_answer' => 2,
                'rationale' => 'Quem profere, profere algo. "Uma palestra" completa o sentido do verbo transitivo direto "proferir" sem auxílio de preposição.',
            ],

            // MATEMÁTICA (21-40)
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Qual é o valor de 6/3 + 2/4?',
                'options' => ['3,50', '3,75', '3,25', '2,50', '2,75'],
                'correct_answer' => 3,
                'rationale' => '6 ÷ 3 = 2. 2 ÷ 4 = 0,5. Somando: 2 + 0,5 = 2,50.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Um navio percorre 225 km em 7,5 horas. Qual a razão entre a distância percorrida pelo navio e o intervalo de tempo necessário para percorrê-la (velocidade média)?',
                'options' => ['20 km/h', '30 km/h', '40 km/h', '50 km/h', '60 km/h'],
                'correct_answer' => 1,
                'rationale' => 'Razão = Distância / Tempo = 225 / 7,5 = 30 km/h.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Qual é o valor de 0,25 × 240?',
                'options' => ['48', '50', '60', '72', '75'],
                'correct_answer' => 2,
                'rationale' => '0,25 é o mesmo que 1/4. 1/4 × 240 = 240 ÷ 4 = 60.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Um navio consome 100 litros de combustível por hora. Quantos litros consumirá em 4 horas e 15 minutos?',
                'options' => ['350', '375', '400', '450', '425'],
                'correct_answer' => 4,
                'rationale' => '15 minutos = 0,25 horas. Tempo total = 4,25 h. Consumo = 100 × 4,25 = 425 litros.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Qual é o valor de (√169) / 1000?',
                'options' => ['130', '13', '1,3', '0,13', '0,013'],
                'correct_answer' => 4,
                'rationale' => '√169 = 13. Então 13 / 1000 = 0,013.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Um navio transporta 1.600 toneladas de carga. Se 75% da carga é descarregada, quantas toneladas de carga ainda restam no navio?',
                'options' => ['400', '350', '300', '250', '200'],
                'correct_answer' => 0,
                'rationale' => 'Carga restante = 100% - 75% = 25%. 25% de 1600 = 0,25 × 1600 = 400 toneladas.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Qual é o valor de 5⁴ / 100?',
                'options' => ['62,5', '6,25', '0,625', '0,0625', '0,00625'],
                'correct_answer' => 1,
                'rationale' => '5⁴ = 5 × 5 × 5 × 5 = 625. 625 / 100 = 6,25.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Durante uma viagem, 15% dos 500 tripulantes do navio de cruzeiro Vasco da Gama ficaram doentes. Quantos tripulantes adoeceram?',
                'options' => ['25', '50', '125', '100', '75'],
                'correct_answer' => 4,
                'rationale' => '15% de 500 = 0,15 × 500 = 75.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Qual é o valor de (3/7) × 35?',
                'options' => ['6', '15', '12', '9', '18'],
                'correct_answer' => 1,
                'rationale' => '(3 × 35) / 7 = 3 × (35 / 7) = 3 × 5 = 15.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Um tanque com capacidade máxima de 2.000 litros está com 1.500 litros de óleo. Qual a porcentagem da capacidade máxima do tanque que está ocupada com óleo?',
                'options' => ['60%', '65%', '70%', '72%', '75%'],
                'correct_answer' => 4,
                'rationale' => '(1500 / 2000) × 100 = 0,75 × 100 = 75%.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Qual é o valor de ³√3¹²?',
                'options' => ['27', '63', '36', '81', '9'],
                'correct_answer' => 3,
                'rationale' => '³√3¹² = 3^(12/3) = 3⁴ = 3 × 3 × 3 × 3 = 81.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Qual é o valor de 11/15 − 1/3?',
                'options' => ['1/5', '21/10', '3/5', '21/40', '2/5'],
                'correct_answer' => 4,
                'rationale' => 'MDC(15,3) = 15. Então: 11/15 - 5/15 = 6/15 = 2/5.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Qual é o valor de √196 / 10?',
                'options' => ['1,2', '1,3', '1,6', '1,5', '1,4'],
                'correct_answer' => 4,
                'rationale' => '√196 = 14. Então 14 / 10 = 1,4.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Em uma embarcação, as manutenções periódicas de três motores devem ser realizadas a cada 30, 36 e 45 dias, respectivamente. Se em determinado dia a manutenção dos três motores coincidiu, após quantos dias essas manutenções coincidirão novamente?',
                'options' => ['72', '90', '180', '135', '210'],
                'correct_answer' => 2,
                'rationale' => 'Calculando o MMC(30, 36, 45) = 180.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Em um navio de carga há dois tambores cheios de óleo lubrificante e com capacidades de 240 litros e 360 litros. O comandante deseja dividir esse óleo em tambores menores com a mesma quantidade de litros em cada um. Qual o maior volume possível de óleo em cada tambor menor após a divisão?',
                'options' => ['20', '40', '120', '80', '60'],
                'correct_answer' => 2,
                'rationale' => 'Calculando o MDC(240, 360) = 120.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Um motor consome 2,75 L/h de óleo. Qual o consumo em 24 horas?',
                'options' => ['64,5 L', '65,5 L', '65,0 L', '66,0 L', '64,0 L'],
                'correct_answer' => 3,
                'rationale' => 'Consumo = 2,75 × 24 = 66 litros.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Um tanque de óleo tinha 1.000 litros e recebeu mais 250 litros. Qual foi o aumento percentual?',
                'options' => ['20%', '35%', '28%', '30%', '25%'],
                'correct_answer' => 4,
                'rationale' => 'Aumento = (250 / 1000) × 100 = 25%.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Um marinheiro tem duas cordas de 36 m e 54 m e deseja cortá-las em pedaços de mesmo comprimento, sem sobras. Qual o maior tamanho possível desses pedaços?',
                'options' => ['8 m', '12 m', '32 m', '24 m', '18 m'],
                'correct_answer' => 4,
                'rationale' => 'Calculando o MDC(36, 54) = 18.',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Um convés retangular de um navio tem 30 metros de comprimento e 7 metros de largura. Qual é a área desse convés?',
                'options' => ['210 m²', '110 m²', '180 m²', '77 m²', '250 m²'],
                'correct_answer' => 0,
                'rationale' => 'Área = Comprimento × Largura = 30 × 7 = 210 m².',
            ],
            [
                'subject' => 'matematica',
                'block' => 10,
                'text' => 'Um navio tem uma escotilha quadrada com 50 cm de lado. Qual é a área dessa escotilha em dm²?',
                'options' => ['5 dm²', '25 dm²', '15 dm²', '20 dm²', '10 dm²'],
                'correct_answer' => 1,
                'rationale' => 'Lado = 50 cm = 5 dm. Área = 5 × 5 = 25 dm².',
            ],
        ];

        foreach ($questions as $q) {
            Question::create($q);
        }
    }
}
