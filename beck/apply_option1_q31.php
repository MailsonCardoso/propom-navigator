<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Question;

$text = "Em um grupo de 40 pessoas, verificou-se que 25 consomem peixe, 20 consomem carne e 10 consomem ambos os alimentos. O número de pessoas que não consomem nenhum desses dois alimentos é:";
$hint = "Utilizando a fórmula da união de dois conjuntos: n(A ∪ B) = n(A) + n(B) - n(A ∩ B). Logo: 25 + 20 - 10 = 35 pessoas consomem ao menos um dos alimentos. Como o total é 40, as pessoas que não consomem nenhum são: 40 - 35 = 5.";

Question::where('id', 31)->update([
    'text' => $text,
    'hint' => $hint
]);

echo "Questão 31 atualizada com sucesso para a Opção 1.\n";
