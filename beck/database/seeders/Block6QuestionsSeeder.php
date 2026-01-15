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
                'text' => 'Considere que um número real "m", diferente de zero, possui um inverso representado por "n". Sabendo-se que a soma desses dois números (m + n) é igual a 2, determine o valor numérico resultante da expressão (m³ + n³) . (m⁴ − n⁴).',
                'options' => ['0', '8', '6', '4', '2'],
                'correct_answer' => 0, // A
                'rationale' => '1. Se n é o inverso de m, então n = 1/m. \n2. Temos m + 1/m = 2. Multiplicando tudo por m: m² + 1 = 2m => m² - 2m + 1 = 0. \n3. Isso é um trinômio quadrado perfeito: (m - 1)² = 0, logo m = 1. \n4. Se m=1, então seu inverso n também é 1. \n5. A expressão pede (m⁴ − n⁴) no segundo termo. Isso seria (1⁴ - 1⁴) = 1 - 1 = 0. \n6. Como qualquer número multiplicado por zero é zero, o resultado final é 0.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em um compartimento retangular de um navio, a diferença entre o comprimento "a" e a largura "b" é exatamente 2 cm. Se a área total deste compartimento deve ser menor que 35 cm², determine o intervalo de valores possíveis para o comprimento "a", considerando a solução algébrica da inequação resultante.',
                'options' => ['0 < x < 7', '4 < x < 6', '0 < x < 2', '4 < x < 7', '7 < x < 12'],
                'correct_answer' => 0, // A
                'rationale' => '1. Dados: a - b = 2 => b = a - 2. Área < 35. \n2. Área = a * b = a(a-2) = a² - 2a. \n3. Montamos a inequação: a² - 2a - 35 < 0. \n4. As raízes da equação a² - 2a - 35 = 0 são 7 e -5. \n5. Por ser uma parábola com concavidade voltada para cima, os valores menores que zero estão entre as raízes: -5 < a < 7. \n6. Visto que "a" representa uma medida física (comprimento), ele deve ser maior que zero. Portanto, a solução válida é 0 < x < 7.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um determinado código serial é formado por 3 algarismos na sequência (5 d 2), onde "d" representa o algarismo das dezenas. Sabendo-se que "S" é a soma de todos os valores possíveis que "d" pode assumir para que este número seja perfeitamente divisível por 4, calcule o valor de √S.',
                'options' => ['7', '11', '9', '5', '3'],
                'correct_answer' => 3, // D
                'rationale' => '1. Para um número ser divisível por 4, os dois últimos algarismos (d2) devem formar um número múltiplo de 4. \n2. Testamos as possibilidades para "d": \n - 12 (divisível por 4) -> d=1 \n - 32 (divisível por 4) -> d=3 \n - 52 (divisível por 4) -> d=5 \n - 72 (divisível por 4) -> d=7 \n - 92 (divisível por 4) -> d=9 \n3. Somando os valores de d: S = 1+3+5+7+9 = 25. \n4. O problema pede √S, logo √25 = 5.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Uma centrífuga de purificação em uma plataforma engarrafa 3.000 recipientes de refrigerante em um período de 6 horas de operação contínua. Mantendo o mesmo ritmo de produção, quantas horas seriam necessárias para engarrafar um lote de 4.000 recipientes?',
                'options' => ['10', '12', '8', '16', '14'],
                'correct_answer' => 2, // C
                'rationale' => 'Trata-se de uma regra de três simples direta: \n 3000 recipientes --- 6 horas \n 4000 recipientes --- x horas \n 3000 * x = 4000 * 6 \n 3000x = 24000 \n x = 24000 / 3000 = 8 horas.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Determine o valor resultante da diferença aritmética entre o maior número ímpar composto por cinco algarismos distintos e o menor número par também composto por cinco algarismos distintos.',
                'options' => ['88531', '81549', '88529', '77777', '78925'],
                'correct_answer' => 0, // A
                'rationale' => '1. O maior número de 5 algarismos distintos é 98765. Como termina em 5, ele já é ímpar. \n2. O menor número de 5 algarismos distintos deve começar com 1 (não pode começar com zero). Seria 10234. Como termina em 4, ele é par. \n3. Realizando a subtração: 98765 - 10234 = 88531.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Durante uma contagem de peças em um estoque náutico, observou-se que a soma de três números inteiros e consecutivos é exatamente igual a 90. Com base nessa informação, qual é o maior valor entre esses três números?',
                'options' => ['32', '31', '29', '28', '21'],
                'correct_answer' => 1, // B
                'rationale' => '1. Representamos números consecutivos como x, (x+1) e (x+2). \n2. Montamos a equação: x + x + 1 + x + 2 = 90. \n3. 3x + 3 = 90 => 3x = 87 => x = 29. \n4. Os números são 29, 30 e 31. O maior deles é 31.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um marinheiro utilizou 2/7 de seu soldo mensal para o pagamento de medicamentos e 1/10 do mesmo soldo para despesas com alimentação. Qual é a fração que representa o somatório total desses dois gastos em relação ao salário?',
                'options' => ['27/60', '27/70', '28/60', '28/70', '29/70'],
                'correct_answer' => 1, // B
                'rationale' => 'Para somar frações com denominadores diferentes, calculamos o MMC entre 7 e 10, que é 70: \n 2/7 + 1/10 = (20 / 70) + (7 / 70) = 27/70.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em um curso de formação, dois exames foram aplicados com pesos 7 e 3, respectivamente. O aluno Alexandre obteve as notas 5,6 no primeiro e 2,4 no segundo. Se o critério de avaliação fosse alterado para que ambos os testes tivessem peso 10, mantendo a proporcionalidade do desempenho, quais seriam as suas novas notas?',
                'options' => ['8,5 e 8,0', '7,5 e 8,5', '8,0 e 7,5', '8,0 e 8,0', '8,5 e 7,5'],
                'correct_answer' => 3, // D
                'rationale' => 'Basta calcular a nota proporcional à escala de 0 a 10: \nExame 1: (5,6 obtido / 7 total) * 10 = 0,8 * 10 = 8,0. \nExame 2: (2,4 obtido / 3 total) * 10 = 0,8 * 10 = 8,0. \nAmbas as notas proporcionais seriam 8,0.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um encarregado de logística realizou uma cotação para aquisição de novos equipamentos em três fornecedores: a Loja A oferece o produto por R$ 800 com 15% de desconto; a Loja B por R$ 750 com 8% de desconto; e a Loja C por R$ 850 com 20% de desconto. Considerando apenas o custo final, qual fornecedor apresenta a opção mais vantajosa?',
                'options' => ['Loja A e C são igualmente baratas', 'Loja A é mais barata', 'Loja B é mais barata', 'Loja C é mais barata', 'Loja A e B são igualmente baratas'],
                'correct_answer' => 0, // A
                'rationale' => 'Cálculo dos preços líquidos: \nLoja A: 800 - 15% (120) = R$ 680. \nLoja B: 750 - 8% (60) = R$ 690. \nLoja C: 850 - 20% (170) = R$ 680. \nAs lojas A e C empatam como as mais baratas do mercado.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'O marinheiro Lucas recebeu a tarefa de pintar o piso de um compartimento técnico que possui o formato geométrico irregular mostrado no croqui abaixo. Com base nas medidas indicadas, calcule a área total que deverá ser pintada.',
                'image_url' => '/questions/block6_q30.png',
                'options' => ['11 m²', '13 m²', '10 m²', '18 m²', '12 m²'],
                'correct_answer' => 0, // A
                'rationale' => 'A figura pode ser decomposta em três partes simples: \n1. Um retângulo superior de 2m x 3m = 6 m². \n2. Um retângulo inferior de 2m x 2m = 4 m². \n3. Um triângulo lateral com base de 1m e altura de 2m. Área = (1*2)/2 = 1 m². \nSomando tudo: 6 + 4 + 1 = 11 m².',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Para garantir a estabilidade de um mastro vertical (BC), um marinheiro precisa instalar dois cabos de sustentação idênticos (estais) conectando os pontos A e D à extremidade C do mastro. Sabendo que o ponto de fixação A está a uma distância de 15m da base B, e que a altura do mastro (BC) é de 20m, determine o comprimento total de cabo necessário para realizar o estaiamento nos dois lados.',
                'image_url' => '/questions/block6_q31.png',
                'options' => ['40 m', '45 m', '150 m', '30 m', '50 m'],
                'correct_answer' => 4, // E
                'rationale' => '1. O cabo forma a hipotenusa de um triângulo retângulo onde os catetos são 15m (base) e 20m (altura). \n2. Pelo Teorema de Pitágoras: x² = 15² + 20² => x² = 225 + 400 = 625. \n3. x = √625 = 25 metros para um cabo. \n4. Como são dois lados (A e D), o total é 2 * 25 = 50 metros.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Uma funcionária administrativa trabalha no regime de 44 horas semanais distribuídas igualmente em 5 dias de trabalho, o que resulta em uma jornada de 8,8 horas diárias. Expresse essa jornada de trabalho diária exclusivamente em minutos.',
                'options' => ['264', '488', '528', '880', '1466'],
                'correct_answer' => 2, // C
                'rationale' => 'Sabendo que 1 hora equivale a 60 minutos, multiplicamos a jornada decimal pelo fator de conversão: \n 8,8 horas * 60 minutos/hora = 528 minutos.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em uma área de estacionamento de uma vila naval, encontram-se estacionados um total de 21 veículos, entre carros e motos autuados. Sabendo-se que, ao realizar a contagem física, foram contabilizadas 66 rodas no local, determine exatamente quantas motos há no grupo.',
                'options' => ['13', '12', '10', '11', '9'],
                'correct_answer' => 4, // E
                'rationale' => 'Montamos um sistema de equações lineares: \nC + M = 21 (veículos) \n4C + 2M = 66 (rodas) \nSubstituindo C da primeira (C = 21 - M) na segunda: \n4(21 - M) + 2M = 66 => 84 - 4M + 2M = 66 => 18 = 2M => M = 9.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um navegador planeja sua rota entre três portos: X, Y e Z. Sabe-se que existem 4 rotas marítimas distintas conectando o Porto X ao Porto Y, e 6 rotas distintas conectando o Porto Y ao Porto Z. De quantas maneiras diferentes esse navegador pode realizar a viagem de X até Z, obrigatoriamente passando pelo Porto Y?',
                'options' => ['24', '32', '10', '12', '18'],
                'correct_answer' => 0, // A
                'rationale' => 'Aplicamos o Princípio Fundamental da Contagem (PFC). Se temos um evento composto por duas etapas independentes com "m" e "n" possibilidades, o total é o produto delas: \n 4 rotas (X->Y) * 6 rotas (Y->Z) = 24 possibilidades de trajeto total.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Atualmente, um pai tem 54 anos de idade enquanto a soma das idades de seus quatro filhos totaliza 39 anos. Determine daqui a quantos anos a idade do pai será exatamente igual à soma das idades de seus quatro filhos.',
                'options' => ['5', '8', '12', '10', '15'],
                'correct_answer' => 0, // A
                'rationale' => 'Seja "x" o número de anos decorridos no futuro: \nIdade do pai futuramente: 54 + x. \nSoma das idades dos filhos futuramente: 39 + 4x (pois cada um dos 4 filhos envelhece x anos). \nEquação: 54 + x = 39 + 4x => 15 = 3x => x = 5 anos.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em um levantamento realizado com 60 crianças de um condomínio sobre suas preferências esportivas, obteve-se os seguintes dados: 25 gostam de Futebol, 22 de Basquete e 18 de Vôlei. Após analisar as intersecções, descobriu-se que 56 crianças gostam de pelo menos um desses esportes. Com base nisso, determine quantas crianças não demonstraram interesse por nenhum dos três esportes citados.',
                'options' => ['3', '4', '5', '7', '9'],
                'correct_answer' => 1, // B
                'rationale' => '1. O total de participantes é 60. \n2. A "União" dos conjuntos (crianças que gostam de algo) é informada como sendo 56. \n3. Para encontrar as crianças que estão "fora" dos conjuntos: Total - União = 60 - 56 = 4 crianças.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Uma quantia fixa de R$ 400 seria repartida igualmente entre um grupo de crianças. No entanto, no dia da entrega, 4 crianças não compareceram, o que resultou em um acréscimo de R$ 5 para cada uma das crianças presentes. Qual era o número inicial de crianças previsto no grupo?',
                'options' => ['12', '14', '16', '18', '20'],
                'correct_answer' => 4, // E
                'rationale' => 'Seja "n" o número inicial: \nValor original por criança: 400/n \nNovo valor: 400 / (n - 4) \nA diferença entre os valores é 5: [400 / (n - 4)] - [400 / n] = 5 \nResolvendo a equação: n² - 4n - 320 = 0. Raízes: 20 e -16. O número de crianças deve ser 20.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'João possuía R$ 270, Maria R$ 450 e Pedro não possuía quantia alguma. Eles decidiram reunir todo o capital e repartir o total em partes iguais para que todos tivessem a mesma quantia. Ao final dessa redistribuição, a quantia que Maria entregou aos seus amigos representa qual percentual em relação ao que ela possuía inicialmente?',
                'options' => ['50,3%', '46,7%', '45,6%', '42,3%', '38,7%'],
                'correct_answer' => 1, // B
                'rationale' => '1. Total de dinheiro: 270 + 450 + 0 = R$ 720. \n2. Divisão igual (720 / 3) = R$ 240 para cada um. \n3. Maria tinha 450 e ficou com 240, ou seja, ela "deu" 210 reais para o grupo. \n4. Porcentagem: (Quantia dada 210 / Quantia inicial 450) * 100 = 46,66...% (aproximadamente 46,7%).',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um mestre d\'obras precisa revestir uma parede que mede 2,4m de comprimento por 0,9m de altura. Se ele optar por utilizar azulejos quadrados que possuem exatamente 45cm de lado, qual é o número mínimo de peças que ele deverá adquirir para cobrir toda a superfície da parede?',
                'options' => ['10', '21', '20', '15', '11'],
                'correct_answer' => 4, // E
                'rationale' => '1. Área da parede: 2,4m * 0,9m = 2,16 m². \n2. Área de um azulejo em metros: 0,45m * 0,45m = 0,2025 m². \n3. Divisão para saber a quantidade: 2,16 / 0,2025 = 10,66 peças. \n4. Como não é possível aplicar frações de peças comprando-as por unidade, é necessário adquirir no mínimo 11 peças.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Determine o conjunto solução da seguinte equação racional: 3 / (x - 5) + 1 / (x + 5) = (10 - x²) / (x² - 25). Considere o domínio mais abrangente possível para a função.',
                'options' => ['{-5, 5}', '{0}', '{-4, 0}', '{0, 4}', '{5}'],
                'correct_answer' => 2, // C
                'rationale' => '1. O denominador x² - 25 é equivalente a (x-5)(x+5). \n2. Multiplicando toda a equação pelo MMC [(x-5)(x+5)]: \n 3(x+5) + 1(x-5) = 10 - x² \n 3x + 15 + x - 5 = 10 - x² \n 4x + 10 = 10 - x² => x² + 4x = 0. \n3. Fatorando: x(x + 4) = 0. As raízes são x=0 e x=-4. Ambas são válidas no domínio.',
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
