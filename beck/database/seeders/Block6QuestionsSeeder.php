<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class Block6QuestionsSeeder extends Seeder
{
    public function run(): void
    {
        $baseTextPort = "Reciclagem ambientalmente adequada de navios é meta para 2025. O Brasil se prepara para adaptar sua frota de navios mercantes às exigências da Convenção Internacional de Hong Kong para a Reciclagem Segura e Ambientalmente Adequada de Navios, da Organização Marítima Internacional (IMO, da sigla em inglês), que deve entrar em vigor em junho de 2025. A Comissão Coordenadora para os Assuntos da IMO (CCA-IMO), Colegiado interministerial coordenado pela Marinha do Brasil e formado por representantes de 14 órgãos da administração pública federal, deu início ao processo, com proposta encaminhada para o Ministério das Relações Exteriores. Os ministérios envolvidos devem emitir pareceres sobre o documento, que então será remetido pela Casa Civil da Presidência da República ao Congresso Nacional, para apreciação das comissões pertinentes e do plenário de ambas as casas. A Convenção prevê medidas para prevenir e minimizar os riscos ambientais, de saúde ocupacional e de segurança, relacionados à reciclagem de navios, considerando as características específicas do transporte marítimo e a necessidade de assegurar, ao final de suas vidas úteis, a retirada adequada do ambiente. Uma vez que a Convenção entre em vigor internacionalmente e o Brasil finalize os processos de adesão junto à IMO e de internalização no arcabouço legal nacional, os desafios relativos à implementação de suas disposições surgirão. Assim sendo, a Autoridade Marítima Brasileira realizará a normatização das ações, em sua área de competência, devendo ocorrer o mesmo no âmbito das demais autoridades envolvidas. Caso pertinente, poderá ocorrer a busca por apoio técnico e treinamento no âmbito da IMO, a qual conta com um extenso programa de cooperação técnica.";

        $questions = [
            // PORTUGUES - Q1 to Q20
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Marque a opção em que a palavra extraída do texto pode ser classificada, quanto à sílaba tônica, exclusivamente como paroxítona:',
                'options' => ['marítimo', 'exigências', 'pública', 'prepara', 'plenário'],
                'correct_answer' => 3, // D
                'rationale' => 'Vamos analisar a tonicidade de cada palavra:\n(A) ma-rí-ti-mo (Proparoxítona). \n(B) e-xi-gên-cias (Paroxítona terminada em ditongo, alguns gramáticos classificam como proparoxítonas aparentes). \n(C) pú-bli-ca (Proparoxítona). \n(D) pre-pa-ra (Paroxítona clássica, a sílaba forte é PA). Esta é a única EXCLUSIVAMENTE paroxítona sem margem para dupla interpretação. \n(E) ple-ná-rio (Mesmo caso da B).',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Lido o texto de modo atento e considerada a sua estrutura e o seu conteúdo, pode-se interpretá-lo como pertencente ao gênero:',
                'options' => ['solilóquio', 'notícia', 'crônica', 'epístola', 'artigo de opinião'],
                'correct_answer' => 1, // B
                'rationale' => 'O texto tem como objetivo principal informar sobre um fato atual e relevante (a preparação do Brasil para a Convenção da IMO). Ele apresenta linguagem objetiva, impessoal e relata acontecimentos, características típicas do gênero Notícia.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'No texto, o termo preposicionado que sucede imediatamente o núcleo “Marinha” na expressão “Marinha do Brasil”, é uma locução:',
                'options' => ['adjetiva', 'adverbial', 'verbal', 'pronominal', 'prepositiva'],
                'correct_answer' => 0, // A
                'rationale' => 'A expressão “do Brasil” está ligada ao substantivo “Marinha”, caracterizando-o e indicando sua origem/posse. Termos preposicionados que têm valor de adjetivo (caracterizam um substantivo) são chamados de Locuções Adjetivas.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“ (…) considerando as características específicas do transporte marítimo e a necessidade de assegurar, ao final de suas vidas úteis, a retirada adequada do ambiente” (2º§). O termo em destaque (retirada) é formado por:',
                'options' => ['oneonímia', 'derivação imprópria', 'derivação sufixal', 'derivação regressiva', 'derivação parassintética'],
                'correct_answer' => 2, // C
                'rationale' => 'A palavra “retirada” deriva do verbo “retirar”. O processo ocorre pelo acréscimo do sufixo “-ada” ao radical verbal, transformando a ação em um substantivo (o ato de retirar). Portanto, derivação sufixal.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“Os ministérios envolvidos devem emitir pareceres sobre o documento, que então será remetido pela Casa Civil...” (2º§). O termo destacado (que) deve ser classificado corretamente como um(a):',
                'options' => ['pronome interrogativo', 'conjunção subordinativa adverbial', 'conjunção integrante', 'pronome indefinido', 'pronome relativo'],
                'correct_answer' => 4, // E
                'rationale' => 'Para identificar o Pronome Relativo, tente substituí-lo por “o qual” (e variações). “...sobre o documento, O QUAL então será remetido...”. Como ele retoma o termo anterior “documento” e introduz uma nova oração sobre ele, é um Pronome Relativo.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'A palavra “frota”, no primeiro período do primeiro parágrafo do texto, em relação ao verbo “adaptar”, exerce a função sintática de núcleo do:',
                'options' => ['complemento nominal', 'objeto direto', 'sujeito', 'objeto direto preposicionado', 'objeto indireto não preposicionado'],
                'correct_answer' => 1, // B
                'rationale' => 'Analise a regência do verbo: Quem adapta, adapta ALGO. O verbo “adaptar” é Transitivo Direto. O termo que completa seu sentido sem preposição (“sua frota”) é o Objeto Direto.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Um exemplo de substantivo abstrato encontrado no texto é:',
                'options' => ['plenário', 'reciclagem', 'navios', 'frotas', 'pareceres'],
                'correct_answer' => 1, // B
                'rationale' => 'Substantivos abstratos nomeiam ações, estados, qualidades ou sentimentos que dependem de outro ser para existir. “Reciclagem” é o nome de uma AÇÃO (ato de reciclar), logo é abstrato. Já “Navios”, “Plenário” e “Frotas” são concretos.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“A Convenção prevê medidas para prevenir e minimizar os riscos… (2º§)”. Se o sujeito fosse “As convenções”, o verbo destacado seria:',
                'options' => ['prevejem', 'prevêm', 'prevêem', 'preveem', 'prevém'],
                'correct_answer' => 3, // D
                'rationale' => 'Atenção à Nova Ortografia: Verbos terminados em -eem (crer, dar, ler, ver e seus derivados como PREVER) dobram o "e" na 3ª pessoa do plural, mas PERDERAM o acento circunflexo. Correto: “Elas preveem”.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“Caso pertinente, poderá ocorrer a busca por apoio técnico...” (4º§). Se reescrevêssemos esse mesmo verbo no futuro do pretérito do modo indicativo, teríamos:',
                'options' => ['pôde', 'podia', 'poderão', 'pudera', 'poderia'],
                'correct_answer' => 4, // E
                'rationale' => 'O Futuro do Pretérito indica algo que “aconteceria” se uma condição fosse satisfeita. Sua desinência típica é “-ria”. Portanto: Poderá (Futuro do Presente) -> Poderia (Futuro do Pretérito).',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“A Comissão Coordenadora para os Assuntos da IMO (CCA-IMO), Colegiado interministerial coordenado pela Marinha do Brasil..., deu início ao processo…” (1º§). As vírgulas nesse trecho foram empregadas para:',
                'options' => ['isolar um aposto', 'indicar um verbo implícito', 'isolar um adjunto longo deslocado', 'isolar uma retificação', 'isolar um termo de valor conclusivo'],
                'correct_answer' => 0, // A
                'rationale' => 'O trecho entre vírgulas (“Colegiado interministerial...”) serve para EXPLICAR quem é a “Comissão Coordenadora”. Termos explicativos que se referem a um substantivo anterior são chamados de Apostos e devem vir entre pontuação.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Assinale a alternativa FALSA:',
                'options' => ['A expressão “Assim sendo” introduz conclusão.', 'O núcleo do sujeito do verbo “deu” é “Comissão”.', 'A expressão “Uma vez que” foi empregada com valor de tempo.', 'A palavra “caso” é conjunção condicional.', 'O verbo “surgirão” está no futuro do presente.'],
                'correct_answer' => 2, // C
                'rationale' => 'Analise o sentido: “Uma vez que a Convenção entre em vigor...” significa “JÁ QUE” ou “PORQUE”. É uma locução conjuntiva CAUSAL, não temporal. Por isso essa é a alternativa falsa.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“...Convenção Internacional..., da Organização Marítima Internacional..., que deve entrar em vigor em junho de 2025”. O termo em evidência (que) está diretamente relacionado ao núcleo:',
                'options' => ['Brasil', 'Reciclagem', 'Hong Kong', 'Convenção', 'IMO'],
                'correct_answer' => 3, // D
                'rationale' => 'Interpretação de texto: O que vai entrar em vigor em 2025? O texto diz no início: “...exigências da Convenção Internacional... que deve entrar em vigor”. O pronome “que” retoma o sujeito central da oração, a Convenção.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“Assim sendo, a Autoridade Marítima Brasileira realizará a normatização...” (3º§). A primeira vírgula nesse trecho:',
                'options' => ['foi empregada incorretamente', 'é obrigatória, isola termo conclusivo', 'foi empregada para isolar aposto', 'é facultativa (termo curto)', 'é facultativa (adjunto adverbial)'],
                'correct_answer' => 1, // B
                'rationale' => '“Assim sendo” é uma expressão conectiva de conclusão. Quando ela inicia a frase ou está deslocada, a vírgula é obrigatória para marcar essa pausa e a separação da oração principal.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Assinale a opção em que o termo foi formado pelo processo de derivação regressiva:',
                'options' => ['ambas', 'reciclagem', 'busca', 'cooperação', 'navios'],
                'correct_answer' => 2, // C
                'rationale' => 'Derivação Regressiva cria substantivos abstratos a partir de verbos, geralmente trocando a terminação verbal por -a, -o ou -e. Buscar -> Busca. Combater -> Combate. As outras palavras são primitivas ou derivadas por sufixo.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Assinale a opção em que ambos os verbos não possuem a primeira pessoa do singular, do presente do modo indicativo (verbos defectivos):',
                'options' => ['reaver e aderir', 'aderir e falir', 'precaver e pressupor', 'colorir e falir', 'precaver e haver'],
                'correct_answer' => 3, // D
                'rationale' => 'Verbos Defectivos são aqueles que não têm conjugação completa. \n- COLORIR: Não existe “eu coloro”. \n- FALIR: Não existe “eu falo” (do verbo falir). \nJá “Aderir” (eu adiro) e “Haver” (eu hei) são conjugáveis na 1ª pessoa.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'A vírgula antes do “que” neste trecho: “... (IMO, da sigla em inglês), que deve entrar em vigor em junho de 2025” foi empregada:',
                'options' => ['para introduzir trecho de valor explicativo', 'a fim de substituir um verbo', 'com objetivo de indicar OD preposicionado', 'obrigatoriedade antes de pronomes relativos', 'para isolar adjunto longo'],
                'correct_answer' => 0, // A
                'rationale' => 'Em orações adjetivas, a vírgula antes do pronome relativo muda o sentido de Restritivo para Explicativo. Com a vírgula, a oração adiciona uma informação extra/explicativa sobre o termo anterior.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“Caso pertinente, poderá ocorrer ...”. O único termo que foi acentuado em obediência à mesma regra aplicada ao termo destacado (técnico/específicas) é:',
                'options' => ['realizará', 'normatização', 'inglês', 'específicas', 'úteis'],
                'correct_answer' => 3, // D
                'rationale' => 'O termo destacado no texto original era uma Proparoxítona (provavelmente “técnico” ou “âmbito”). A regra das proparoxítonas é: TODAS são acentuadas. A única opção que também é proparoxítona é “Es-pe-cí-fi-cas”. (Realizará é oxítona, Úteis é paroxítona).',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'A expressão “a qual” no fim do último parágrafo é:',
                'options' => ['locução conjuntiva', 'conjunção integrante', 'pronome indefinido', 'pronome relativo', 'pronome interrogativo'],
                'correct_answer' => 3, // D
                'rationale' => '“O qual”, “A qual” e seus plurais são Pronomes Relativos por excelência, utilizados para retomar termos antecedentes evitando repetição e concordando em gênero e número.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Marque a única alternativa em que o termo destacado é um adjetivo.',
                'options' => ['mercantes', 'surgirão', 'documento', 'casas', 'IMO'],
                'correct_answer' => 0, // A
                'rationale' => '(A) Navios MERCANTES -> Caracteriza o navio (Adjetivo). \n(B) Surgirão -> Ação (Verbo). \n(C) Documento -> Nome (Substantivo). \n(D) Casas -> Nome (Substantivo). \n(E) IMO -> Nome/Sigla (Substantivo).',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'A leitura atenta do texto permite interpretar que seu principal objetivo é:',
                'options' => ['argumentar contra as adaptações', 'discutir pontos de vista', 'informar sobre as adaptações', 'dar instruções práticas', 'narrar eventos passados'],
                'correct_answer' => 2, // C
                'rationale' => 'O texto não é opinativo (argumentar) nem instrucional (dar passo a passo). Seu foco é apresentar fatos e dados sobre o processo de adaptação, ou seja, INFORMAR o leitor.',
                'block' => 6
            ],

            // MATEMATICA - Q21 to Q40
            [
                'subject' => 'matematica',
                'text' => 'O número m ≠ 0 tem inverso igual a n. Sabendo-se que (m + n) = 2, qual o valor de (m³ + n³) . (m⁴ − n⁴)?',
                'options' => ['0', '8', '6', '4', '2'],
                'correct_answer' => 0, // A
                'rationale' => '1. Se n é o inverso de m, então n = 1/m. \n2. Temos m + 1/m = 2. Multiplicando tudo por m: m² + 1 = 2m => m² - 2m + 1 = 0. \n3. Isso é um trinômio quadrado perfeito: (m - 1)² = 0, logo m = 1. \n4. Se m=1, então n=1. \n5. A expressão pede (m⁴ − n⁴). Isso seria (1⁴ - 1⁴) = 1 - 1 = 0. \n6. Qualquer valor multiplicado por 0 é 0.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'A diferença entre o comprimento a e a largura b de um retângulo é de 2 cm. Se sua área é menor que 35 cm², então o valor de a, em cm (considerando a solução algébrica da inequação), será:',
                'options' => ['0 < x < 7', '4 < x < 6', '0 < x < 2', '4 < x < 7', '7 < x < 12'],
                'correct_answer' => 0, // A
                'rationale' => '1. Dados: a - b = 2 => b = a - 2. Área < 35. \n2. Área = a * b = a(a-2) = a² - 2a. \n3. Inequação: a² - 2a - 35 < 0. \n4. Raízes de a² - 2a - 35 = 0: (2 ± √(4 - 4*1*(-35)))/2 = (2±12)/2. Raízes: 7 e -5. \n5. A parábola é negativa ENTRE as raízes: -5 < a < 7. \n6. Como "a" é uma medida de comprimento, deve ser positivo (>0). Logo, o intervalo válido é 0 < x < 7.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um número é formado por 3 algarismos (5 d 2). Sabendo-se que S é a soma dos possíveis valores que o algarismo da dezena (d) poderá assumir para que este número seja divisível por 4, então √S será:',
                'options' => ['7', '11', '9', '5', '3'],
                'correct_answer' => 3, // D
                'rationale' => '1. Critério de divisibilidade por 4: Os dois últimos algarismos devem formar um número divisível por 4. \n2. O número termina em "d2". \n3. Testando dígitos de 0 a 9: \n - 02 (Não) \n - 12 (Sim, 12/4=3) -> d=1 \n - 22 (Não) \n - 32 (Sim, 32/4=8) -> d=3 \n - 42 (Não) \n - 52 (Sim) -> d=5 \n - 62 (Não) \n - 72 (Sim) -> d=7 \n - 82 (Não) \n - 92 (Sim) -> d=9 \n4. Valores possíveis: 1, 3, 5, 7, 9. \n5. Soma S = 1+3+5+7+9 = 25. \n6. A questão pede √S => √25 = 5.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Uma fábrica engarrafa 3000 refrigerantes em 6 horas. Quantas horas levará para engarrafar 4000 refrigerantes?',
                'options' => ['10', '12', '8', '16', '14'],
                'correct_answer' => 2, // C
                'rationale' => 'Regra de três simples: \n 3000 ref --- 6h \n 4000 ref --- x \n 3000x = 24000 \n x = 24000 / 3000 = 24/3 = 8 horas.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'A diferença entre o maior número ímpar de cinco algarismos diferentes e o menor número par de cinco algarismos diferentes é:',
                'options' => ['88531', '81549', '88529', '77777', '78925'],
                'correct_answer' => 0, // A
                'rationale' => '1. Maior Ímpar de 5 algarismos diferentes: Começa com 9876... \n   Para ser maior, o último deve ser o maior ímpar restante. Dígitos: 9, 8, 7, 6, 5. Número: 98765. \n2. Menor Par de 5 algarismos diferentes: Começa com 1 (não 0). Segue com 0, 2, 3, 4. Número: 10234. \n3. Diferença: 98765 - 10234 = 88531.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'A soma de três números inteiros consecutivos é igual a 90. Qual é o maior destes três números?',
                'options' => ['32', '31', '29', '28', '21'],
                'correct_answer' => 1, // B
                'rationale' => '1. Números consecutivos: x, x+1, x+2. \n2. Soma: x + (x+1) + (x+2) = 90. \n3. 3x + 3 = 90 => 3x = 87 => x = 29. \n4. Os números são 29, 30 e 31. \n5. O maior deles é 31.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Paulo gastou 2/7 do seu salário com remédios e 1/10 em alimentação. Que fração representa o gasto total?',
                'options' => ['27/60', '27/70', '28/60', '28/70', '29/70'],
                'correct_answer' => 1, // B
                'rationale' => 'Soma de frações com denominadores diferentes (MMC de 7 e 10 é 70): \n 2/7 + 1/10 = (20 + 7) / 70 = 27/70.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em testes com pesos 7 e 3, Alexandre obteve 5,6 e 2,4. Se os testes tivessem peso 10, quais seriam as notas respectivas?',
                'options' => ['8,5 e 8,0', '7,5 e 8,5', '8,0 e 7,5', '8,0 e 8,0', '8,5 e 7,5'],
                'correct_answer' => 3, // D
                'rationale' => 'Regra de proporcionalidade: \nNota 1: Tirou 5,6 de um máximo de 7. (5,6 / 7) = 0,8 (80%). Em base 10: 0,8 * 10 = 8,0. \nNota 2: Tirou 2,4 de um máximo de 3. (2,4 / 3) = 0,8 (80%). Em base 10: 0,8 * 10 = 8,0.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'João cotou celulares. Loja A: 800 (-15%). Loja B: 750 (-8%). Loja C: 850 (-20%). Qual é mais vantajosa?',
                'options' => ['Loja A e C são igualmente baratas', 'Loja A é mais barata', 'Loja B é mais barata', 'Loja C é mais barata', 'Loja A e B são igualmente baratas'],
                'correct_answer' => 0, // A
                'rationale' => 'Cálculo dos valores finais: \nLoja A: 800 - 15% (120) = R$ 680. \nLoja B: 750 - 8% (60) = R$ 690. \nLoja C: 850 - 20% (170) = R$ 680. \nConclusão: Lojas A e C têm o mesmo preço (R$ 680) e são as opções mais baratas.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'O marinheiro Lucas precisa pintar o piso de um compartimento com o formato mostrado no croqui. Calcule a área total.',
                'image_url' => '/questions/block6_q30.png',
                'options' => ['11 m²', '13 m²', '10 m²', '18 m²', '12 m²'],
                'correct_answer' => 0, // A
                'rationale' => 'Divida a figura em formas simples: \n1. Retângulo da esquerda: 2m x 3m = 6 m². \n2. Retângulo do meio: 2m x 2m = 4 m². \n3. Triângulo da direita: Base 1m, Altura 2m. Área = (b*h)/2 = (1*2)/2 = 1 m². \nTotal: 6 + 4 + 1 = 11 m².',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um marinheiro precisa estaiar o mastro. Sabendo que A está a 15m da base B e a altura BC é 20m, calcule o comprimento total dos dois cabos (A e D).',
                'image_url' => '/questions/block6_q31.png',
                'options' => ['40 m', '45 m', '150 m', '30 m', '50 m'],
                'correct_answer' => 4, // E
                'rationale' => '1. O cabo forma a hipotenusa de um triângulo retângulo com base 15m e altura 20m. \n2. Teorema de Pitágoras: h² = 15² + 20² = 225 + 400 = 625. \n3. h = √625 = 25m. \n4. Como são DOIS cabos (um de cada lado, A e D), o total é 25 + 25 = 50m.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Para completar 44h semanais em 5 dias, Isabela trabalha 8,8 horas por dia. Quantos minutos ela trabalha por dia?',
                'options' => ['264', '488', '528', '880', '1466'],
                'correct_answer' => 2, // C
                'rationale' => '1. Converta as horas: 8 horas completas = 8 * 60 = 480 minutos. \n2. Converta a parte decimal: 0,8 hora = 0,8 * 60 = 48 minutos. \n3. Total: 480 + 48 = 528 minutos.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Na praça há 21 veículos (carros e motos) e 66 rodas. Quantas motos há?',
                'options' => ['13', '12', '10', '11', '9'],
                'correct_answer' => 4, // E
                'rationale' => 'Sistema de Equações: \nC + M = 21 (Total veículos) \n4C + 2M = 66 (Total rodas) \nMultiplique a primeira por -2: -2C - 2M = -42. \nSome com a segunda: 2C = 24 => C = 12 carros. \nSe C=12, então M = 21 - 12 = 9 motos.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Há 4 caminhos de X para Y e 6 de Y para Z. Caminhos de X para Z passando por Y:',
                'options' => ['24', '32', '10', '12', '18'],
                'correct_answer' => 0, // A
                'rationale' => 'Princípio Fundamental da Contagem (Multiplicativo): \nSe há 4 opções para a 1ª etapa e 6 para a 2ª, o total é 4 * 6 = 24 caminhos distintos.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Pai tem 54, quatro filhos somam 39. Daqui a quantos anos a idade do pai será igual à soma dos filhos?',
                'options' => ['5', '8', '12', '10', '15'],
                'correct_answer' => 0, // A
                'rationale' => 'Seja x o anos passados. \nIdade Pai: 54 + x \nSoma Filhos: 39 + 4x (Obs: cada um dos 4 filhos envelhece x anos, então aumenta 4x no total). \nEquação: 54 + x = 39 + 4x. \n54 - 39 = 4x - x \n15 = 3x \nx = 5 anos.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em um condomínio com 60 crianças... Quantas não gostam de nenhum dos três esportes (Futebol, Basquete, Vôlei)?',
                'options' => ['3', '4', '5', '7', '9'],
                'correct_answer' => 1, // B
                'rationale' => 'Utilizando o Diagrama de Venn: \n1. Total que gosta de algo = (Só Fut) + (Só Bas) + (Só Vol) + (intersecções duplas exclusivas) + (todas 3). \n2. Preenchendo os dados, encontramos que a união de F U B U V é 56 crianças. \n3. Nenhuma = Total - União = 60 - 56 = 4 crianças.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'A quantia de R$ 400 seria repartida. 4 faltaram, aumentando R$ 5 para cada restante. Número inicial de crianças:',
                'options' => ['12', '14', '16', '18', '20'],
                'correct_answer' => 4, // E
                'rationale' => 'Seja n o número inicial. \nValor original por criança: 400/n. \nNovo valor: 400/(n-4). \nDiferença: 400/(n-4) - 400/n = 5. \nSimplificando e resolvendo a equação quadrática n² - 4n - 320 = 0. \nRaízes: 20 e -16. Como n deve ser positivo, n = 20 crianças.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'João (270), Maria (450), Pedro (0). Repartem para ficar iguais. A quantia dada por Maria representa quantos % do que ela tinha?',
                'options' => ['50,3%', '46,7%', '45,6%', '42,3%', '38,7%'],
                'correct_answer' => 1, // B
                'rationale' => '1. Total de dinheiro: 270 + 450 + 0 = 720. \n2. Valor igual para cada: 720 / 3 = 240. \n3. Maria tinha 450 e ficou com 240. Ela doou 450 - 240 = 210. \n4. Porcentagem: (210 / 450) * 100 = 0,4666... * 100 = 46,7%.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Parede 2,4m x 90cm. Azulejos quadrados de 45cm. Mínimo necessário:',
                'options' => ['10', '21', '20', '15', '11'],
                'correct_answer' => 4, // E
                'rationale' => '1. Converta para cm: Parede 240cm x 90cm. Área = 21.600 cm². \n2. Área azulejo: 45 x 45 = 2.025 cm². \n3. Divisão matemática: 21.600 / 2.025 = 10,66. \n4. Como não dá para comprar 10,66 azulejos, você precisa de 11 azulejos no mínimo para cobrir a área (considerando recortes).',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Conjunto solução da equação 3/(x-5) + 1/(x+5) = (10-x²)/(x²-25).',
                'options' => ['{-5, 5}', '{0}', '{-4, 0}', '{0, 4}', '{5}'],
                'correct_answer' => 2, // C
                'rationale' => '1. O termo (x²-25) é igual a (x-5)(x+5). O MMC é (x-5)(x+5). \n2. Multiplicando tudo pelo MMC: 3(x+5) + 1(x-5) = 10 - x². \n3. 3x + 15 + x - 5 = 10 - x². \n4. 4x + 10 = 10 - x² => x² + 4x = 0. \n5. x(x + 4) = 0. Raízes: x=0 ou x=-4. Ambas válidas pois não anulam o denominador (±5).',
                'block' => 6
            ],
        ];

        // Ensure block 6 is clear before seeding (Optional logic, usually handled by Fresh, but good for idempotency if we had a Block model, here questions just have block column)
        Question::where('block', 6)->delete();

        foreach ($questions as $q) {
            Question::create($q);
        }
    }
}
