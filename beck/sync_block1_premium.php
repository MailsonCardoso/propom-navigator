<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Question;

// Q34 - Cubo
Question::where('id', 34)->update([
    'text' => "Considere um sólido geométrico em formato de cubo, cujas arestas medem 2 metros cada. O volume total deste sólido, convertido para litros, corresponde a:",
    'hint' => "Para calcular o volume de um cubo, multiplicamos suas dimensões (2m x 2m x 2m = 8m³). Como 1m³ equivale a 1.000 litros, o volume resultante é de 8.000 litros."
]);

// Q40 - Balsa
Question::where('id', 40)->update([
    'text' => "Uma embarcação de transporte de carga tem capacidade limitada a 15 veículos por embarque. Para completar o transporte de um lote de 100 veículos entre dois portos, determine a quantidade mínima de viagens necessárias:",
    'hint' => "Ao dividir 100 por 15, obtemos 6,66. Como não é possível realizar uma fração de viagem, 6 viagens transportariam apenas 90 veículos. Portanto, é necessária uma 7ª viagem para transportar os 10 veículos restantes."
]);

// Q32 - KM to M
Question::where('id', 32)->update([
    'text' => "Considerando as unidades de medida de comprimento do Sistema Internacional, o valor de 2,5 quilômetros (km) quando convertido para metros (m) é equivalente a:",
    'hint' => "Para converter quilômetros (km) para metros (m), multiplicamos o valor por 1.000, pois 1 km equivale a 1.000 metros. Logo: 2,5 x 1.000 = 2.500 m."
]);

echo "Questões 32, 34 e 40 do Bloco 1 atualizadas com sucesso para o padrão Premium/Náutico.\n";
