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
                'rationale' => '“Prepara” (pre-PA-ra) é inequivocamente paroxítona. “Marítimo” e “Pública” são proparoxítonas. “Exigências” e “Plenário” são paroxítonas terminadas em ditongo, por vezes classificadas como proparoxítonas relativas.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Lido o texto de modo atento e considerada a sua estrutura e o seu conteúdo, pode-se interpretá-lo como pertencente ao gênero:',
                'options' => ['solilóquio', 'notícia', 'crônica', 'epístola', 'artigo de opinião'],
                'correct_answer' => 1, // B
                'rationale' => 'O texto tem caráter informativo, relatando fatos sobre a preparação do Brasil para uma convenção internacional, típico do gênero notícia.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'No texto, o termo preposicionado que sucede imediatamente o núcleo “Marinha” na expressão “Marinha do Brasil”, é uma locução:',
                'options' => ['adjetiva', 'adverbial', 'verbal', 'pronominal', 'prepositiva'],
                'correct_answer' => 0, // A
                'rationale' => '“Do Brasil” qualifica o substantivo “Marinha”, atuando como um adjetivo (locução adjetiva).',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“ (…) considerando as características específicas do transporte marítimo e a necessidade de assegurar, ao final de suas vidas úteis, a retirada adequada do ambiente” (2º§). O termo em destaque (retirada) é formado por:',
                'options' => ['oneonímia', 'derivação imprópria', 'derivação sufixal', 'derivação regressiva', 'derivação parassintética'],
                'correct_answer' => 2, // C
                'rationale' => '“Retirada” forma-se pelo acréscimo do sufixo “-ada” ao verbo “retirar” (particípio substantivado).',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“Os ministérios envolvidos devem emitir pareceres sobre o documento, que então será remetido pela Casa Civil...” (2º§). O termo destacado (que) deve ser classificado corretamente como um(a):',
                'options' => ['pronome interrogativo', 'conjunção subordinativa adverbial', 'conjunção integrante', 'pronome indefinido', 'pronome relativo'],
                'correct_answer' => 4, // E
                'rationale' => 'O “que” retoma o termo antecedente “documento”, introduzindo uma oração adjetiva, funcionando como pronome relativo.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'A palavra “frota”, no primeiro período do primeiro parágrafo do texto, em relação ao verbo “adaptar”, exerce a função sintática de núcleo do:',
                'options' => ['complemento nominal', 'objeto direto', 'sujeito', 'objeto direto preposicionado', 'objeto indireto não preposicionado'],
                'correct_answer' => 1, // B
                'rationale' => 'O verbo “adaptar” é transitivo direto (adaptar algo). “Frota” é o núcleo do objeto direto.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Um exemplo de substantivo abstrato encontrado no texto é:',
                'options' => ['plenário', 'reciclagem', 'navios', 'frotas', 'pareceres'],
                'correct_answer' => 1, // B
                'rationale' => '“Reciclagem” nomeia uma ação ou processo, sendo classificado como substantivo abstrato.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“A Convenção prevê medidas para prevenir e minimizar os riscos… (2º§)”. Se o sujeito fosse “As convenções”, o verbo destacado seria:',
                'options' => ['prevejem', 'prevêm', 'prevêem', 'preveem', 'prevém'],
                'correct_answer' => 3, // D
                'rationale' => 'Pela Nova Ortografia, os verbos ler, dar, ver e crer (e derivados como prever) dobram o “e” no plural mas perdem o acento circunflexo: “preveem”.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“Caso pertinente, poderá ocorrer a busca por apoio técnico...” (4º§). Se reescrevêssemos esse mesmo verbo no futuro do pretérito do modo indicativo, teríamos:',
                'options' => ['pôde', 'podia', 'poderão', 'pudera', 'poderia'],
                'correct_answer' => 4, // E
                'rationale' => 'Futuro do Pretérito expressa uma possibilidade condicionada: “poderia”.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“A Comissão Coordenadora para os Assuntos da IMO (CCA-IMO), Colegiado interministerial coordenado pela Marinha do Brasil..., deu início ao processo…” (1º§). As vírgulas nesse trecho foram empregadas para:',
                'options' => ['isolar um aposto', 'indicar um verbo implícito', 'isolar um adjunto longo deslocado', 'isolar uma retificação', 'isolar um termo de valor conclusivo'],
                'correct_answer' => 0, // A
                'rationale' => 'O trecho “Colegiado interministerial...” explica o termo anterior “Comissão...”, funcionando como aposto explicativo.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Assinale a alternativa FALSA:',
                'options' => ['A expressão “Assim sendo” introduz conclusão.', 'O núcleo do sujeito do verbo “deu” é “Comissão”.', 'A expressão “Uma vez que” foi empregada com valor de tempo.', 'A palavra “caso” é conjunção condicional.', 'O verbo “surgirão” está no futuro do presente.'],
                'correct_answer' => 2, // C
                'rationale' => '“Uma vez que” é uma locução conjuntiva causal (já que, visto que), e não temporal.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“...Convenção Internacional..., da Organização Marítima Internacional..., que deve entrar em vigor em junho de 2025”. O termo em evidência (que) está diretamente relacionado ao núcleo:',
                'options' => ['Brasil', 'Reciclagem', 'Hong Kong', 'Convenção', 'IMO'],
                'correct_answer' => 3, // D
                'rationale' => 'É a “Convenção Internacional” que entrará em vigor em 2025, não a IMO ou a reciclagem em si.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“Assim sendo, a Autoridade Marítima Brasileira realizará a normatização...” (3º§). A primeira vírgula nesse trecho:',
                'options' => ['foi empregada incorretamente', 'é obrigatória, isola termo conclusivo', 'foi empregada para isolar aposto', 'é facultativa (termo curto)', 'é facultativa (adjunto adverbial)'],
                'correct_answer' => 1, // B
                'rationale' => 'Conectivos conclusivos deslocados ou no início da oração (como “Assim sendo”) devem vir seguidos de vírgula.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Assinale a opção em que o termo foi formado pelo processo de derivação regressiva:',
                'options' => ['ambas', 'reciclagem', 'busca', 'cooperação', 'navios'],
                'correct_answer' => 2, // C
                'rationale' => '“Busca” deriva do verbo “buscar” por redução (derivação regressiva ou deverbal).',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Assinale a opção em que ambos os verbos não possuem a primeira pessoa do singular, do presente do modo indicativo (verbos defectivos):',
                'options' => ['reaver e aderir', 'aderir e falir', 'precaver e pressupor', 'colorir e falir', 'precaver e haver'],
                'correct_answer' => 3, // D
                'rationale' => '“Colorir” (eu --) e “Falir” (eu --) não possuem a conjugação da 1ª pessoa do singular do presente do indicativo.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'A vírgula antes do “que” neste trecho: “... (IMO, da sigla em inglês), que deve entrar em vigor em junho de 2025” foi empregada:',
                'options' => ['para introduzir trecho de valor explicativo', 'a fim de substituir um verbo', 'com objetivo de indicar OD preposicionado', 'obrigatoriedade antes de pronomes relativos', 'para isolar adjunto longo'],
                'correct_answer' => 0, // A
                'rationale' => 'A vírgula antes do pronome relativo “que” indica que a oração subsequente é adjetiva explicativa.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => '“Caso pertinente, poderá ocorrer ...”. O único termo que foi acentuado em obediência à mesma regra aplicada ao termo destacado (técnico/específicas) é:',
                'options' => ['realizará', 'normatização', 'inglês', 'específicas', 'úteis'],
                'correct_answer' => 3, // D
                'rationale' => 'Partindo do princípio que a questão pedia a correlação com uma proparoxítona (provavelmente “técnico”), a resposta correta é “específicas” (também proparoxítona).',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'A expressão “a qual” no fim do último parágrafo é:',
                'options' => ['locução conjuntiva', 'conjunção integrante', 'pronome indefinido', 'pronome relativo', 'pronome interrogativo'],
                'correct_answer' => 3, // D
                'rationale' => '“A qual” retoma “IMO”, funcionando como pronome relativo variado.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Marque a única alternativa em que o termo destacado é um adjetivo.',
                'options' => ['mercantes', 'surgirão', 'documento', 'casas', 'IMO'],
                'correct_answer' => 0, // A
                'rationale' => 'Na expressão “navios mercantes”, “mercantes” qualifica “navios”, sendo um adjetivo. As demais opções (nas posições finais dos trechos originais) são Verbos ou Substantivos.',
                'block' => 6
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'A leitura atenta do texto permite interpretar que seu principal objetivo é:',
                'options' => ['argumentar contra as adaptações', 'discutir pontos de vista', 'informar sobre as adaptações', 'dar instruções práticas', 'narrar eventos passados'],
                'correct_answer' => 2, // C
                'rationale' => 'O texto é informativo/expositivo sobre o processo de adaptação do Brasil às normas da IMO.',
                'block' => 6
            ],

            // MATEMATICA - Q21 to Q40
            [
                'subject' => 'matematica',
                'text' => 'O número m ≠ 0 tem inverso igual a n. Sabendo-se que (m + n) = 2, qual o valor de (m³ + n³) . (m⁴ − n⁴)?',
                'options' => ['0', '8', '6', '4', '2'],
                'correct_answer' => 0, // A
                'rationale' => 'Se n é inverso de m, n=1/m. m + 1/m = 2 implica que m=1 e n=1. A expressão contém o termo (m⁴ - n⁴) = (1-1) = 0. Qualquer número multiplicado por 0 é 0.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'A diferença entre o comprimento a e a largura b de um retângulo é de 2 cm. Se sua área é menor que 35 cm², então o valor de a, em cm (considerando a solução algébrica da inequação), será:',
                'options' => ['0 < x < 7', '4 < x < 6', '0 < x < 2', '4 < x < 7', '7 < x < 12'],
                'correct_answer' => 0, // A
                'rationale' => 'b = a - 2. Área = a(a-2) < 35. a² - 2a - 35 < 0. Raízes são -5 e 7. O intervalo entre raízes é -5 < a < 7. Como se trata de medida, a > 0. O intervalo algébrico correspondente é a < 7 (Opção A).',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um número é formado por 3 algarismos (5 d 2). Sabendo-se que S é a soma dos possíveis valores que o algarismo da dezena (d) poderá assumir para que este número seja divisível por 4, então √S será:',
                'options' => ['7', '11', '9', '5', '3'],
                'correct_answer' => 3, // D
                'rationale' => 'Para 5d2 ser divisível por 4, d2 deve ser divisível por 4. Valores possíveis para d: 1 (12), 3 (32), 5 (52), 7 (72), 9 (92). S = 1+3+5+7+9 = 25. raiz(25) = 5.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Uma fábrica engarrafa 3000 refrigerantes em 6 horas. Quantas horas levará para engarrafar 4000 refrigerantes?',
                'options' => ['10', '12', '8', '16', '14'],
                'correct_answer' => 2, // C
                'rationale' => 'Velocidade = 3000/6 = 500/h. Tempo = 4000 / 500 = 8 horas.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'A diferença entre o maior número ímpar de cinco algarismos diferentes e o menor número par de cinco algarismos diferentes é:',
                'options' => ['88531', '81549', '88529', '77777', '78925'],
                'correct_answer' => 0, // A
                'rationale' => 'Maior ímpar distinto: 98765. Menor par distinto (não inic. em 0): 10234. Diferença: 98765 - 10234 = 88531.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'A soma de três números inteiros consecutivos é igual a 90. Qual é o maior destes três números?',
                'options' => ['32', '31', '29', '28', '21'],
                'correct_answer' => 1, // B
                'rationale' => 'x + (x+1) + (x+2) = 90. 3x + 3 = 90. 3x = 87. x = 29. Números: 29, 30, 31. Maior: 31.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Paulo gastou 2/7 do seu salário com remédios e 1/10 em alimentação. Que fração representa o gasto total?',
                'options' => ['27/60', '27/70', '28/60', '28/70', '29/70'],
                'correct_answer' => 1, // B
                'rationale' => 'MMC(7,10) = 70. 20/70 + 7/70 = 27/70.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em testes com pesos 7 e 3, Alexandre obteve 5,6 e 2,4. Se os testes tivessem peso 10, quais seriam as notas respectivas?',
                'options' => ['8,5 e 8,0', '7,5 e 8,5', '8,0 e 7,5', '8,0 e 8,0', '8,5 e 7,5'],
                'correct_answer' => 3, // D
                'rationale' => 'Teste 1: (5,6 / 7) * 10 = 0,8 * 10 = 8,0. Teste 2: (2,4 / 3) * 10 = 0,8 * 10 = 8,0.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'João cotou celulares. Loja A: 800 (-15%). Loja B: 750 (-8%). Loja C: 850 (-20%). Qual é mais vantajosa?',
                'options' => ['Loja A e C são igualmente baratas', 'Loja A é mais barata', 'Loja B é mais barata', 'Loja C é mais barata', 'Loja A e B são igualmente baratas'],
                'correct_answer' => 0, // A
                'rationale' => 'A: 800*0,85 = 680. B: 750*0,92 = 690. C: 850*0,80 = 680. A e C são iguais e as menores.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'O marinheiro Lucas precisa pintar o piso de um compartimento com o formato mostrado no croqui. Calcule a área total.',
                'image_url' => '/questions/block6_q30.png',
                'options' => ['11 m²', '13 m²', '10 m²', '18 m²', '12 m²'],
                'correct_answer' => 0, // A
                'rationale' => 'O croqui apresenta duas áreas retangulares (2x3=6 e 2x2=4) e uma triangular (base 1, altura 2 => área 1). Total: 6+4+1 = 11 m².',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um marinheiro precisa estaiar o mastro. Sabendo que A está a 15m da base B e a altura BC é 20m, calcule o comprimento total dos dois cabos (A e D).',
                'image_url' => '/questions/block6_q31.png',
                'options' => ['40 m', '45 m', '150 m', '30 m', '50 m'],
                'correct_answer' => 4, // E
                'rationale' => 'Triângulo retângulo de catetos 15 e 20. Hipotenusa² = 15² + 20² = 225 + 400 = 625. Hipotenusa = 25. Como são dois cabos simétricos, total = 50m.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Para completar 44h semanais em 5 dias, Isabela trabalha 8,8 horas por dia. Quantos minutos ela trabalha por dia?',
                'options' => ['264', '488', '528', '880', '1466'],
                'correct_answer' => 2, // C
                'rationale' => '8,8 horas x 60 minutos = 528 minutos.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Na praça há 21 veículos (carros e motos) e 66 rodas. Quantas motos há?',
                'options' => ['13', '12', '10', '11', '9'],
                'correct_answer' => 4, // E
                'rationale' => 'C+M=21; 4C+2M=66. 4(21-M)+2M=66. 84-4M+2M=66. 84-66=2M. 18=2M. M=9.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Há 4 caminhos de X para Y e 6 de Y para Z. Caminhos de X para Z passando por Y:',
                'options' => ['24', '32', '10', '12', '18'],
                'correct_answer' => 0, // A
                'rationale' => 'Princípio Multiplicativo: 4 * 6 = 24.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Pai tem 54, quatro filhos somam 39. Daqui a quantos anos a idade do pai será igual à soma dos filhos?',
                'options' => ['5', '8', '12', '10', '15'],
                'correct_answer' => 0, // A
                'rationale' => '54+x = 39 + 4x (cada filho envelhece x). 15 = 3x. x = 5.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em um condomínio com 60 crianças... Quantas não gostam de nenhum dos três esportes (Futebol, Basquete, Vôlei)?',
                'options' => ['3', '4', '5', '7', '9'],
                'correct_answer' => 1, // B
                'rationale' => 'Calculando a União dos conjuntos dados as interseções, encontramos 56 crianças que gostam de algo. 60 - 56 = 4.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'A quantia de R$ 400 seria repartida. 4 faltaram, aumentando R$ 5 para cada restante. Número inicial de crianças:',
                'options' => ['12', '14', '16', '18', '20'],
                'correct_answer' => 4, // E
                'rationale' => '400/(n-4) - 400/n = 5. Resolvendo a equacao quadrática n² - 4n - 320 = 0, n=20.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'João (270), Maria (450), Pedro (0). Repartem para ficar iguais. A quantia dada por Maria representa quantos % do que ela tinha?',
                'options' => ['50,3%', '46,7%', '45,6%', '42,3%', '38,7%'],
                'correct_answer' => 1, // B
                'rationale' => 'Total 720. Cada um fica com 240. Maria tinha 450, ficou com 240, deu 210. 210/450 = 0,466... = 46,7%.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Parede 2,4m x 90cm. Azulejos quadrados de 45cm. Mínimo necessário:',
                'options' => ['10', '21', '20', '15', '11'],
                'correct_answer' => 4, // E
                'rationale' => 'Área parede = 2.16 m². Azulejo = 0.2025 m². Divisão = 10.66. Arredonda para 11.',
                'block' => 6
            ],
            [
                'subject' => 'matematica',
                'text' => 'Conjunto solução da equação 3/(x-5) + 1/(x+5) = (10-x²)/(x²-25).',
                'options' => ['{-5, 5}', '{0}', '{-4, 0}', '{0, 4}', '{5}'],
                'correct_answer' => 2, // C
                'rationale' => 'Resolvendo a equação algébrica, chega-se a x(x+4)=0, raízes 0 e -4, ambas válidas no domínio.',
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
