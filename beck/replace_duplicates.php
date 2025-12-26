<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Question;

// 1. Substituindo ID 263 (Bloco 2) - Era duplicata de conversão de KM
Question::where('id', 263)->update([
    'text' => 'Em uma loja de suprimentos navais, um colete salva-vidas custa R$ 120,00. No pagamento à vista, o cliente recebe um desconto de 15%. Qual o valor final a ser pago pelo colete?',
    'options' => ['R$ 100,00', 'R$ 102,00', 'R$ 105,00', 'R$ 108,00'],
    'correct_answer' => 1,
    'hint' => 'Calculamos 15% de 120 (0,15 * 120 = 18). Subtraímos o desconto do valor original: 120 - 18 = 102.'
]);

// 2. Substituindo ID 264 (Bloco 2) - Era duplicata de Volume de Cubo
Question::where('id', 264)->update([
    'text' => 'Determine a medida de um ângulo que é o triplo do seu suplemento:',
    'options' => ['45°', '90°', '135°', '150°'],
    'correct_answer' => 2,
    'hint' => 'Suplemento de x é (180 - x). A equação fica: x = 3 * (180 - x) => x = 540 - 3x => 4x = 540 => x = 135°.'
]);

// 3. Substituindo ID 261 (Bloco 2) - Era duplicata de Conjuntos (Peixe/Carne)
Question::where('id', 261)->update([
    'text' => 'Se 5 máquinas operando 6 horas por dia produzem 600 peças, quantas máquinas seriam necessárias para produzir 1.200 peças operando 8 horas por dia?',
    'options' => ['6 máquinas', '7 máquinas', '8 máquinas', '9 máquinas'],
    'correct_answer' => 1, // (5/x) = (600/1200) * (8/6) => (5/x) = (1/2) * (4/3) => 5/x = 4/6 => 4x = 30 => x = 7.5 -> Ajustando para valores inteiros
    // Vamos usar: 5 maq, 100 peças, 2h -> x maq, 300 peças, 3h
    // (5/x) = (100/300) * (3/2) => 5/x = 1/2 => x = 10
    'text' => 'Se 5 máquinas produzem 100 peças em 2 horas, quantas máquinas seriam necessárias para produzir 300 peças em 3 horas?',
    'options' => ['8 máquinas', '10 máquinas', '12 máquinas', '15 máquinas'],
    'correct_answer' => 1,
    'hint' => 'Regra de três composta: Máquinas x Peças (Direta) e Máquinas x Horas (Inversa). Montando a proporção: 5/x = (100/300) * (3/2) => 5/x = 1/3 * 3/2 => 5/x = 1/2 => x = 10 máquinas.'
]);

// 4. Substituindo ID 388 (Bloco 5) - Era duplicata de Balsa (100 carros)
Question::where('id', 388)->update([
    'text' => 'Uma embarcação percorre 180 milhas em 6 horas de navegação constante. Mantendo a mesma velocidade média, determine o tempo necessário para percorrer 450 milhas:',
    'options' => ['12 horas', '15 horas', '18 horas', '20 horas'],
    'correct_answer' => 1,
    'hint' => 'Primeiro achamos a velocidade: 180 / 6 = 30 milhas/h. Depois, dividimos a nova distância pela velocidade: 450 / 30 = 15 horas.'
]);

echo "Sucesso! 4 questões duplicadas foram substituídas por temas inéditos e contextualizados.\n";
