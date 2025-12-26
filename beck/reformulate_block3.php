<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

// Limpar o Bloco 3 para recomeçar
Question::where('block', 3)->delete();

$baseText = "A Travessia Noturna\n\nO rebocador cortava as águas calmas da baía sob um céu sem estrelas. O mestre, um homem de poucas palavras, mantinha os olhos fixos no radar. Sabia que a neblina era traiçoeira e que qualquer descuido no canal poderia causar uma colisão desastrosa.\n— Café, mestre? — perguntou o marinheiro de convés, estendendo uma caneca fumegante.\nEle recusou com um gesto. Naquele momento, o rádio chiou, trazendo uma mensagem cifrada da capitania. O mestre sentiu um aperto no peito; não era apenas o clima que estava pesado naquela noite, era a responsabilidade de conduzir a carga preciosa até o porto seguro. O silêncio só era quebrado pelo motor rítmico, que parecia pulsar como um coração de ferro.";

$portugueseQuestions = [
    [
        'text' => 'No trecho "O mestre, um homem de poucas palavras...", a vírgula foi utilizada para isolar um:',
        'options' => ['Vocativo.', 'Adjunto adverbial deslocado.', 'Aposto explicativo.', 'Sujeito composto.'],
        'correct_answer' => 2,
        'rationale' => 'O termo isolado explica quem é o mestre, tratando-se de um aposto explicativo.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Na frase "Sabia que a neblina era traiçoeira...", a palavra em destaque (traiçoeira) exerce a função sintática de:',
        'options' => ['Objeto direto.', 'Predicativo do sujeito.', 'Adjunto adnominal.', 'Núcleo do sujeito.'],
        'correct_answer' => 1,
        'rationale' => 'Atribui uma característica ao sujeito "neblina" através do verbo de ligação "era".',
        'base_text' => $baseText
    ],
    [
        'text' => 'Assinale a alternativa em que a palavra retirada do texto é acentuada pela regra das proparoxítonas:',
        'options' => ['Baía.', 'Rítmico.', 'Cifrada.', 'Estrelas.'],
        'correct_answer' => 1,
        'rationale' => 'Todas as proparoxítonas são acentuadas. Rít-mi-co tem a antepenúltima sílaba tônica.',
        'base_text' => $baseText
    ],
    [
        'text' => 'O termo "Café, mestre?" classifica-se morfologicamente como um substantivo e sintaticamente como:',
        'options' => ['Sujeito.', 'Aposto.', 'Vocativo.', 'Objeto indireto.'],
        'correct_answer' => 2,
        'rationale' => 'Mestre é um chamamento, portanto, um vocativo.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Em "O silêncio só era quebrado pelo motor...", a palavra "só" indica uma ideia de:',
        'options' => ['Solidão.', 'Exclusividade (apenas).', 'Modo.', 'Intensidade.'],
        'correct_answer' => 1,
        'rationale' => 'No contexto, "só" pode ser substituído por "apenas", indicando exclusividade.',
        'base_text' => $baseText
    ],
    [
        'text' => 'No início do texto, o pretérito imperfeito "cortava" indica uma ação no passado que era:',
        'options' => ['Pontual e concluída.', 'Habitual ou contínua no momento da narração.', 'Posterior a outra ação passada.', 'Incerta e hipotética.'],
        'correct_answer' => 1,
        'rationale' => 'O pretérito imperfeito indica uma ação que se prolongava no tempo ou era habitual no passado.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Qual o antônimo da palavra "traiçoeira" conforme o contexto do texto?',
        'options' => ['Perigosa.', 'Confiável.', 'Furtiva.', 'Turva.'],
        'correct_answer' => 1,
        'rationale' => 'Alguém ou algo traiçoeiro não é digno de confiança; seu oposto é confiável.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Na oração "O mestre sentiu um aperto no peito", o sujeito é:',
        'options' => ['Composto e explícito.', 'Simples e anteposto.', 'Oculto.', 'Inexistente.'],
        'correct_answer' => 1,
        'rationale' => 'O sujeito "O mestre" possui apenas um núcleo e está posicionado antes do verbo.',
        'base_text' => $baseText
    ],
    [
        'text' => 'A palavra "neblina" é classificada como:',
        'options' => ['Oxítona.', 'Paroxítona.', 'Proparoxítona.', 'Monossílabo tônico.'],
        'correct_answer' => 1,
        'rationale' => 'A sílaba tônica é a penúltima (ne-BLI-na).',
        'base_text' => $baseText
    ],
    [
        'text' => 'Em "...conduzir a carga preciosa até o porto seguro", a palavra destacada (até) é uma:',
        'options' => ['Conjunção integrante.', 'Preposição.', 'Interjeição.', 'Adjetivo.'],
        'correct_answer' => 1,
        'rationale' => '"Até" estabelece uma relação de limite/lugar, funcionando como preposição.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Marque a opção em que a concordância verbal está incorreta:',
        'options' => ['Sobrou dois pães na cesta.', 'Faz dez dias que o navio partiu.', 'Alugam-se embarcações de lazer.', 'Nós fomos os primeiros a chegar.'],
        'correct_answer' => 0,
        'rationale' => 'O correto é "Sobraram dois pães", pois o verbo deve concordar com o sujeito plural.',
    ],
    [
        'text' => 'A palavra "balaústre" recebe acento pela regra do:',
        'options' => ['Monossílabo tônico.', 'Hiato tônico (i ou u sozinhos na sílaba).', 'Ditongo crescente.', 'Oxítona terminada em \'e\'.'],
        'correct_answer' => 1,
        'rationale' => 'Acentuam-se o I e U tônicos que formam hiato com a vogal anterior.',
    ],
    [
        'text' => 'O coletivo de "mapas" é:',
        'options' => ['Pinacoteca.', 'Atlas.', 'Cancioneiro.', 'Panóplia.'],
        'correct_answer' => 1,
        'rationale' => 'Atlas é o nome dado ao conjunto de mapas geográficos.',
    ],
    [
        'text' => 'Qual verbo abaixo é considerado defectivo (não possui todas as conjugações)?',
        'options' => ['Cantar.', 'Partir.', 'Colorir.', 'Beber.'],
        'correct_answer' => 2,
        'rationale' => 'Colorir é um verbo defectivo, pois não possui a 1ª pessoa do presente do indicativo.',
    ],
    [
        'text' => 'Assinale a alternativa que contém um erro de ortografia:',
        'options' => ['Exceção.', 'Analisar.', 'Enchergar.', 'Ascensão.'],
        'correct_answer' => 2,
        'rationale' => 'A grafia correta é "Enxergar" (com X).',
    ],
    [
        'text' => 'Na frase "Ele subiu às sete horas", o uso do acento grave (crase) justifica-se por:',
        'options' => ['Indicação de horas exatas.', 'Locução adverbial feminina de modo.', 'Antes de pronome possessivo.', 'Substituição por "ao".'],
        'correct_answer' => 0,
        'rationale' => 'Usa-se crase na indicação de horas exatas.',
    ],
    [
        'text' => 'O plural de "cidadão" é:',
        'options' => ['Cidadões.', 'Cidadães.', 'Cidadãos.', 'Cidadãozes.'],
        'correct_answer' => 2,
        'rationale' => 'O plural correto de cidadão é cidadãos.',
    ],
    [
        'text' => 'Em "O marinheiro é fortíssimo", o adjetivo está no grau:',
        'options' => ['Comparativo de superioridade.', 'Superlativo absoluto analítico.', 'Superlativo absoluto sintético.', 'Superlativo relativo de superioridade.'],
        'correct_answer' => 2,
        'rationale' => 'O sufixo -íssimo indica o grau superlativo absoluto sintético.',
    ],
    [
        'text' => 'Identifique a figura de linguagem em: "O navio gemia com o esforço das ondas":',
        'options' => ['Metáfora.', 'Personificação (Prosopopeia).', 'Hipérbole.', 'Eufemismo.'],
        'correct_answer' => 1,
        'rationale' => 'Atribui-se uma ação humana (gemer) a um objeto inanimado (navio).',
    ],
    [
        'text' => 'Qual o sinônimo da palavra "fortuita"?',
        'options' => ['Planejada.', 'Casual.', 'Longa.', 'Triste.'],
        'correct_answer' => 1,
        'rationale' => 'Algo fortuito é algo que acontece por acaso, casualmente.',
    ]
];

