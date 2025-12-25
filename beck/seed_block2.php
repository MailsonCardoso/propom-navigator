<?php

use App\Models\Question;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$block2 = [
    // PT BLOCO 2
    ['block' => 2, 'subject' => 'portugues', 'text' => "Qual é o plural da expressão \"sinal sonoro\"?", 'options' => ['Sinais sonoroses', 'Sinais sonoro', 'Sinais sonoros', 'Sinal sonoros'], 'correct_answer' => 2, 'rationale' => 'Ambos os termos (substantivo e adjetivo) variam em plural.', 'hint' => 'Sinal -> Sinais'],
    ['block' => 2, 'subject' => 'portugues', 'text' => "Indique o antônimo de \"calmaria\":", 'options' => ['Paz', 'Tranquilidade', 'Tempestade', 'Silêncio'], 'correct_answer' => 2, 'rationale' => 'Calmaria é estado de mar tranquilo, o oposto é tempestade.', 'hint' => 'Agitação no mar.'],
    ['block' => 2, 'subject' => 'portugues', 'text' => "A palavra \"marujo\" é:", 'options' => ['Proparoxítona', 'Paroxítona', 'Oxítona', 'Monossílabo'], 'correct_answer' => 1, 'rationale' => 'Ma-ru-jo. A sílaba forte é a penúltima.', 'hint' => 'Sílaba forte.'],
    ['block' => 2, 'subject' => 'portugues', 'text' => "Qual o feminino de \"mestre\"?", 'options' => ['Mestra', 'Mestrena', 'Mestresa', 'Mestrina'], 'correct_answer' => 0, 'rationale' => 'O feminino de mestre é mestra.', 'hint' => 'Terminação em A.'],
    ['block' => 2, 'subject' => 'portugues', 'text' => "Assinale a alternativa que indica uma característica (adjetivo):", 'options' => ['Barco', 'Navegar', 'Azul', 'Marinheiro'], 'correct_answer' => 2, 'rationale' => 'Azul é uma cor, portanto qualifica um substantivo.', 'hint' => 'Cor.'],
    // MAT BLOCO 2
    ['block' => 2, 'subject' => 'matematica', 'text' => 'Um navio percorre 120 milhas em 4 horas. Qual a velocidade média?', 'options' => ['20 mph', '30 mph', '40 mph', '50 mph'], 'correct_answer' => 1, 'rationale' => '120 / 4 = 30.', 'hint' => 'Distância / Tempo.'],
    ['block' => 2, 'subject' => 'matematica', 'text' => 'Quanto é 15% de 200?', 'options' => ['20', '25', '30', '35'], 'correct_answer' => 2, 'rationale' => '0,15 x 200 = 30.', 'hint' => '15 x 2.'],
    ['block' => 2, 'subject' => 'matematica', 'text' => 'Soma de 0,5 + 0,25?', 'options' => ['0,30', '0,75', '0,80', '1,0'], 'correct_answer' => 1, 'rationale' => '0,50 + 0,25 = 0,75.', 'hint' => 'Use vírgula sob vírgula.'],
    ['block' => 2, 'subject' => 'matematica', 'text' => 'Raiz quadrada de 144?', 'options' => ['10', '11', '12', '13'], 'correct_answer' => 2, 'rationale' => '12 x 12 = 144.', 'hint' => 'Número x ele mesmo.'],
    ['block' => 2, 'subject' => 'matematica', 'text' => 'Dobro de 15 somado a 10?', 'options' => ['25', '30', '40', '50'], 'correct_answer' => 2, 'rationale' => '2 x 15 + 10 = 40.', 'hint' => 'Multiplique primeiro.'],
];

foreach ($block2 as $q) {
    Question::create($q);
}

echo "Block 2 seeded!\n";
