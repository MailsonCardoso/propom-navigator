<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Question;

$text = "Considerando as unidades de medida de comprimento do Sistema Internacional, o valor de 2,5 quilômetros (km) quando convertido para metros (m) é equivalente a:";
$hint = "Para converter quilômetros (km) para metros (m), multiplicamos o valor por 1.000, pois 1 km equivale a 1.000 metros. Logo: 2,5 x 1.000 = 2.500 m.";

Question::where('id', 263)->update([
    'text' => $text,
    'hint' => $hint
]);

echo "Questão 263 atualizada com sucesso para a Opção 1.\n";