$mathQuestions = [
    [
        'text' => 'Um reservatório de água de um navio tem capacidade de 15 m³. Sabendo que 1 m³ = 1000 litros, quantos litros de água cabem no reservatório?',
        'options' => ['1.500 L', '15.000 L', '150.000 L', '150 L'],
        'correct_answer' => 1,
        'rationale' => '15 * 1000 = 15.000 litros.'
    ],
    [
        'text' => 'Se 8 marinheiros pintam um casco em 12 dias, quantos marinheiros seriam necessários para realizar o mesmo trabalho em apenas 6 dias?',
        'options' => ['4', '10', '16', '20'],
        'correct_answer' => 2,
        'rationale' => 'Regra de 3 simples inversamente proporcional: 8 * 12 = x * 6 => 96 = 6x => x = 16.'
    ],
    [
        'text' => 'Qual o valor da expressão numérica: 50 - (2 x 5 + 10) / 4?',
        'options' => ['45', '40', '35', '10'],
        'correct_answer' => 0,
        'rationale' => '50 - (10 + 10) / 4 = 50 - 20/4 = 50 - 5 = 45.'
    ],
    [
        'text' => 'Um ângulo mede 120°. Qual é o valor do seu suplemento?',
        'options' => ['30°', '60°', '90°', '180°'],
        'correct_answer' => 1,
        'rationale' => 'Ângulos suplementares somam 180°. 180 - 120 = 60°.'
    ],
    [
        'text' => 'O perímetro de um terreno retangular é de 60 metros. Se a largura mede 10 metros, quanto mede o comprimento?',
        'options' => ['10 m', '20 m', '30 m', '40 m'],
        'correct_answer' => 1,
        'rationale' => 'Perímetro = 2*(L + C) => 60 = 2*(10 + C) => 30 = 10 + C => C = 20.'
    ],
    [
        'text' => 'Qual o MMC (Mínimo Múltiplo Comum) entre os números 12 e 18?',
        'options' => ['6', '24', '36', '72'],
        'correct_answer' => 2,
        'rationale' => 'Múltiplos de 12: 12, 24, 36... Múltiplos de 18: 18, 36... Menor comum é 36.'
    ],
    [
        'text' => 'Em uma promoção, um colete salva-vidas que custava R$ 200,00 teve um desconto de 15%. Qual o novo preço?',
        'options' => ['R$ 170,00', 'R$ 185,00', 'R$ 30,00', 'R$ 150,00'],
        'correct_answer' => 0,
        'rationale' => '15% de 200 = 30. Novo preço: 200 - 30 = 170.'
    ],
    [
        'text' => 'Resolva a equação de 1º grau: 3x - 15 = 45. O valor de x é:',
        'options' => ['10', '20', '30', '60'],
        'correct_answer' => 1,
        'rationale' => '3x = 45 + 15 => 3x = 60 => x = 20.'
    ],
    [
        'text' => 'A soma dos ângulos internos de um triângulo é sempre:',
        'options' => ['90°', '180°', '360°', '270°'],
        'correct_answer' => 1,
        'rationale' => 'A soma dos ângulos internos de qualquer triângulo é sempre 180°.'
    ],
    [
        'text' => 'Um marinheiro percorre 120 km em 2 horas. Qual a sua velocidade média?',
        'options' => ['60 km/h', '70 km/h', '80 km/h', '50 km/h'],
        'correct_answer' => 0,
        'rationale' => 'V = D / T = 120 / 2 = 60 km/h.'
    ],
    [
        'text' => 'Qual o MDC (Máximo Divisor Comum) entre 20 e 30?',
        'options' => ['5', '10', '15', '20'],
        'correct_answer' => 1,
        'rationale' => 'Divisores de 20: 1, 2, 4, 5, 10, 20. Divisores de 30: 1, 2, 3, 5, 6, 10, 15, 30. Maior comum é 10.'
    ],
    [
        'text' => 'Transforme a fração 3/4 em número decimal:',
        'options' => ['0,34', '0,75', '0,50', '0,80'],
        'correct_answer' => 1,
        'rationale' => '3 dividido por 4 é igual a 0,75.'
    ],
    [
        'text' => 'Um triângulo retângulo possui catetos medindo 6 cm e 8 cm. Qual a medida da hipotenusa?',
        'options' => ['10 cm', '12 cm', '14 cm', '20 cm'],
        'correct_answer' => 0,
        'rationale' => 'h² = 6² + 8² = 36 + 64 = 100 => h = 10.'
    ],
    [
        'text' => 'Em uma urna há 40 bolas, sendo 10 vermelhas. Qual a probabilidade de retirar uma bola vermelha?',
        'options' => ['10%', '25%', '40%', '50%'],
        'correct_answer' => 1,
        'rationale' => 'Probabilidade = 10 / 40 = 1 / 4 = 25%.'
    ],
    [
        'text' => 'Se uma balsa leva 20 carros por viagem, quantas viagens são necessárias para 150 carros?',
        'options' => ['7', '7,5', '8', '9'],
        'correct_answer' => 2,
        'rationale' => '150 / 20 = 7,5. Como não existe meia viagem, são necessárias 8 viagens.'
    ],
    [
        'text' => 'O resultado de 2³ + 5² é:',
        'options' => ['11', '31', '33', '26'],
        'correct_answer' => 2,
        'rationale' => '2³ = 8. 5² = 25. 8 + 25 = 33.'
    ],
    [
        'text' => 'Um pátio circular tem raio de 5 metros. Qual o seu diâmetro?',
        'options' => ['5 m', '10 m', '15 m', '25 m'],
        'correct_answer' => 1,
        'rationale' => 'Diâmetro = 2 * Raio = 2 * 5 = 10 metros.'
    ],
    [
        'text' => 'O dobro de um número somado com seu triplo é igual a 100. Que número é este?',
        'options' => ['10', '20', '25', '50'],
        'correct_answer' => 1,
        'rationale' => '2x + 3x = 100 => 5x = 100 => x = 20.'
    ],
    [
        'text' => 'Qual a área de um triângulo de base 10 cm e altura 8 cm?',
        'options' => ['80 cm²', '40 cm²', '18 cm²', '20 cm²'],
        'correct_answer' => 1,
        'rationale' => 'Área = (Base * Altura) / 2 = (10 * 8) / 2 = 80 / 2 = 40.'
    ],
    [
        'text' => 'Um relógio marca 15h 30min. Quantos minutos faltam para as 17h?',
        'options' => ['60 min', '90 min', '120 min', '150 min'],
        'correct_answer' => 1,
        'rationale' => 'Das 15:30 às 16:30 é 60min. Das 16:30 às 17:00 é 30min. Total = 90 minutos.'
    ]
];

foreach ($portugueseQuestions as $q) {
    Question::create(array_merge($q, ['block' => 3, 'subject' => 'portugues']));
}

foreach ($mathQuestions as $q) {
    Question::create(array_merge($q, ['block' => 3, 'subject' => 'matematica']));
}

echo "Bloco 3 reformulado com sucesso!\n";
