<?php

use App\Models\Question;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$block5 = [
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Um marinheiro pintou 1/3 de um convés pela manhã e 2/5 à tarde. Que fração do convés ele já pintou no total?',
        'options' => ['3/8', '11/15', '7/15', '3/15'],
        'correct_answer' => 1,
        'rationale' => 'MMC(3, 5) = 15. Convertendo: 5/15 + 6/15 = 11/15.',
        'hint' => 'Some as frações encontrando um denominador comum.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Qual o valor de x na equação: x/4 + 2 = 10?',
        'options' => ['16', '24', '32', '40'],
        'correct_answer' => 2,
        'rationale' => 'x/4 = 10 - 2 => x/4 = 8 => x = 8 x 4 = 32.',
        'hint' => 'Primeiro passe o 2 subtraindo e depois o 4 multiplicando.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Um ângulo de 45° é classificado como:',
        'options' => ['Reto', 'Obtuso', 'Agudo', 'Raso'],
        'correct_answer' => 2,
        'rationale' => 'Ângulos menores que 90° são chamados de agudos.',
        'hint' => 'É um ângulo "fechado".'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Se a diagonal de um quadrado mede 5√2 cm, qual é a medida do lado desse quadrado?',
        'options' => ['5 cm', '10 cm', '2,5 cm', '5√2 cm'],
        'correct_answer' => 0,
        'rationale' => 'A fórmula da diagonal do quadrado é d = L√2. Logo, L = 5.',
        'hint' => 'A diagonal é o lado multiplicado pela raiz de 2.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Uma caixa d\'água em formato de cilindro tem raio de 1m e altura de 2m. Qual o volume aproximado em litros? (Use π = 3,14)',
        'options' => ['3.140 L', '6.280 L', '1.570 L', '2.000 L'],
        'correct_answer' => 1,
        'rationale' => 'V = π * r² * h => 3,14 * 1² * 2 = 6,28 m³ = 6.280 litros.',
        'hint' => 'Área da base (círculo) vezes a altura.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Qual o 10º termo da progressão aritmética (2, 5, 8, 11...)?',
        'options' => ['25', '27', '29', '31'],
        'correct_answer' => 2,
        'rationale' => 'a_n = a_1 + (n-1) * r => 2 + (9 * 3) = 2 + 27 = 29.',
        'hint' => 'A razão é 3. Use a fórmula do termo geral.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Um triângulo equilátero tem 18 cm de perímetro. Qual a medida de cada lado?',
        'options' => ['4 cm', '6 cm', '9 cm', '3 cm'],
        'correct_answer' => 1,
        'rationale' => 'O triângulo equilátero tem 3 lados iguais. 18 / 3 = 6.',
        'hint' => 'Divida o perímetro pelo número de lados.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Quanto é 2⁵?',
        'options' => ['10', '16', '32', '64'],
        'correct_answer' => 2,
        'rationale' => '2 x 2 x 2 x 2 x 2 = 32.',
        'hint' => 'O número 2 multiplicado por ele mesmo 5 vezes.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Um navio viaja a 20 nós. Se 1 nó ≈ 1,85 km/h, qual a velocidade em km/h?',
        'options' => ['20 km/h', '37 km/h', '40 km/h', '18,5 km/h'],
        'correct_answer' => 1,
        'rationale' => '20 x 1,85 = 37.',
        'hint' => 'Multiplique a velocidade em nós pelo fator de conversão.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Qual a raiz cúbica de 27?',
        'options' => ['3', '9', '2', '4'],
        'correct_answer' => 0,
        'rationale' => '3 x 3 x 3 = 27.',
        'hint' => 'Que número multiplicado por ele mesmo três vezes dá 27?'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Um conjunto A tem 10 elementos, o conjunto B tem 15 elementos, e a intersecção tem 4 elementos. Quantos elementos tem a união A ∪ B?',
        'options' => ['25', '21', '19', '29'],
        'correct_answer' => 1,
        'rationale' => 'n(A ∪ B) = n(A) + n(B) - n(A ∩ B) => 10 + 15 - 4 = 21.',
        'hint' => 'Some os dois e subtraia o que eles têm em comum para não contar duas vezes.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Em uma proporção, x/8 = 3/4. Qual o valor de x?',
        'options' => ['4', '6', '12', '2'],
        'correct_answer' => 1,
        'rationale' => '4x = 24 => x = 6.',
        'hint' => 'Multiplique cruzado.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Qual a soma dos ângulos internos de um quadrilátero?',
        'options' => ['90°', '180°', '360°', '540°'],
        'correct_answer' => 2,
        'rationale' => 'Qualquer quadrilátero pode ser dividido em dois triângulos (180 + 180 = 360).',
        'hint' => 'Pense num quadrado ou retângulo (4 vezes 90).'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Um carro consome 1 litro para cada 12 km. Quantos litros ele gastará para percorrer 150 km?',
        'options' => ['10,5 L', '12 L', '12,5 L', '15 L'],
        'correct_answer' => 2,
        'rationale' => '150 / 12 = 12,5.',
        'hint' => 'Divida a distância total pelo consumo por litro.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'O valor da expressão √64 + √36 é:',
        'options' => ['10', '14', '100', '48'],
        'correct_answer' => 1,
        'rationale' => '8 + 6 = 14.',
        'hint' => 'Calcule as raízes separadamente e depois some.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Qual o nome do polígono de 8 lados?',
        'options' => ['Hexágono', 'Heptágono', 'Octógono', 'Eneágono'],
        'correct_answer' => 2,
        'rationale' => 'Prefixo "Octo" significa oito.',
        'hint' => 'Lembre-se do ringue de MMA.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Se um relógio marca 10h10min, qual o ângulo formado pelos ponteiros?',
        'options' => ['90°', '115°', '120°', '150°'],
        'correct_answer' => 1,
        'rationale' => 'Usando a fórmula |(60h - 11m)/2| => |(600 - 110)/2| = 245. Como queremos o menor ângulo: 360 - 245 = 115°.',
        'hint' => 'Lembre-se que o ponteiro das horas também se move um pouco.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Quanto é 25% de R$ 480,00?',
        'options' => ['R$ 100,00', 'R$ 120,00', 'R$ 240,00', 'R$ 90,00'],
        'correct_answer' => 1,
        'rationale' => '25% é 1/4. 480 / 4 = 120.',
        'hint' => 'Divida por 4.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Um triângulo retângulo tem hipotenusa 13 e um cateto 5. Qual o outro cateto?',
        'options' => ['8', '10', '12', '7'],
        'correct_answer' => 2,
        'rationale' => '13² = 5² + x² => 169 = 25 + x² => x = 12.',
        'hint' => 'Outro triângulo pitagórico famoso (5, 12, 13).'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'O que é uma dízima periódica simples?',
        'options' => ['Um número com infinitas casas decimais que não se repetem.', 'Um número onde a parte decimal se repete logo após a vírgula.', 'Um número que termina em zero.', 'Uma fração imprópria.'],
        'correct_answer' => 1,
        'rationale' => 'Ex: 0,777... onde o período começa imediatamente após a vírgula.',
        'hint' => 'O número que se repete não tem "atraso".'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Transforme 3,5 horas em minutos:',
        'options' => ['180 min', '200 min', '210 min', '350 min'],
        'correct_answer' => 2,
        'rationale' => '3,5 x 60 = 210.',
        'hint' => '3 horas são 180 min, e meia hora são 30 min.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Qual o volume de uma esfera de diâmetro 2? (Use π = 3)',
        'options' => ['2', '4', '8', '12'],
        'correct_answer' => 1,
        'rationale' => 'Raio = 1. V = (4/3) * 3 * 1³ = 4.',
        'hint' => 'Primeiro ache o raio (metade do diâmetro).'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'O resultado de (-10) ÷ (-2) é:',
        'options' => ['-5', '5', '20', '-20'],
        'correct_answer' => 1,
        'rationale' => 'Na divisão, menos com menos dá mais.',
        'hint' => 'Regra de sinais da divisão.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Qual a área de um losango com diagonais de 10 cm e 8 cm?',
        'options' => ['80 cm²', '40 cm²', '20 cm²', '18 cm²'],
        'correct_answer' => 1,
        'rationale' => 'Área do losango = (D x d) / 2 => (10 x 8) / 2 = 40.',
        'hint' => 'Multiplique as diagonais e divida por 2.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Um ângulo de 120° e um de 60° são:',
        'options' => ['Complementares', 'Suplementares', 'Opostos pelo vértice', 'Adjacentes'],
        'correct_answer' => 1,
        'rationale' => 'A soma deles é 180°.',
        'hint' => 'Pense no valor da soma deles.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Qual o valor de x em: 2^x = 16?',
        'options' => ['2', '3', '4', '8'],
        'correct_answer' => 2,
        'rationale' => '2 x 2 x 2 x 2 = 16.',
        'hint' => 'Quantas vezes o 2 se multiplica para chegar em 16?'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Se um dado é jogado, qual a probabilidade de sair um número PAR?',
        'options' => ['1/6', '1/2', '1/3', '2/3'],
        'correct_answer' => 1,
        'rationale' => 'Números pares: {2, 4, 6} (3 opções). Total: 6. 3/6 = 1/2.',
        'hint' => 'Metade dos números do dado são pares.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'O que é um número irracional?',
        'options' => ['Pode ser escrito como fração.', 'Tem dízima periódica.', 'Tem infinitas casas decimais não periódicas.', 'É sempre negativo.'],
        'correct_answer' => 2,
        'rationale' => 'Ex: π ou √2. Não podem ser escritos como razão de dois inteiros.',
        'hint' => 'Ele não tem um padrão de repetição nos decimais.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Determine o valor de y no sistema: x+y=10 e x-y=2.',
        'options' => ['4', '6', '8', '5'],
        'correct_answer' => 0,
        'rationale' => 'Somando as equações: 2x = 12 => x = 6. Substituindo: 6+y=10 => y=4.',
        'hint' => 'Use o método da adição.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Quantos lados tem um dodecágono?',
        'options' => ['10', '12', '15', '20'],
        'correct_answer' => 1,
        'rationale' => '"Do" (dois) + "deca" (dez).',
        'hint' => '2 + 10.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Qual a simplificação da expressão 2(x+3) - 4?',
        'options' => ['2x + 2', '2x - 1', '2x + 6', '2x - 4'],
        'correct_answer' => 0,
        'rationale' => '2x + 6 - 4 = 2x + 2.',
        'hint' => 'Use a propriedade distributiva ("chuveirinho").'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Um capital de R$ 1.000,00 a juros simples de 2% ao mês renderá quanto de juros em 5 meses?',
        'options' => ['R$ 100,00', 'R$ 50,00', 'R$ 200,00', 'R$ 1.100,00'],
        'correct_answer' => 0,
        'rationale' => 'J = C * i * t => 1000 * 0,02 * 5 = 100.',
        'hint' => 'Juros = Capital * Taxa * Tempo.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Um hexágono regular pode ser dividido em quantos triângulos equiláteros?',
        'options' => ['4', '5', '6', '8'],
        'correct_answer' => 2,
        'rationale' => 'Partindo do centro para os vértices, formam-se 6 triângulos.',
        'hint' => 'Desenhe linhas do centro para cada canto.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Qual a medida de um ângulo interno de um quadrado?',
        'options' => ['45°', '90°', '60°', '180°'],
        'correct_answer' => 1,
        'rationale' => 'Por definição, o quadrado possui 4 ângulos retos.',
        'hint' => 'É o ângulo característico de figuras retangulares.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Quanto é 10³?',
        'options' => ['30', '100', '1.000', '10.000'],
        'correct_answer' => 2,
        'rationale' => '10 x 10 x 10 = 1.000.',
        'hint' => 'O expoente indica quantos zeros vêm após o 1.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Se f(x) = 2x + 5, qual o valor de f(3)?',
        'options' => ['8', '10', '11', '13'],
        'correct_answer' => 2,
        'rationale' => '2(3) + 5 = 6 + 5 = 11.',
        'hint' => 'Substitua o x pelo número 3.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Qual o MDC de 12, 24 e 36?',
        'options' => ['6', '12', '24', '2'],
        'correct_answer' => 1,
        'rationale' => '12 divide os outros dois números perfeitamente.',
        'hint' => 'O maior número que divide todos eles ao mesmo tempo.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Um terreno tem 20m de frente e 30m de fundo. Se cercarmos com 4 fios de arame, quantos metros de arame usaremos?',
        'options' => ['100 m', '200 m', '400 m', '600 m'],
        'correct_answer' => 2,
        'rationale' => 'Perímetro = 20+20+30+30 = 100. Arame = 100 x 4 = 400.',
        'hint' => 'Calcule o perímetro e multiplique pelo número de fios.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Qual a terça parte de 150?',
        'options' => ['30', '45', '50', '75'],
        'correct_answer' => 2,
        'rationale' => '150 / 3 = 50.',
        'hint' => 'Divida por 3.'
    ],
    [
        'block' => 5,
        'subject' => 'matematica',
        'text' => 'Quantos graus tem uma volta completa?',
        'options' => ['90°', '180°', '270°', '360°'],
        'correct_answer' => 3,
        'rationale' => 'Definição da circunferência em graus.',
        'hint' => 'O giro total de um ponteiro de relógio.'
    ],
];

foreach ($block5 as $q) {
    Question::create($q);
}

echo "Block 5 seeded successfully!\n";
