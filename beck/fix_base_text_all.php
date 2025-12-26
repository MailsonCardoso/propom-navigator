<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$baseText = "O Ônibus\n\nSubiu às sete. Desceu às nove. Nas duas horas intermináveis, decifrou um mistério, que acompanhei de perto. A mancha no colarinho do motorista não era café, nem molho, nem ferrugem. Era sangue. O mesmo sangue na mão da passageira que não parava de olhar para os lados. Sua mão esquerda escondia a direita no balaústre. O motorista coçava o pescoço e olhava para a mão dela. Quando estavam quase impunes, viu-se a fortuita subida de um policial e ouviu-se um grito: “Sangue!”. A mulher reagiu por instinto, pondo as mãos ao alto e deflagrando a prova do delito. O motorista freou bruscamente, pulou pela janela e foi atropelado. O policial prendeu a amante do motorista e perguntou quem dera o grito. Era o detetive Félix Zaidan.\n\n(OLIVEIRA, Fernando Lúcio de. O ônibus. In: Folha da Baixada. Adaptado.)";

$count = Question::where('block', 1)
    ->where('subject', 'portugues')
    ->update(['base_text' => $baseText]);

echo "$count questions updated with base_text.\n";

// Agora, vamos aproveitar e atualizar as questões 11-20 para o contexto
$extraQuestions = [
    11 => [
        'text' => 'Indique o antônimo de "bruscamente" conforme usado em "O motorista freou bruscamente":',
        'options' => ['Rapidamente', 'Suavemente', 'Violentamente', 'Imediatamente'],
        'correct_answer' => 1,
        'rationale' => 'Bruscamente indica rapidez/vifgor; suavemente é o oposto.'
    ],
    12 => [
        'text' => 'Qual o tipo de narrador presente no texto?',
        'options' => ['Narrador observador (não participa)', 'Narrador personagem (participa da história)', 'Narrador onisciente (sabe até o que pensam)', 'Não há narrador'],
        'correct_answer' => 1,
        'rationale' => 'O narrador diz "...que acompanhei de perto", indicando que ele estava presente no ônibus.'
    ],
    13 => [
        'text' => 'No trecho "O motorista coçava o pescoço e olhava para a mão DELA", o termo destacado refere-se a:',
        'options' => ['A mancha', 'A janela', 'A passageira', 'A mulher do policial'],
        'correct_answer' => 2,
        'rationale' => 'A relação de olhar e esconder mãos estabelecida entre o motorista e a passageira.'
    ],
    14 => [
        'text' => 'A pontuação usada em: “Sangue!” serve para indicar:',
        'options' => ['Uma pergunta', 'Um grito / espanto', 'Uma hesitação', 'Uma citação indireta'],
        'correct_answer' => 1,
        'rationale' => 'O ponto de exclamação enfatiza a exclamação feita pelo detetive.'
    ],
    15 => [
        'text' => 'Se o ônibus saiu exatamente às sete e chegou às nove, quanto tempo durou a viagem?',
        'options' => ['1 hora', '2 horas', '3 horas', '30 minutos'],
        'correct_answer' => 1,
        'rationale' => 'Das 7h às 9h decorreram exatamente 2 horas.'
    ],
    16 => [
        'text' => 'As palavras "sangue", "policial" e "delito" são acentuadas?',
        'options' => ['Todas são acentuadas', 'Nenhuma delas é acentuada graficamente', 'Apenas policial é acentuada', 'Apenas delito é acentuada'],
        'correct_answer' => 1,
        'rationale' => 'Nenhuma dessas palavras possui acento gráfico na língua portuguesa.'
    ],
    17 => [
        'text' => 'Identifique o sujeito da oração: "O motorista freou bruscamente":',
        'options' => ['Freou', 'O motorista', 'Bruscamente', 'Inexistente'],
        'correct_answer' => 1,
        'rationale' => 'Quem freou? O motorista.'
    ],
    18 => [
        'text' => 'Em "Era sangue", o verbo ser indica:',
        'options' => ['Uma ação dinâmica', 'Um estado ou identificação', 'Um desejo', 'Uma ordem'],
        'correct_answer' => 1,
        'rationale' => 'O verbo de ligação identifica a natureza da mancha.'
    ],
    19 => [
        'text' => 'No final do texto, descobre-se que Félix Zaidan é:',
        'options' => ['O motorista', 'O passageiro no fundo', 'O detetive que deu o grito', 'O policial que subiu'],
        'correct_answer' => 2,
        'rationale' => 'O texto encerra: "Era o detetive Félix Zaidan", respondendo quem dera o grito.'
    ],
    20 => [
        'text' => 'A expressão "de perto" em "acompanhei de perto" é uma locução:',
        'options' => ['Adjetiva', 'Adverbial de lugar/modo', 'Substantiva', 'Verbal'],
        'correct_answer' => 1,
        'rationale' => 'Modifica o verbo acompanhar indicando a proximidade.'
    ]
];

foreach ($extraQuestions as $id => $data) {
    $q = Question::find($id);
    if ($q) {
        $q->text = $data['text'];
        $q->options = $data['options'];
        $q->correct_answer = $data['correct_answer'];
        $q->rationale = $data['rationale'];
        $q->save();
    }
}
echo "Questions 11-20 updated as well.\n";
