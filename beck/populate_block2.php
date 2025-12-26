<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

// 1. Atualizar as 10 existentes do Bloco 2 para o padrão profissional
$existingUpdates = [
    41 => [
        'text' => 'Durante as manobras de entrada no porto, o oficial de náutica emite um "sinal sonoro" para indicar suas intenções. Qual é a forma correta do plural dessa expressão?',
        'options' => ['Sinais sonoroses', 'Sinais sonoro', 'Sinais sonoros', 'Sinal sonoros'],
        'correct_answer' => 2,
    ],
    42 => [
        'text' => 'Em um relatório de ocorrências marítimas, um marinheiro descreveu o mar como estando em total "calmaria". Assinale a alternativa que apresenta o antônimo adequado para a palavra em destaque:',
        'options' => ['Bonança', 'Serenidade', 'Tempestade', 'Tranquilidade'],
        'correct_answer' => 2,
    ],
    43 => [
        'text' => 'A palavra "marujo" é muito utilizada no jargão náutico. Quanto à sua formação, ela é classificada como uma palavra:',
        'options' => ['Primitiva', 'Derivada', 'Composta por aglutinação', 'Composta por justaposição'],
        'correct_answer' => 1,
    ],
    44 => [
        'text' => 'Na hierarquia de bordo, quando nos referimos a uma mulher que detém o título de mestre, o feminino coreto de "mestre" é:',
        'options' => ['Mestra', 'Mestresa', 'Mestria', 'Mestrina'],
        'correct_answer' => 0,
    ],
    45 => [
        'text' => 'Assinale a alternativa onde a acentuação gráfica foi aplicada corretamente em um termo técnico marítimo:',
        'options' => ['Bóia', 'Navio', 'Convéis', 'Âncora'],
        'correct_answer' => 3,
    ],
    46 => [
        'text' => 'Um navio percorre uma distância de 120 milhas náuticas em exatamente 4 horas. Qual é a sua velocidade média em nós (milhas por hora)?',
        'options' => ['25 nós', '30 nós', '35 nós', '40 nós'],
        'correct_answer' => 1,
        'rationale' => 'V = D / T = 120 / 4 = 30 nós.'
    ],
    47 => [
        'text' => 'Um lote de 200 coletes salva-vidas foi inspecionado, e verificou-se que 15% deles precisavam de manutenção nas fitas refletivas. Quantos coletes apresentaram defeito?',
        'options' => ['20 coletes', '25 coletes', '30 coletes', '35 coletes'],
        'correct_answer' => 2,
        'rationale' => '15% de 200 = 0,15 * 200 = 30.'
    ],
    48 => [
        'text' => 'Para realizar uma pintura em um anteparo, um marinheiro misturou 0,5 litros de tinta azul com 0,25 litros de tinta branca. Qual o volume total da mistura obtida?',
        'options' => ['0,65 litros', '0,75 litros', '0,80 litros', '0,85 litros'],
        'correct_answer' => 1,
        'rationale' => '0,5 + 0,25 = 0,75.'
    ],
    49 => [
        'text' => 'O piso de uma balsa quadrada tem área total de 144 metros quadrados. Qual é a medida de cada lado dessa balsa?',
        'options' => ['10 metros', '12 metros', '14 metros', '16 metros'],
        'correct_answer' => 1,
        'rationale' => 'Lado = raiz quadrada de 144 = 12.'
    ],
    50 => [
        'text' => 'Em uma faina de peação, um marinheiro utilizou o dobro de 15 metros de cabo, somados a mais 10 metros extras de reserva. Qual o comprimento total de cabo utilizado?',
        'options' => ['30 metros', '35 metros', '40 metros', '45 metros'],
        'correct_answer' => 2,
        'rationale' => '(15 * 2) + 10 = 30 + 10 = 40.'
    ]
];

foreach ($existingUpdates as $id => $data) {
    $q = Question::find($id);
    if ($q) {
        $q->update($data);
    }
}

