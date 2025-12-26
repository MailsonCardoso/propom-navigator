<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$mathUpdates = [
    21 => [
        'text' => 'Um marinheiro recebe um salário mensal de R$ 2.400,00. Sabendo que ele gasta 25% desse valor com o aluguel de sua moradia, qual o valor em reais destinado ao pagamento do aluguel?',
        'options' => ['R$ 400,00', 'R$ 500,00', 'R$ 600,00', 'R$ 700,00'],
        'correct_answer' => 2,
        'rationale' => '25% de 2400 = 0,25 * 2400 = 600.'
    ],
    22 => [
        'text' => 'Uma balsa de transporte de veículos tem capacidade para levar 15 carros por viagem. Para transportar um total de 100 veículos entre duas ilhas, quantas viagens completas, no mínimo, a balsa precisará realizar?',
        'options' => ['5 viagens', '6 viagens', '7 viagens', '8 viagens'],
        'correct_answer' => 2,
        'rationale' => '100 / 15 = 6,66... Logo, são necessárias 7 viagens para levar todos os carros.'
    ],
    23 => [
        'text' => 'Um cabo de amarração de 120 metros de comprimento deve ser cortado em 5 pedaços de tamanhos iguais. Qual será o comprimento de cada pedaço após o corte?',
        'options' => ['20 metros', '24 metros', '25 metros', '30 metros'],
        'correct_answer' => 1,
        'rationale' => '120 / 5 = 24 metros.'
    ],
    24 => [
        'text' => 'O convés principal de uma embarcação tem formato retangular com 15 metros de comprimento por 6 metros de largura. Qual é a área total disponível para circulação nesse convés?',
        'options' => ['80 m²', '90 m²', '100 m²', '110 m²'],
        'correct_answer' => 1,
        'rationale' => 'Área = Comprimento * Largura = 15 * 6 = 90 m².'
    ],
    25 => [
        'text' => 'Um tanque de combustível de um rebocador está com 3/4 de sua capacidade total preenchida. Se a capacidade total do tanque é de 8.000 litros, quantos litros de combustível há no tanque no momento?',
        'options' => ['4.000 litros', '5.000 litros', '6.000 litros', '7.000 litros'],
        'correct_answer' => 2,
        'rationale' => '3/4 de 8000 = (8000 / 4) * 3 = 2000 * 3 = 6000 litros.'
    ],
    26 => [
        'text' => 'Um navio tanque carrega 500 toneladas de carga. Se 2/5 dessa carga forem descarregados no primeiro porto, quantas toneladas de carga restariam no navio?',
        'options' => ['200 toneladas', '250 toneladas', '300 toneladas', '350 toneladas'],
        'correct_answer' => 2,
        'rationale' => 'Descarregado: 2/5 de 500 = 200. Resta: 500 - 200 = 300 toneladas.'
    ],
    27 => [
        'text' => 'Um marinheiro gasta 2 horas para pintar 10 metros quadrados de uma antepara. Mantendo esse mesmo ritmo, quantas horas ele levará para pintar uma área de 50 metros quadrados?',
        'options' => ['8 horas', '10 horas', '12 horas', '15 horas'],
        'correct_answer' => 1,
        'rationale' => 'Regra de três simples: 10m² - 2h | 50m² - x. x = (50*2)/10 = 10 horas.'
    ],
    28 => [
        'text' => 'Uma lancha consome 12 litros de combustível por hora de navegação. Se o proprietário abasteceu a lancha com 60 litros, por quantas horas ele poderá navegar até o combustível acabar?',
        'options' => ['4 horas', '5 horas', '6 horas', '7 horas'],
        'correct_answer' => 1,
        'rationale' => '60 / 12 = 5 horas.'
    ],
    29 => [
        'text' => 'O preço de uma boia de salvatagem que custava R$ 120,00 sofreu um aumento de 15%. Qual o novo valor da boia após esse reajuste?',
        'options' => ['R$ 132,00', 'R$ 135,00', 'R$ 138,00', 'R$ 140,00'],
        'correct_answer' => 2,
        'rationale' => 'Aumento: 15% de 120 = 18. Novo valor: 120 + 18 = 138.'
    ],
    30 => [
        'text' => 'Em uma tripulação de 40 pessoas, verificou-se que 60% são marinheiros de convés e o restante são de máquinas. Quantas pessoas da tripulação trabalham na seção de máquinas?',
        'options' => ['12 pessoas', '14 pessoas', '16 pessoas', '18 pessoas'],
        'correct_answer' => 2,
        'rationale' => 'Máquinas = 40% (100% - 60%). 40% de 40 = 0,4 * 40 = 16.'
    ],
    // Seguindo para as IDs 132 a 141 (padrão do Bloco 1 de Matemática)
    132 => [
        'text' => 'Qual o valor da incógnita "x" que satisfaz a igualdade na equação do primeiro grau: x/4 + 2 = 10?',
        'options' => ['x = 28', 'x = 30', 'x = 32', 'x = 36'],
        'correct_answer' => 2,
        'rationale' => 'x/4 = 10 - 2 => x/4 = 8 => x = 8 * 4 = 32.'
    ],
    133 => [
        'text' => 'Na geometria plana, um ângulo que mede exatamente 45° é classificado como um:',
        'options' => ['Ângulo Reto', 'Ângulo Obtuso', 'Ângulo Raso', 'Ângulo Agudo'],
        'correct_answer' => 3,
        'rationale' => 'Ângulos menores que 90° são classificados como agudos.'
    ],
    134 => [
        'text' => 'Se um triângulo possui base medindo 10 cm e altura medindo 8 cm, qual será a sua área total?',
        'options' => ['30 cm²', '40 cm²', '50 cm²', '80 cm²'],
        'correct_answer' => 1,
        'rationale' => 'Área = (Base * Altura) / 2 = (10 * 8) / 2 = 40 cm².'
    ],
    135 => [
        'text' => 'Um reservatório de água em formato de cubo possui aresta medindo 2 metros. Qual o volume total de água que esse reservatório pode comportar?',
        'options' => ['4 m³', '6 m³', '8 m³', '10 m³'],
        'correct_answer' => 2,
        'rationale' => 'Volume do cubo = aresta³ = 2³ = 8 m³.'
    ],
    136 => [
        'text' => 'Um produto que custava R$ 200,00 foi vendido com um desconto de 20%. Qual foi o valor final pago pelo produto?',
        'options' => ['R$ 150,00', 'R$ 160,00', 'R$ 170,00', 'R$ 180,00'],
        'correct_answer' => 1,
        'rationale' => 'Desconto: 20% de 200 = 40. Valor final: 200 - 40 = 160.'
    ],
    137 => [
        'text' => 'A raiz quadrada do número 144 é igual a:',
        'options' => ['10', '11', '12', '14'],
        'correct_answer' => 2,
        'rationale' => '12 * 12 = 144.'
    ],
    138 => [
        'text' => 'Em uma progressão aritmética (PA) onde o primeiro termo (a1) é 5 e a razão (r) é 3, qual será o quinto termo (a5)?',
        'options' => ['14', '17', '20', '23'],
        'correct_answer' => 1,
        'rationale' => 'a5 = a1 + (5-1)*r = 5 + 4*3 = 5 + 12 = 17.'
    ],
    139 => [
        'text' => 'Qual é o valor numérico da expressão matemática (10 + 5) * 2 - 8?',
        'options' => ['12', '18', '22', '25'],
        'correct_answer' => 2,
        'rationale' => '15 * 2 - 8 = 30 - 8 = 22.'
    ],
    140 => [
        'text' => 'Um círculo possui raio medindo 5 cm. Considerando π = 3,14, qual seria o comprimento aproximado da circunferência?',
        'options' => ['15,7 cm', '31,4 cm', '47,1 cm', '62,8 cm'],
        'correct_answer' => 1,
        'rationale' => 'C = 2 * π * r = 2 * 3,14 * 5 = 31,4 cm.'
    ],
    141 => [
        'text' => 'Se uma impressora consegue imprimir 60 páginas em 15 minutos, quantas páginas ela imprimirá em 1 hora?',
        'options' => ['120 páginas', '180 páginas', '240 páginas', '300 páginas'],
        'correct_answer' => 2,
        'rationale' => '60 páginas - 15 min | x - 60 min. x = (60 * 60) / 15 = 240 páginas.'
    ]
];

foreach ($mathUpdates as $id => $data) {
    $q = Question::find($id);
    if ($q) {
        $q->text = $data['text'];
        $q->options = $data['options'];
        $q->correct_answer = $data['correct_answer'];
        $q->rationale = $data['rationale'];
        $q->save();
        echo "Question ID {$id} (Math Block 1) professionalized.\n";
    }
}
echo "Math professionalization finished.\n";
