<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

// Limpar o Bloco 5 para recomeçar
Question::where('block', 5)->delete();

$baseText = "A Lição do Mestre\n\nO professor entrou na sala em silêncio. Sobre a mesa, colocou apenas um pote de vidro vazio e algumas pedras grandes. Os alunos observavam, curiosos, enquanto ele preenchia o recipiente com as pedras até a borda.\n— Está cheio? — perguntou ele. Todos disseram que sim.\nEntão, ele pegou um saco de pedregulhos menores e os despejou no pote. Eles se acomodaram nos espaços entre as pedras grandes. Ele repetiu a pergunta e os alunos, rindo, confirmaram novamente. Por fim, o mestre derramou areia, que preencheu cada fresta restante.\n— A vida é como este pote — explicou. — Se vocês colocarem a areia primeiro, não haverá espaço para as pedras grandes, que são as coisas que realmente importam. Saibam priorizar o que é essencial, antes que o tempo se esgote.";

$portugueseQuestions = [
    [
        'text' => 'Na frase "O professor entrou na sala em silêncio", o termo destacado ("em silêncio") classifica-se como:',
        'options' => ['Locução adverbial de modo.', 'Locução adjetiva.', 'Objeto direto.', 'Adjunto adverbial de lugar.'],
        'correct_answer' => 0,
        'rationale' => '"Em silêncio" indica o modo como o professor entrou na sala.',
        'base_text' => $baseText
    ],
    [
        'text' => 'No trecho "Os alunos observavam, curiosos...", a palavra destacada é um:',
        'options' => ['Advérbio de intensidade.', 'Predicativo do sujeito (estado dos alunos).', 'Substantivo abstrato.', 'Adjunto adverbial de tempo.'],
        'correct_answer' => 1,
        'rationale' => '"Curiosos" atribui um estado/característica passageira aos alunos no momento da ação.',
        'base_text' => $baseText
    ],
    [
        'text' => 'A palavra "recipiente" é acentuada?',
        'options' => ['Sim, por ser proparoxítona.', 'Não, pois é uma paroxítona terminada em "e".', 'Sim, por ser uma oxítona.', 'Não, pois é um monossílabo.'],
        'correct_answer' => 1,
        'rationale' => 'Paroxítonas terminadas em "e" (como recipiente, parede, rede) não recebem acento.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Em "— Está cheio? — perguntou ele", o verbo (perguntou) está no:',
        'options' => ['Pretérito Imperfeito (ação habitual).', 'Pretérito Perfeito (ação concluída).', 'Futuro do Presente.', 'Presente do Indicativo.'],
        'correct_answer' => 1,
        'rationale' => 'Indica uma ação pontual e finalizada no passado.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Qual o antônimo da palavra "essencial"?',
        'options' => ['Fundamental.', 'Primordial.', 'Supérfluo.', 'Vital.'],
        'correct_answer' => 2,
        'rationale' => 'Essencial é o que é necessário; supérfluo é o que é desnecessário ou dispensável.',
        'base_text' => $baseText
    ],
    [
        'text' => 'No trecho "...não haverá espaço para as pedras grandes", o verbo destacado (haverá) pode ser substituído, sem perder o sentido, por:',
        'options' => ['Existirá.', 'Terão.', 'Fazia.', 'Aconteceriam.'],
        'correct_answer' => 0,
        'rationale' => 'O verbo "haver" no sentido de existir é impessoal e pode ser substituído por "existir".',
        'base_text' => $baseText
    ],
    [
        'text' => 'A palavra "pedregulhos" é formada pelo processo de:',
        'options' => ['Prefixação.', 'Sufixação (pedra + ucho/ulho).', 'Composição por aglutinação.', 'Parassíntese.'],
        'correct_answer' => 1,
        'rationale' => 'Derivação sufixal através do acréscimo do sufixo "-ulho" ao radical.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Em "Todos disseram que sim", a palavra destacada (sim) é um advérbio de:',
        'options' => ['Dúvida.', 'Afirmação.', 'Negação.', 'Intensidade.'],
        'correct_answer' => 1,
        'rationale' => 'A palavra "sim" expressa uma concordância ou confirmação positiva.',
        'base_text' => $baseText
    ],
    [
        'text' => 'O plural de "vazio" e "pote" é, respetivamente:',
        'options' => ['Vazios e potes.', 'Vazios e potões.', 'Vaziões e potes.', 'Vazis e potis.'],
        'correct_answer' => 0,
        'rationale' => 'Plurais regulares terminados em S.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Qual a função das aspas em "A vida é como este pote"?',
        'options' => ['Indicar uma gíria.', 'Marcar o início da fala do personagem.', 'Destacar um erro ortográfico.', 'Indicar uma citação ou pensamento.'],
        'correct_answer' => 1,
        'rationale' => 'As aspas (ou o travessão no texto original) indicam que aquele trecho é a fala direta de alguém.',
        'base_text' => $baseText
    ],
    [
        'text' => 'Qual das palavras abaixo é uma proparoxítona?',
        'options' => ['Areia.', 'Próximo.', 'Professor.', 'Vidro.'],
        'correct_answer' => 1,
        'rationale' => 'Pró-xi-mo tem a antepenúltima sílaba tônica.',
    ],
    [
        'text' => 'Assinale a frase com erro de regência verbal:',
        'options' => ['Eu assisti ao filme ontem.', 'O aluno obedeceu o professor.', 'Esqueci-me dos livros.', 'Chegamos ao colégio cedo.'],
        'correct_answer' => 1,
        'rationale' => 'O verbo obedecer exige a preposição "a" (obedeceu AO professor).',
    ],
    [
        'text' => 'O coletivo de "estudantes" é:',
        'options' => ['Matilha.', 'Classe ou Alunato.', 'Constelação.', 'Assembleia.'],
        'correct_answer' => 1,
        'rationale' => 'Classe ou Alunato são os termos coletivos para estudantes.',
    ],
    [
        'text' => 'A palavra "esgote" (verbo esgotar) deriva de:',
        'options' => ['Gota.', 'Gosto.', 'Gasto.', 'Gesto.'],
        'correct_answer' => 0,
        'rationale' => 'Esgotar vem de es- + gota + -ar.',
    ],
    [
        'text' => 'Marque a opção onde o "porquê" está usado corretamente:',
        'options' => ['Não sei por que você chorou.', 'Você faltou porquê?', 'O por quê de tudo isso é um mistério.', 'Vou estudar por que quero passar.'],
        'correct_answer' => 0,
        'rationale' => 'Usa-se "por que" separado e sem acento no início ou meio de perguntas ou frases interrogativas indiretas.',
    ],
    [
        'text' => '"O mestre derramou areia". Se passarmos para a voz passiva, teremos:',
        'options' => ['A areia foi derramada pelo mestre.', 'O mestre tinha derramado areia.', 'Derramaram areia no mestre.', 'Areia o mestre derramou.'],
        'correct_answer' => 0,
        'rationale' => 'O objeto direto torna-se o sujeito paciente da locução verbal.',
    ],
    [
        'text' => 'Qual o feminino de "Professor"?',
        'options' => ['Professora.', 'Profissional.', 'Professoraça.', 'Profetisa.'],
        'correct_answer' => 0,
        'rationale' => 'Feminino simples por acréscimo de A.',
    ],
    [
        'text' => 'Escolha a alternativa escrita corretamente:',
        'options' => ['Analisar, atrasar, paralisar.', 'Analizar, atrazar, paralizar.', 'Analizar, atrasar, paralisar.', 'Analisar, atrazar, paralizar.'],
        'correct_answer' => 0,
        'rationale' => 'Todas essas palavras são grafadas com S.',
    ],
    [
        'text' => 'O termo "rindo" (do verbo rir) está no:',
        'options' => ['Infinitivo.', 'Particípio.', 'Gerúndio.', 'Imperativo.'],
        'correct_answer' => 2,
        'rationale' => 'Terminação em -ndo indica o gerúndio.',
    ],
    [
        'text' => 'Na frase "Vem cá, meu filho", o termo em destaque (meu filho) é:',
        'options' => ['Sujeito.', 'Vocativo.', 'Objeto direto.', 'Adjunto adnominal.'],
        'correct_answer' => 1,
        'rationale' => 'Trata-se de um chamamento ou evocação direta.',
    ]
];

