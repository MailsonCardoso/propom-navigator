<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

// Limpar o Bloco 4 para recomeçar
Question::where('block', 4)->delete();

$baseText = "O Canteiro de Obras\n\nO mestre de obras chegou cedo ao canteiro. Sob o sol ainda pálido da manhã, ele revisou as plantas da fundação com rigor. Sabia que a estrutura de um edifício não perdoa erros de cálculo; uma falha na base comprometeria toda a segurança dos futuros moradores.\n— O cimento chegou? — perguntou ao ajudante, que descarregava as ferramentas.\nO rapaz assentiu silenciosamente. O trabalho ali era árduo, mas a precisão era a ferramenta mais importante. Ao final do dia, exausto, o mestre olhou para o alicerce pronto e sentiu que o dever fora cumprido. A construção era como um organismo vivo: cada tijolo precisava estar no lugar exato para que o todo fizesse sentido.";

$portugueseQuestions = [
    [
        'text' => 'No trecho "O mestre de obras chegou cedo ao canteiro", a palavra destacada (cedo) indica circunstância de:',
        'options' => ['Modo.', 'Lugar.', 'Tempo.', 'Intensidade.'],
        'correct_answer' => 2,
        'rationale' => 'A palavra "cedo" indica o momento em que a ação ocorreu, tratando-se de um advérbio de tempo.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Qual a função da vírgula em: "O trabalho ali era árduo, mas a precisão era a ferramenta mais importante"?',
        'options' => ['Separar uma explicação.', 'Introduzir uma oposição.', 'Isolar um vocativo.', 'Marcar a omissão de um verbo.'],
        'correct_answer' => 1,
        'rationale' => 'A vírgula precede a conjunção adversativa "mas", que introduz uma ideia de oposição.',
        'base_text' => $baseText
    ],
    [
        'text' => 'A palavra "alicerce" é classificada como:',
        'options' => ['Oxítona.', 'Paroxítona.', 'Proparoxítona.', 'Monossílabo tônico.'],
        'correct_answer' => 1,
        'rationale' => 'A sílaba tônica é a penúltima (a-li-CER-ce).',
        'base_text' => $baseText
    ],
    [
        'text' => 'Assinale o antônimo de "árduo" conforme o contexto:',
        'options' => ['Difícil.', 'Cansativo.', 'Fácil.', 'Complexo.'],
        'correct_answer' => 2,
        'rationale' => 'Árduo significa difícil, trabalhoso; seu oposto direto é fácil.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Em "O rapaz assentiu silenciosamente", o verbo destacado significa que ele:',
        'options' => ['Negou.', 'Concordou.', 'Gritou.', 'Fugiu.'],
        'correct_answer' => 1,
        'rationale' => 'Assentir é o mesmo que concordar ou fazer sinal afirmativo.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Indique a classe gramatical de "pálido" em "...sol ainda pálido...":',
        'options' => ['Substantivo.', 'Verbo.', 'Adjetivo.', 'Advérbio.'],
        'correct_answer' => 2,
        'rationale' => '"Pálido" qualifica o substantivo "sol", sendo, portanto, um adjetivo.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Qual o núcleo do sujeito em "A estrutura de um edifício não perdoa erros"?',
        'options' => ['Edifício.', 'Estrutura.', 'Erros.', 'Perdoa.'],
        'correct_answer' => 1,
        'rationale' => 'O núcleo do sujeito é a palavra principal que realiza a ação, neste caso, "estrutura".',
        'base_text' => $baseText
    ],
    [
        'text' => 'A palavra "edifício" é acentuada por ser uma:',
        'options' => ['Oxítona terminada em \'o\'.', 'Paroxítona terminada em ditongo crescente.', 'Proparoxítona.', 'Regra do hiato.'],
        'correct_answer' => 1,
        'rationale' => 'E-di-fí-cio é uma paroxítona terminada em ditongo.',
        'base_text' => $baseText
    ],
    [
        'text' => 'O termo "— O cimento chegou?" apresenta um travessão para indicar:',
        'options' => ['Uma enumeração.', 'A fala de um personagem (discurso direto).', 'Uma ironia.', 'Um pensamento do narrador.'],
        'correct_answer' => 1,
        'rationale' => 'O travessão é usado no início de falas em diálogos.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Em "...cada tijolo precisava estar no lugar exato...", se passarmos "exato" para o plural masculino, teremos:',
        'options' => ['Exatos.', 'Exatas.', 'Exatidões.', 'Exatamentes.'],
        'correct_answer' => 0,
        'rationale' => 'O plural masculino de exato é exatos.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Qual o plural de "Cidadão"?',
        'options' => ['Cidadões.', 'Cidadães.', 'Cidadãos.', 'Cidadãozes.'],
        'correct_answer' => 2,
        'rationale' => 'A única forma plural correta e aceita de cidadão é cidadãos.',
    ],
    [
        'text' => 'Assinale a alternativa com erro de ortografia:',
        'options' => ['Mão de obra.', 'Analisar.', 'Privilégio.', 'Enchergar.'],
        'correct_answer' => 3,
        'rationale' => 'A grafia correta da palavra é "Enxergar" (com X).',
    ],
    [
        'text' => 'O coletivo de "trabalhadores" pode ser:',
        'options' => ['Rebanho.', 'Elenco.', 'Corja.', 'Turma ou Pessoal.'],
        'correct_answer' => 3,
        'rationale' => 'Turma é o coletivo usual para grupos de trabalhadores em um mesmo serviço.',
    ],
    [
        'text' => 'Escolha a frase com a concordância verbal correta:',
        'options' => ['Fazem duas horas que ele saiu.', 'Haviam muitas pessoas na obra.', 'Sobrou apenas duas ferramentas.', 'Faz dois anos que a casa foi construída.'],
        'correct_answer' => 3,
        'rationale' => 'O verbo "fazer" indicando tempo decorrido é impessoal e fica no singular.',
    ],
    [
        'text' => 'O sinônimo de "rigor" é:',
        'options' => ['Desleixo.', 'Severidade/Precisão.', 'Pressa.', 'Medo.'],
        'correct_answer' => 1,
        'rationale' => 'Agir com rigor é agir com severidade, precisão ou exatidão.',
    ],
    [
        'text' => 'A palavra "construção" possui:',
        'options' => ['Um dígrafo e um ditongo.', 'Dois hiatos.', 'Apenas encontros consonantes.', 'Três sílabas oxítonas.'],
        'correct_answer' => 0,
        'rationale' => 'Possui o dígrafo vocálico "on" e o ditongo "ão".',
    ],
    [
        'text' => 'Em "Ele limpou as lentes", o verbo está no:',
        'options' => ['Presente.', 'Pretérito Perfeito.', 'Futuro do Presente.', 'Pretérito Imperfeito.'],
        'correct_answer' => 1,
        'rationale' => 'Indica uma ação pontual e completamente concluída no passado.',
    ],
    [
        'text' => 'Qual o feminino de "Mestre"?',
        'options' => ['Mestrona.', 'Mestra.', 'Mestreza.', 'Mestrina.'],
        'correct_answer' => 1,
        'rationale' => 'O feminino padrão de mestre é mestra.',
    ],
    [
        'text' => 'Na frase "Traga as ferramentas, Pedro!", a palavra Pedro é um:',
        'options' => ['Sujeito.', 'Vocativo.', 'Objeto direto.', 'Adjunto adnominal.'],
        'correct_answer' => 1,
        'rationale' => 'Pedro é um chamamento isolado por vírgula, sendo, portanto, um vocativo.',
    ],
    [
        'text' => 'Assinale a alternativa onde todas as palavras são proparoxítonas:',
        'options' => ['Café, cipó, rapé.', 'Lâmpada, sílaba, médico.', 'Cadeira, mesa, escola.', 'Partir, comer, sorrir.'],
        'correct_answer' => 1,
        'rationale' => 'Lâmpada, sílaba e médico têm a antepenúltima sílaba tônica.',
    ]
];

