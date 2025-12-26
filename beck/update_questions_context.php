<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$updates = [
    22 => [
        'text' => 'Três navios de patrulha saem do porto em intervalos de 8, 12 e 18 horas respectivamente. Se saíram juntos agora, em quantas horas voltarão a sair simultaneamente?',
        'options' => ['36 horas', '48 horas', '72 horas', '96 horas'],
        'correct_answer' => 2,
        'rationale' => 'Problema de MMC. MMC(8, 12, 18) = 2³ * 3² = 8 * 9 = 72 horas.'
    ],
    27 => [
        'text' => 'Um triângulo tem lados que medem três números ímpares consecutivos. Se o perímetro desse triângulo é 51 cm, a medida do maior lado é:',
        'options' => ['15 cm', '17 cm', '19 cm', '21 cm'],
        'correct_answer' => 2,
        'rationale' => 'Sejam os lados: x, x+2 e x+4. Soma = 3x + 6 = 51 => 3x = 45 => x = 15. Lados: 15, 17, 19. O maior é 19.'
    ],
    30 => [
        'text' => 'Dois prédios de 20m e 35m de altura estão a 20m de distância um do outro. Qual o comprimento mínimo de um cabo de aço esticado ligando o topo desses dois prédios?',
        'options' => ['20 m', '22 m', '25 m', '30 m'],
        'correct_answer' => 2,
        'rationale' => 'Teorema de Pitágoras. Cateto 1 = 35 - 20 = 15m. Cateto 2 = 20m (distância). Hipotenusa² = 15² + 20² = 225 + 400 = 625 => Hipotenusa = 25m.'
    ],
    37 => [
        'text' => 'Um marinheiro tem dois rolos de cabo, um com 48 metros e outro com 60 metros. Ele deseja cortá-los em pedaços iguais do maior tamanho possível, sem haver sobras. Qual o tamanho de cada pedaço?',
        'options' => ['6 m', '10 m', '12 m', '15 m'],
        'correct_answer' => 2,
        'rationale' => 'Problema de MDC. MDC(48, 60): 48 = 2⁴*3, 60 = 2²*3*5. MDC = 2²*3 = 12 metros.'
    ],
    75 => [
        'text' => 'Qual o menor valor inteiro que deve ser somado ao número 2.500 para que ele se torne divisível por 2 e por 9 simultaneamente?',
        'options' => ['2', '4', '7', '8'],
        'correct_answer' => 0,
        'rationale' => 'Divisível por 2 (deve ser par) e por 9 (soma dos algarismos divisível por 9). 2+5+0+0 = 7. Somando 2, temos 2502. 2+5+0+2 = 9. 2502 é par e divisível por 9.'
    ],
    104 => [
        'text' => 'Se 10 marinheiros pintam 20m² de convés em 2 dias trabalhando 6 horas/dia, quantos dias 5 marinheiros levarão para pintar 10m² trabalhando 4 horas/dia?',
        'options' => ['2 dias', '3 dias', '4 dias', '5 dias'],
        'correct_answer' => 1,
        'rationale' => 'Regra de Três Composta. (10 marinheiros / 5 marinheiros) * (10m² / 20m²) * (6h / 4h) * 2 dias = 2 * 0.5 * 1.5 * 2 = 3 dias.'
    ],
    141 => [
        'text' => 'Em um monitoramento de 100 sensores de fumaça, detectou-se que 40 têm defeito no circuito A, 30 no circuito B e 15 em ambos os circuitos. Quantos sensores estão funcionando perfeitamente?',
        'options' => ['15', '30', '45', '55'],
        'correct_answer' => 2,
        'rationale' => 'Diagrama de Venn. Total com defeito = A + B - Ambos = 40 + 30 - 15 = 55. Funcionando = 100 - 55 = 45.'
    ],
    156 => [
        'text' => 'O produto de dois números inteiros positivos e consecutivos resulta em 156. A soma desses dois números é igual a:',
        'options' => ['23', '25', '27', '31'],
        'correct_answer' => 1,
        'rationale' => 'Equação do 2º Grau. x(x+1) = 156 => x² + x - 156 = 0. Raízes: 12 e -13. Números: 12 e 13. Soma = 25.'
    ]
];

foreach ($updates as $id => $data) {
    $q = Question::find($id);
    if ($q) {
        $q->text = $data['text'];
        $q->options = $data['options'];
        $q->correct_answer = $data['correct_answer'];
        $q->rationale = $data['rationale'];
        $q->save();
        echo "Question ID {$id} updated successfully.\n";
    }
}
echo "Migration finished.\n";
