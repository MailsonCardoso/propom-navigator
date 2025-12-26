<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Question;

$text = "Considere um sólido geométrico em formato de cubo, cujas arestas medem 2 metros cada. O volume total deste sólido, convertido para litros, corresponde a:";
$hint = "Para calcular o volume de um cubo, multiplicamos suas dimensões (2m x 2m x 2m = 8m³). Como 1m³ equivale a 1.000 litros, o volume resultante é de 8.000 litros.";

Question::where('id', 264)->update([
    'text' => $text,
    'hint' => $hint
]);

echo "Questão 264 atualizada com sucesso para a Opção 1.\n";
