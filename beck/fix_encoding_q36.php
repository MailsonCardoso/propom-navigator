<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Question;

$text = "Um recipiente contém 12 esferas vermelhas e 18 esferas azuis. Determine a razão entre a quantidade de esferas vermelhas e a quantidade total de esferas nesse recipiente:";
$hint = "Para calcular a razão, somamos o total de esferas (12 + 18 = 30). A razão solicitada é 12/30. Simplificando a fração por 6 (12:6 / 30:6), obtemos 2/5.";

Question::where('id', 36)->update([
    'text' => $text,
    'hint' => $hint
]);

echo "Questão 36 atualizada com sucesso (UTF-8).\n";