$mathQuestions = [
    [
        'text' => 'Um pedreiro assenta 200 tijolos por dia. Quantos tijolos ele assentará em 15 dias de trabalho?',
        'options' => ['2.000', '3.000', '4.500', '5.000'],
        'correct_answer' => 1,
        'rationale' => '200 * 15 = 3.000 tijolos.'
    ],
    [
        'text' => 'Uma parede tem 4 metros de altura e 5 metros de largura. Qual a área total dessa parede?',
        'options' => ['9 m²', '15 m²', '20 m²', '40 m²'],
        'correct_answer' => 2,
        'rationale' => 'Área = 4 * 5 = 20 m².'
    ],
    [
        'text' => 'Se 3 máquinas escavam um terreno em 10 horas, quantas máquinas iguais seriam necessárias para escavar o mesmo terreno em 5 horas?',
        'options' => ['1', '5', '6', '8'],
        'correct_answer' => 2,
        'rationale' => 'Regra de 3 inversa: 3 marinheiros * 10h = x * 5h => 30 = 5x => x = 6.'
    ],
    [
        'text' => 'Um saco de cimento de 50kg custa R$ 40,00. Se o preço subir 10%, qual será o novo valor?',
        'options' => ['R$ 41,00', 'R$ 44,00', 'R$ 45,00', 'R$ 50,00'],
        'correct_answer' => 1,
        'rationale' => '10% de 40 = 4. Novo valor: 40 + 4 = 44.'
    ],
    [
        'text' => 'Resolva a expressão: 100 - 5 x (10 + 2).',
        'options' => ['40', '60', '93', '1140'],
        'correct_answer' => 0,
        'rationale' => '100 - 5 * 12 = 100 - 60 = 40.'
    ],
    [
        'text' => 'Qual o valor de X na equação: 2x + 8 = 20?',
        'options' => ['4', '6', '10', '12'],
        'correct_answer' => 1,
        'rationale' => '2x = 20 - 8 => 2x = 12 => x = 6.'
    ],
    [
        'text' => 'Um caminhão cegonha transporta 12 carros. Quantas viagens serão necessárias para transportar 50 carros?',
        'options' => ['4', '4,1', '5', '6'],
        'correct_answer' => 2,
        'rationale' => '50 / 12 = 4,16. São necessárias 5 viagens para levar todos os carros.'
    ],
    [
        'text' => 'Uma escada de 10 metros está encostada em um muro. A base da escada está a 6 metros do muro. Qual a altura do muro atingida pela escada?',
        'options' => ['6 m', '7 m', '8 m', '9 m'],
        'correct_answer' => 2,
        'rationale' => 'Teorema de Pitágoras: 10² = 6² + h² => 100 = 36 + h² => h² = 64 => h = 8.'
    ],
    [
        'text' => 'Converta 4,5 km em metros:',
        'options' => ['450 m', '4.500 m', '45.000 m', '45 m'],
        'correct_answer' => 1,
        'rationale' => '4,5 * 1000 = 4.500 metros.'
    ],
    [
        'text' => 'O MMC entre 15 e 20 é:',
        'options' => ['5', '30', '60', '300'],
        'correct_answer' => 2,
        'rationale' => 'MMC(15, 20) = 60.'
    ],
    [
        'text' => 'Um reservatório retangular tem 2m de comprimento, 3m de largura e 2m de altura. Qual o volume em litros?',
        'options' => ['6.000 L', '12.000 L', '7.000 L', '5.000 L'],
        'correct_answer' => 1,
        'rationale' => 'Volume = 2 * 3 * 2 = 12 m³. 12 * 1000 = 12.000 litros.'
    ],
    [
        'text' => 'Qual a soma dos ângulos internos de um quadrado?',
        'options' => ['180°', '270°', '360°', '540°'],
        'correct_answer' => 2,
        'rationale' => 'Qualquer quadrilátero possui 360° de soma interna.'
    ],
    [
        'text' => 'Se um ângulo mede 75°, qual o seu complemento?',
        'options' => ['5°', '15°', '25°', '105°'],
        'correct_answer' => 1,
        'rationale' => 'Complemento soma 90°. 90 - 75 = 15°.'
    ],
    [
        'text' => 'Em uma caixa há 60 parafusos. 20% deles estão com defeito. Quantos parafusos estão bons?',
        'options' => ['12', '40', '48', '50'],
        'correct_answer' => 2,
        'rationale' => '20% de 60 = 12 com defeito. Bons = 60 - 12 = 48.'
    ],
    [
        'text' => 'Qual o sucessor do triplo de 15?',
        'options' => ['45', '46', '44', '16'],
        'correct_answer' => 1,
        'rationale' => 'Triplo de 15 = 45. Sucessor = 46.'
    ],
    [
        'text' => 'Um triângulo tem base de 12cm e altura de 10cm. Qual sua área?',
        'options' => ['120 cm²', '60 cm²', '22 cm²', '110 cm²'],
        'correct_answer' => 1,
        'rationale' => 'Área = (12 * 10) / 2 = 60 cm².'
    ],
    [
        'text' => 'Qual o MDC entre 24 e 36?',
        'options' => ['4', '6', '12', '24'],
        'correct_answer' => 2,
        'rationale' => 'O maior número que divide 24 e 36 simultaneamente é 12.'
    ],
    [
        'text' => 'Se 1 polegada equivale a aproximadamente 2,5 cm, quantos centímetros têm 4 polegadas?',
        'options' => ['5 cm', '7,5 cm', '10 cm', '12,5 cm'],
        'correct_answer' => 2,
        'rationale' => '4 * 2,5 = 10 cm.'
    ],
    [
        'text' => 'O perímetro de um triângulo equilátero cujo lado mede 7cm é:',
        'options' => ['14 cm', '21 cm', '49 cm', '28 cm'],
        'correct_answer' => 1,
        'rationale' => 'Triângulo equilátero tem 3 lados iguais. 7 * 3 = 21 cm.'
    ],
    [
        'text' => 'Um relógio marca 08:45. Quantos minutos faltam para as 10:00?',
        'options' => ['15 min', '45 min', '75 min', '115 min'],
        'correct_answer' => 2,
        'rationale' => 'De 08:45 até 09:45 é 60min. De 09:45 até 10:00 mais 15min. Total = 75 minutos.'
    ]
];

foreach ($portugueseQuestions as $q) {
    Question::create(array_merge($q, ['block' => 4, 'subject' => 'portugues']));
}

foreach ($mathQuestions as $q) {
    Question::create(array_merge($q, ['block' => 4, 'subject' => 'matematica']));
}

echo "Bloco 4 reformulado com sucesso!\n";