// 2. Adicionar 15 novas de Português para o Bloco 2
$newPort = [
    ['text' => 'Assinale a opção em que a concordância verbal está correta:', 'options' => ['Fazem dez dias que o navio partiu.', 'Faz dez dias que o navio partiu.', 'Deveriam haver mais botes na embarcação.', 'Haviam muitos marinheiros no cais.'], 'correct_answer' => 1],
    ['text' => 'No trecho "O capitão agiu com cautela", a palavra sublinhada indica:', 'options' => ['Lugar', 'Tempo', 'Modo', 'Causa'], 'correct_answer' => 2],
    ['text' => 'Qual o sinônimo da palavra "proa" (parte frontal de um navio)?', 'options' => ['Popa', 'Bombordo', 'Frente', 'Lantejoula'], 'correct_answer' => 2],
    ['text' => 'Identifique a frase escrita na voz passiva:', 'options' => ['O marinheiro limpou o convés.', 'Limpou-se o convés.', 'O convés foi limpo pelo marinheiro.', 'O sol brilhava no mar.'], 'correct_answer' => 2],
    ['text' => 'Assinale o uso correto da crase:', 'options' => ['O marinheiro voltou à bordo.', 'Chegamos à ilha ao amanhecer.', 'O navio seguiu à toda velocidade.', 'Demos comida à ele.'], 'correct_answer' => 1],
    ['text' => '"A embarcação singrava o oceano." O verbo "singrar" significa:', 'options' => ['Afundar', 'Navegar', 'Flutuar', 'Parar'], 'correct_answer' => 1],
    ['text' => 'Qual o plural de "capitão-tenente"?', 'options' => ['Capitães-tenentes', 'Capitão-tenentes', 'Capitães-tenente', 'Capitã-tenentes'], 'correct_answer' => 0],
    ['text' => 'Indique a palavra grafada incorretamente:', 'options' => ['Âncora', 'Bússola', 'Excurção', 'Escotilha'], 'correct_answer' => 2],
    ['text' => 'O coletivo de "navios de guerra" é:', 'options' => ['Frota', 'Esquadra', 'Comboio', 'Arquipélago'], 'correct_answer' => 1],
    ['text' => 'Na frase "O mar é imenso", o sujeito é:', 'options' => ['Simples', 'Composto', 'Oculto', 'Inexistente'], 'correct_answer' => 0],
    ['text' => 'Assinale a oração que contém um advérbio de tempo:', 'options' => ['O navio chegou ontem.', 'O mar está calmo.', 'Navegamos muito.', 'Estamos aqui.'], 'correct_answer' => 0],
    ['text' => 'Qual a forma correta do aumentativo de "navio"?', 'options' => ['Naviozão', 'Naviarra', 'Navio grande', 'Naviozudo'], 'correct_answer' => 1],
    ['text' => 'Identifique o pronome possessivo na frase: "Nossa viagem foi tranquila."', 'options' => ['Nossa', 'Viagem', 'Foi', 'Tranquila'], 'correct_answer' => 0],
    ['text' => 'O antônimo de "emergir" é:', 'options' => ['Submergir', 'Surgir', 'Aparecer', 'Levantar'], 'correct_answer' => 0],
    ['text' => 'Qual a função da vírgula em: "Marinheiro, suba ao mastro!"?', 'options' => ['Separar aposto', 'Indicar vocativo', 'Enumeração', 'Enfatizar o verbo'], 'correct_answer' => 1],
];

foreach ($newPort as $q) {
    Question::create(array_merge($q, ['block' => 2, 'subject' => 'portugues']));
}

