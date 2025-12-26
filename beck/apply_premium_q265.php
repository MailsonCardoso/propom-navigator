<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Question;

$text = "De acordo com as propriedades fundamentais da geometria plana, a soma das medidas dos ângulos internos de qualquer triângulo é sempre equivalente a:";
$hint = "A soma dos ângulos internos de um triângulo é uma constante na geometria euclidiana, sendo sempre igual a 180°, independentemente do tipo de triângulo (isósceles, equilátero ou escaleno).";

Question::where('id', 265)->update([
    'text' => $text,
    'hint' => $hint
]);

echo "Questão 265 atualizada com sucesso para Sugestão Premium.\n";