$mathQuestions = [
    [
        'text' => 'Uma escola tem 400 alunos. Se 60% são meninas, quantos são os meninos?',
        'options' => ['160', '240', '200', '140'],
        'correct_answer' => 0,
        'rationale' => 'Se 60% são meninas, 40% são meninos. 400 * 0,4 = 160.'
    ],
    [
        'text' => 'Um livro tem 240 páginas. Se eu li 1/3 do livro, quantas páginas ainda faltam ler?',
        'options' => ['80', '120', '160', '200'],
        'correct_answer' => 2,
        'rationale' => '1/3 de 240 é 80. Faltam 240 - 80 = 160.'
    ],
    [
        'text' => 'Qual o valor de Y na equação: 5y - 10 = 40?',
        'options' => ['6', '8', '10', '12'],
        'correct_answer' => 2,
        'rationale' => '5y = 50 => y = 10.'
    ],
    [
        'text' => 'Um pátio escolar quadrado tem 12 metros de lado. Qual o seu perímetro?',
        'options' => ['24 m', '48 m', '144 m', '36 m'],
        'correct_answer' => 1,
        'rationale' => 'P = 12 * 4 = 48 m.'
    ],
    [
        'text' => 'Resolva: (15 / 3) + (2 * 8) - 10.',
        'options' => ['11', '21', '31', '5'],
        'correct_answer' => 0,
        'rationale' => '5 + 16 - 10 = 21 - 10 = 11.'
    ],
    [
        'text' => 'Um ciclista percorre 15 km em 30 minutos. Qual a sua velocidade em km/h?',
        'options' => ['15 km/h', '30 km/h', '45 km/h', '60 km/h'],
        'correct_answer' => 1,
        'rationale' => 'Se ele faz 15km em 0,5h, em 1h fará 30km.'
    ],
    [
        'text' => 'O MMC entre 8 e 12 é:',
        'options' => ['4', '20', '24', '96'],
        'correct_answer' => 2,
        'rationale' => 'Múltiplos de 12: 12, 24... Múltiplos de 8: 8, 16, 24... MMC = 24.'
    ],
    [
        'text' => 'Se 5 canetas custam R$ 12,50, quanto custarão 12 canetas?',
        'options' => ['R$ 25,00', 'R$ 30,00', 'R$ 32,50', 'R$ 35,00'],
        'correct_answer' => 1,
        'rationale' => 'Cada caneta custa 12,50 / 5 = 2,50. 12 * 2,50 = 30,00.'
    ],
    [
        'text' => 'Um triângulo tem ângulos de 45° e 55°. Quanto mede o terceiro ângulo?',
        'options' => ['80°', '90°', '100°', '180°'],
        'correct_answer' => 0,
        'rationale' => '180 - (45 + 55) = 180 - 100 = 80°.'
    ],
    [
        'text' => 'Converta 750 ml em litros:',
        'options' => ['7,5 L', '0,75 L', '0,075 L', '75 L'],
        'correct_answer' => 1,
        'rationale' => '750 / 1000 = 0,75 L.'
    ],
    [
        'text' => 'Qual a área de um triângulo com base de 10 m e altura de 6 m?',
        'options' => ['60 m²', '30 m²', '16 m²', '20 m²'],
        'correct_answer' => 1,
        'rationale' => 'Área = (10 * 6) / 2 = 30 m².'
    ],
    [
        'text' => 'Um terreno retangular mede 20m de comprimento por 15m de largura. Qual a área?',
        'options' => ['35 m²', '70 m²', '300 m²', '150 m²'],
        'correct_answer' => 2,
        'rationale' => 'Área = 20 * 15 = 300 m².'
    ],
    [
        'text' => 'O MDC entre 18 e 24 é:',
        'options' => ['2', '3', '6', '12'],
        'correct_answer' => 2,
        'rationale' => 'O maior divisor comum entre 18 e 24 é 6.'
    ],
    [
        'text' => 'Uma escada de 5 metros forma um triângulo retângulo com o chão. Se a distância da base ao muro é de 3 metros, qual a altura do muro?',
        'options' => ['2 m', '3 m', '4 m', '5 m'],
        'correct_answer' => 2,
        'rationale' => 'h² + 3² = 5² => h² + 9 = 25 => h² = 16 => h = 4.'
    ],
    [
        'text' => 'Se X + X + X = 45, qual o valor de X²?',
        'options' => ['15', '30', '225', '45'],
        'correct_answer' => 2,
        'rationale' => '3x = 45 => x = 15. X² = 15 * 15 = 225.'
    ],
    [
        'text' => 'Um ângulo de 90° é chamado de:',
        'options' => ['Agudo.', 'Obtuso.', 'Raso.', 'Reto.'],
        'correct_answer' => 3,
        'rationale' => 'Ângulos de exatamente 90 graus são retos.'
    ],
    [
        'text' => 'Quantos segundos existem em 2 horas e 15 minutos?',
        'options' => ['8.100 s', '7.200 s', '1.500 s', '9.000 s'],
        'correct_answer' => 0,
        'rationale' => '2 * 3600 = 7200. 15 * 60 = 900. Total = 8100 s.'
    ],
    [
        'text' => 'Se uma balsa carrega 15 carros, quantas viagens para 100 carros?',
        'options' => ['6', '6,6', '7', '8'],
        'correct_answer' => 2,
        'rationale' => '100 / 15 = 6,66... São necessárias 7 viagens para levar todos.'
    ],
    [
        'text' => 'O triplo de um número subtraído de 5 é 25. Que número é esse?',
        'options' => ['5', '10', '15', '20'],
        'correct_answer' => 1,
        'rationale' => '3x - 5 = 25 => 3x = 30 => x = 10.'
    ],
    [
        'text' => 'Qual a probabilidade de tirar um número par em um dado de 6 faces?',
        'options' => ['1/6', '1/3', '1/2', '2/3'],
        'correct_answer' => 2,
        'rationale' => 'Existem 3 pares (2, 4, 6) em 6 faces. 3/6 = 1/2.'
    ]
];

foreach ($portugueseQuestions as $q) {
    Question::create(array_merge($q, ['block' => 5, 'subject' => 'portugues']));
}

foreach ($mathQuestions as $q) {
    Question::create(array_merge($q, ['block' => 5, 'subject' => 'matematica']));
}

echo "Bloco 5 reformulado com sucesso!\n";