// 3. Adicionar 15 novas de Matemática para o Bloco 2
$newMat = [
    ['text' => 'Se um marinheiro conserta 3 redes de pesca em 45 minutos, quantos minutos ele levará para consertar 10 redes no mesmo ritmo?', 'options' => ['120 min', '150 min', '180 min', '200 min'], 'correct_answer' => 1, 'rationale' => '3 redes - 45 min => 1 rede = 15 min. 10 redes = 150 min.'],
    ['text' => 'Um reservatório de água doce de um navio tem capacidade para 5.000 litros. Se foram utilizados 3/5 da água, quantos litros ainda restam?', 'options' => ['1.500 litros', '2.000 litros', '2.500 litros', '3.000 litros'], 'correct_answer' => 1, 'rationale' => '3/5 de 5000 = 3000 litros usados. Restam 5000 - 3000 = 2000 litros.'],
    ['text' => 'Qual o valor de 2² + 3³ - 10?', 'options' => ['15', '21', '25', '31'], 'correct_answer' => 1, 'rationale' => '4 + 27 - 10 = 21.'],
    ['text' => 'Um cabo de aço custa R$ 15,00 o metro. Quanto custará um rolo com 40 metros desse cabo?', 'options' => ['R$ 500,00', 'R$ 550,00', 'R$ 600,00', 'R$ 650,00'], 'correct_answer' => 2, 'rationale' => '15 * 40 = 600.'],
    ['text' => 'Se um ângulo interno de um triângulo mede 60° e o outro mede 50°, qual a medida do terceiro ângulo?', 'options' => ['60°', '70°', '80°', '90°'], 'correct_answer' => 1, 'rationale' => '180 - (60 + 50) = 70.'],
    ['text' => 'Uma bomba de recalque transfere 80 litros de água por minuto. Quantos litros ela transferirá em meia hora?', 'options' => ['2.000 litros', '2.200 litros', '2.400 litros', '2.600 litros'], 'correct_answer' => 2, 'rationale' => '80 * 30 = 2400.'],
    ['text' => 'Qual é o quíntuplo de 25?', 'options' => ['100', '115', '125', '150'], 'correct_answer' => 2, 'rationale' => '25 * 5 = 125.'],
    ['text' => 'Um navio saiu às 08:30 e chegou ao destino às 14:15. Quanto tempo durou a viagem?', 'options' => ['5h 15min', '5h 45min', '6h 15min', '6h 45min'], 'correct_answer' => 1, 'rationale' => 'Das 08:30 às 14:30 seriam 6h. Como chegou 15min antes, 5h 45min.'],
    ['text' => 'Dividindo 1.200 por 15, o resultado é:', 'options' => ['70', '80', '90', '100'], 'correct_answer' => 1, 'rationale' => '1200 / 15 = 80.'],
    ['text' => 'Uma tripulação de 12 marinheiros tem mantimentos para 20 dias. Se a tripulação for reduzida para 8 marinheiros, os mantimentos durarão quantos dias?', 'options' => ['25 dias', '30 dias', '35 dias', '40 dias'], 'correct_answer' => 1, 'rationale' => 'Regra de 3 inversamente proporcional: 12*20 = 8*x => 240 = 8x => x = 30.'],
    ['text' => 'Qual o valor de "y" na equação: 2y - 10 = 30?', 'options' => ['10', '15', '20', '25'], 'correct_answer' => 2, 'rationale' => '2y = 40 => y = 20.'],
    ['text' => 'Um convés retangular mede 20m de comprimento por 4m de largura. Qual o seu perímetro?', 'options' => ['24m', '40m', '48m', '80m'], 'correct_answer' => 2, 'rationale' => '2 * (20 + 4) = 48.'],
    ['text' => 'Se 1 kg de graxa lubrificante custa R$ 45,00, quanto custarão 250 gramas?', 'options' => ['R$ 10,25', 'R$ 11,25', 'R$ 12,50', 'R$ 15,00'], 'correct_answer' => 1, 'rationale' => '45 / 4 = 11,25.'],
    ['text' => 'Simplificando a fração 12/16, obtemos:', 'options' => ['3/4', '2/3', '4/5', '1/2'], 'correct_answer' => 0, 'rationale' => 'Dividindo ambos por 4: 12/4=3 e 16/4=4.'],
    ['text' => 'A soma de três números consecutivos é 45. Qual o maior deles?', 'options' => ['14', '15', '16', '17'], 'correct_answer' => 2, 'rationale' => 'x + x+1 + x+2 = 45 => 3x + 3 = 45 => 3x = 42 => x = 14. O maior é 14+2 = 16.'],
];

foreach ($newMat as $q) {
    Question::create(array_merge($q, ['block' => 2, 'subject' => 'matematica']));
}

echo "Bloco 2 completado com 40 questões profissionais e marítimas.\n";
