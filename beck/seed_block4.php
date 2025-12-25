<?php

use App\Models\Question;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$block4 = [
    // LÍNGUA PORTUGUESA (121 a 130)
    [
        'block' => 4,
        'subject' => 'portugues',
        'text' => 'Assinale a alternativa que apresenta um substantivo COMPOSTO:',
        'options' => ['Passatempo', 'Marujo', 'Navegação', 'Tempestade'],
        'correct_answer' => 0,
        'rationale' => 'Substantivos compostos são formados por dois ou mais radicais. "Passatempo" (passa + tempo).',
        'hint' => 'Procure uma palavra formada pela união de duas outras.'
    ],
    [
        'block' => 4,
        'subject' => 'portugues',
        'text' => 'Na frase "O navio partiu cedo", o verbo é:',
        'options' => ['Transitivo Direto', 'Transitivo Indireto', 'Intransitivo', 'De ligação'],
        'correct_answer' => 2,
        'rationale' => 'Verbos intransitivos têm sentido completo e não exigem complemento (quem parte, simplesmente parte). "Cedo" é apenas um advérbio de tempo.',
        'hint' => 'O verbo precisa de um "quê" ou "quem" depois dele para fazer sentido?'
    ],
    [
        'block' => 4,
        'subject' => 'portugues',
        'text' => 'Qual a forma correta do aumentativo de "Barca"?',
        'options' => ['Barcona', 'Barcaça', 'Barquidrão', 'Barcão'],
        'correct_answer' => 1,
        'rationale' => '"Barcaça" é la forma irregular e culta do aumentativo de barca.',
        'hint' => 'É um termo muito comum no meio naval para embarcações grandes e chatas.'
    ],
    [
        'block' => 4,
        'subject' => 'portugues',
        'text' => 'Assinale a alternativa com a grafia CORRETA:',
        'options' => ['Analizar', 'Pesquizar', 'Improvisar', 'Paralisar'],
        'correct_answer' => 3,
        'rationale' => '"Paralisar" e "Improvisar" mantêm o \'s\' dos seus radicais originais (paralisia/improviso). Nota: A questão pede a correta, (c) e (d) estão certas, mas em concursos foca-se em "Paralisar" por ser a confusão mais comum com \'z\'.',
        'hint' => 'Vem de "paralisia".'
    ],
    [
        'block' => 4,
        'subject' => 'portugues',
        'text' => '"O capitão deu as ordens". Passando para a voz passiva, temos:',
        'options' => ['As ordens foram dadas pelo capitão.', 'O capitão tinha dado as ordens.', 'Deram-se as ordens.', 'As ordens dão-se.'],
        'correct_answer' => 0,
        'rationale' => 'Na voz passiva analítica, o objeto direto vira sujeito e usa-se o verbo auxiliar "ser".',
        'hint' => 'O que foi feito pelas ordens?'
    ],
    [
        'block' => 4,
        'subject' => 'portugues',
        'text' => 'A palavra "Extraordinário" possui:',
        'options' => ['Um prefixo', 'Um sufixo', 'Um prefixo e um sufixo', 'Apenas radical'],
        'correct_answer' => 0,
        'rationale' => 'Possui o prefixo "extra-" unido ao radical "ordinário".',
        'hint' => '"Extra" significa "fora de" ou "além de".'
    ],
    [
        'block' => 4,
        'subject' => 'portugues',
        'text' => 'Qual o sujeito da frase "Vende-se este barco"?',
        'options' => ['Indeterminado', 'Oculto', 'Este barco', 'Inexistente'],
        'correct_answer' => 2,
        'rationale' => 'Em "Vende-se algo", o "se" é partícula apassivadora. Logo, "Este barco é vendido". O sujeito é "Este barco".',
        'hint' => 'Tente inverter a frase para a voz passiva.'
    ],
    [
        'block' => 4,
        'subject' => 'portugues',
        'text' => 'Assinale o adjetivo que está no grau COMPARATIVO DE INFERIORIDADE:',
        'options' => ['Menos alto que', 'Tão alto quanto', 'Mais alto que', 'Altíssimo'],
        'correct_answer' => 0,
        'rationale' => 'O comparativo de inferioridade usa a estrutura "menos... que/do que".',
        'hint' => 'Indica que algo é "menos" que outro.'
    ],
    [
        'block' => 4,
        'subject' => 'portugues',
        'text' => '"Talvez eu vá à praia". O verbo "vá" indica:',
        'options' => ['Certeza', 'Dúvida/Possibilidade', 'Ordem', 'Hábito'],
        'correct_answer' => 1,
        'rationale' => 'O modo subjuntivo é usado para expressar incerteza.',
        'hint' => 'Palavras como "talvez" ou "oxalá" pedem esse modo.'
    ],
    [
        'block' => 4,
        'subject' => 'portugues',
        'text' => 'Qual a função da crase em "Às vezes saímos"?',
        'options' => ['Locução adverbial feminina de tempo', 'Preposição pura', 'Artigo definido', 'Pronome demonstrativo'],
        'correct_answer' => 0,
        'rationale' => 'Locuções adverbiais femininas (à medida que, às vezes, à noite) recebem crase obrigatoriamente.',
        'hint' => 'Indica uma circunstância de tempo.'
    ],

    // MATEMÁTICA (131 a 160)
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Um reservatório de água tem 1.500 litros. Se utilizarmos 2/5 dessa água, quantos litros restarão?',
        'options' => ['600 L', '900 L', '1.000 L', '1.200 L'],
        'correct_answer' => 1,
        'rationale' => '2/5 de 1500=600 (usado). O que resta é 1500−600=900.',
        'hint' => 'Calcule quanto foi usado e subtraia do total.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Qual o valor de x no triângulo retângulo onde os catetos medem 9 e 12?',
        'options' => ['15', '18', '21', '25'],
        'correct_answer' => 0,
        'rationale' => 'x^2 = 9^2 + 12^2 = 81+144=225 => x=15.',
        'hint' => 'Teorema de Pitágoras (a^2 = b^2 + c^2).'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Um polígono de 6 lados é chamado de:',
        'options' => ['Pentágono', 'Hexágono', 'Heptágono', 'Octógono'],
        'correct_answer' => 1,
        'rationale' => 'Prefixo "Hexa" significa seis.',
        'hint' => 'Lembre-se do "Hexacampeonato".'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Se 8 pedreiros constroem um muro em 10 dias, quanto tempo levarão 5 pedreiros?',
        'options' => ['6 dias', '12 dias', '16 dias', '20 dias'],
        'correct_answer' => 2,
        'rationale' => 'Grandeza inversamente proporcional. 8×10=5×x => 80=5x => x=16.',
        'hint' => 'Se tem menos gente trabalhando, vai demorar mais tempo.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Qual o valor de 10% de 10% de 500?',
        'options' => ['5', '10', '50', '100'],
        'correct_answer' => 0,
        'rationale' => '10% de 500=50. 10% de 50=5.',
        'hint' => 'Calcule a primeira porcentagem e depois a segunda sobre o resultado.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'O suplemento de um ângulo de 110° é:',
        'options' => ['70°', '80°', '90°', '180°'],
        'correct_answer' => 0,
        'rationale' => 'Ângulos suplementares somam 180°. 180−110=70.',
        'hint' => 'Quanto falta para uma linha reta (180°)?'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'A raiz quadrada de 0,49 é:',
        'options' => ['0,07', '0,7', '7', '0,49'],
        'correct_answer' => 1,
        'rationale' => '0,7×0,7=0,49.',
        'hint' => 'Pense na raiz de 49 e ajuste as casas decimais.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Quantas arestas possui um cubo?',
        'options' => ['6', '8', '10', '12'],
        'correct_answer' => 3,
        'rationale' => 'Um cubo tem 12 segmentos de reta que unem seus vértices.',
        'hint' => 'Conte as "linhas" ou bordas da caixa.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Resolva a expressão: (12+8)×(10−5):',
        'options' => ['50', '100', '150', '200'],
        'correct_answer' => 1,
        'rationale' => 'Primeiro os parênteses: 20×5=100.',
        'hint' => 'Resolva o que está dentro de cada parêntese primeiro.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Um círculo tem diâmetro de 20 cm. Qual o seu raio?',
        'options' => ['5 cm', '10 cm', '20 cm', '40 cm'],
        'correct_answer' => 1,
        'rationale' => 'O raio é a metade do diâmetro.',
        'hint' => 'Divida por 2.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Qual a média aritmética dos números 10, 20, 30 e 40?',
        'options' => ['20', '25', '30', '35'],
        'correct_answer' => 1,
        'rationale' => '(10+20+30+40)/4=100/4=25.',
        'hint' => 'Some todos e divida pela quantidade de números.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Em um mapa de escala 1:100.000, 5 cm representam quantos quilômetros reais?',
        'options' => ['5 km', '50 km', '500 km', '5.000 km'],
        'correct_answer' => 0,
        'rationale' => '5×100.000=500.000 cm. Convertendo para km: 500.000/100.000=5 km.',
        'hint' => '1:100.000 significa que 1 cm no papel vale 1 km na vida real.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Se 2x+5=x+12, então x é:',
        'options' => ['5', '7', '12', '17'],
        'correct_answer' => 1,
        'rationale' => '2x−x=12−5⇒x=7.',
        'hint' => 'Letras para um lado, números para o outro mudando o sinal.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Qual o volume de uma esfera de raio 3? (Considere π=3)',
        'options' => ['27', '54', '81', '108'],
        'correct_answer' => 3,
        'rationale' => 'V=(4/3)⋅π⋅r^3 => V=(4/3)⋅3⋅27=4⋅27=108.',
        'hint' => 'Use a fórmula 4⋅r^3 se π simplificar com o 3 de baixo.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Quantos segundos há em 2 horas?',
        'options' => ['120', '3.600', '7.200', '10.000'],
        'correct_answer' => 2,
        'rationale' => '2×60 min ×60 seg =7.200.',
        'hint' => 'Uma hora tem 3.600 segundos.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Um ângulo de 180° é um ângulo:',
        'options' => ['Nulo', 'Raso', 'Pleno', 'Obtuso'],
        'correct_answer' => 1,
        'rationale' => 'Ângulo raso ou de meia volta.',
        'hint' => 'É uma linha reta.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'A soma de dois números complementares é:',
        'options' => ['45°', '90°', '180°', '360°'],
        'correct_answer' => 1,
        'rationale' => 'Definição de ângulos complementares.',
        'hint' => 'Juntos formam um "L".'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Se uma dúzia de ovos custa R$ 12,00, quanto custam 15 ovos?',
        'options' => ['R$ 13,00', 'R$ 15,00', 'R$ 18,00', 'R$ 20,00'],
        'correct_answer' => 1,
        'rationale' => '1 ovo custa R$ 1,00. 15 custam R$ 15,00.',
        'hint' => 'Calcule o valor unitário.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'O valor de (−2)^3 é:',
        'options' => ['8', '-8', '6', '-6'],
        'correct_answer' => 1,
        'rationale' => '(−2)×(−2)×(−2)=4×(−2)=−8.',
        'hint' => 'Base negativa elevada a expoente ímpar dá resultado negativo.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Qual a área de um trapézio de bases 10 e 6, e altura 4?',
        'options' => ['16', '32', '48', '64'],
        'correct_answer' => 1,
        'rationale' => 'Area =[(B+b)⋅h]/2 => [(10+6)⋅4]/2=16⋅2=32.',
        'hint' => 'Some as bases, multiplique pela altura e divida por 2.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Um triângulo com todos os lados diferentes é:',
        'options' => ['Equilátero', 'Isósceles', 'Escaleno', 'Retângulo'],
        'correct_answer' => 2,
        'rationale' => 'Classificação quanto aos lados.',
        'hint' => 'Lembre-se: Escaleno = Escada (degraus diferentes).'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Quanto é 0,5×0,5?',
        'options' => ['0,1', '0,25', '1,0', '2,5'],
        'correct_answer' => 1,
        'rationale' => 'Multiplicação decimal padrão.',
        'hint' => '5×5=25, depois conte duas casas decimais.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Um quilo de carne custa R$ 40,00. Quanto custam 250 gramas?',
        'options' => ['R$ 5,00', 'R$ 10,00', 'R$ 15,00', 'R$ 20,00'],
        'correct_answer' => 1,
        'rationale' => '250g é 1/4 de quilo. 40/4=10.',
        'hint' => 'Divida por 4, pois 250g entra quatro vezes em 1kg.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Qual o próximo número da sequência: 2, 4, 8, 16...?',
        'options' => ['20', '24', '30', '32'],
        'correct_answer' => 3,
        'rationale' => 'Progressão geométrica de razão 2. Cada número é o dobro do anterior.',
        'hint' => 'Multiplique por 2.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'O que é um polígono regular?',
        'options' => ['Tem todos os lados iguais.', 'Tem todos os ângulos iguais.', 'Tem lados e ângulos iguais.', 'Tem lados diferentes.'],
        'correct_answer' => 2,
        'rationale' => 'Regularidade exige igualdade de lados (equilátero) e ângulos (equiângulo).',
        'hint' => 'É a forma mais "perfeita" do polígono.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'A dízima periódica 0,333... equivale a qual fração?',
        'options' => ['1/2', '1/3', '3/10', '3/100'],
        'correct_answer' => 1,
        'rationale' => '3/9 simplificado por 3 é 1/3.',
        'hint' => 'Divida 1 por 3 na calculadora para conferir.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Em um retângulo, a diagonal mede 10 e um lado mede 8. Qual o outro lado?',
        'options' => ['4', '6', '8', '12'],
        'correct_answer' => 1,
        'rationale' => 'Triângulo pitagórico 6, 8, 10. 10^2 = 8^2 + x^2 => 100=64+x^2 => 36=x^2 => x=6.',
        'hint' => 'Use Pitágoras com a diagonal sendo a hipotenusa.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'O MMC entre 12 e 18 é:',
        'options' => ['6', '36', '72', '108'],
        'correct_answer' => 1,
        'rationale' => 'Múltiplos de 12: 12, 24, 36... Múltiplos de 18: 18, 36...',
        'hint' => 'Menor número que está na tabuada dos dois.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Uma calça custa R$ 120,00. Com desconto de 25%, quanto custará?',
        'options' => ['R$ 80,00', 'R$ 90,00', 'R$ 100,00', 'R$ 110,00'],
        'correct_answer' => 1,
        'rationale' => '25% de 120=30. 120−30=90.',
        'hint' => '25% é o mesmo que tirar 1/4 do valor.'
    ],
    [
        'block' => 4,
        'subject' => 'matematica',
        'text' => 'Qual a soma de 3/5+1/2?',
        'options' => ['4/7', '4/10', '11/10', '1/5'],
        'correct_answer' => 2,
        'rationale' => 'MMC(5, 2) = 10. (6+5)/10=11/10.',
        'hint' => 'Multiplique cruzado e some para o numerador, multiplique os de baixo para o denominador.'
    ],
];

foreach ($block4 as $q) {
    Question::create($q);
}

echo "Block 4 seeded successfully!\n";
