<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$baseText = "O Ônibus\n\nSubiu às sete. Desceu às nove. Nas duas horas intermináveis, decifrou um mistério, que acompanhei de perto. A mancha no colarinho do motorista não era café, nem molho, nem ferrugem. Era sangue. O mesmo sangue na mão da passageira que não parava de olhar para os lados. Sua mão esquerda escondia a direita no balaústre. O motorista coçava o pescoço e olhava para a mão dela. Quando estavam quase impunes, viu-se a fortuita subida de um policial e ouviu-se um grito: “Sangue!”. A mulher reagiu por instinto, pondo as mãos ao alto e deflagrando a prova do delito. O motorista freou bruscamente, pulou pela janela e foi atropelado. O policial prendeu a amante do motorista e perguntou quem dera o grito. Era o detetive Félix Zaidan.\n\n(OLIVEIRA, Fernando Lúcio de. O ônibus. In: Folha da Baixada. Adaptado.)";

$questionsUpdate = [
    1 => [
        'text' => 'De acordo com a narrativa, quem foi o responsável por revelar o crime ao gritar "Sangue!"?',
        'options' => ['O motorista', 'O policial', 'A passageira', 'O detetive Félix Zaidan'],
        'correct_answer' => 3,
        'rationale' => 'O texto afirma explicitamente no final: "Era o detetive Félix Zaidan".'
    ],
    2 => [
        'text' => 'No trecho "Subiu às sete. Desceu às nove.", as palavras destacadas indicam, respectivamente:',
        'options' => ['Ações concluídas no passado', 'Desejos do narrador', 'Fatos que ainda vão ocorrer', 'Estados permanentes dos personagens'],
        'correct_answer' => 0,
        'rationale' => 'Os verbos "subiu" e "desceu" estão no Pretérito Perfeito do Indicativo, indicando ações pontuais e concluídas.'
    ],
    3 => [
        'text' => 'A palavra "balaústre" recebe acento gráfico pelo mesmo motivo que:',
        'options' => ['Saúde', 'Café', 'Automóvel', 'Lâmpada'],
        'correct_answer' => 0,
        'rationale' => 'Ambas são acentuadas pela regra do hiato (i ou u tônicos sozinhos na sílaba).'
    ],
    4 => [
        'text' => 'No contexto do texto, a subida "fortuita" do policial significa que ela foi:',
        'options' => ['Planejada', 'Inesperada / Casual', 'Violenta', 'Demorada'],
        'correct_answer' => 1,
        'rationale' => 'Fortuito significa algo que acontece por acaso, imprevisto.'
    ],
    5 => [
        'text' => 'O motorista "pulou pela janela" porque:',
        'options' => ['O ônibus estava pegando fogo', 'Queria ajudar a passageira', 'Tentou fugir após a descoberta do delito', 'O sistema de freios falhou'],
        'correct_answer' => 2,
        'rationale' => 'A fuga ocorre imediatamente após o grito e a reação da passageira que revelou o crime.'
    ],
    6 => [
        'text' => 'Na oração "O policial prendeu a amante do motorista", o termo destacado exerce a função de:',
        'options' => ['Sujeito', 'Adjunto Adverbial', 'Objeto Direto', 'Predicativo do Sujeito'],
        'correct_answer' => 2,
        'rationale' => 'O verbo "prender" é transitivo direto; quem prende, prende alguém (a amante).'
    ],
    7 => [
        'text' => 'Em "A mancha no colarinho do motorista NÃO era café, nem molho, nem ferrugem", a palavra destacada é um advérbio de:',
        'options' => ['Lugar', 'Tempo', 'Negação', 'Dúvida'],
        'correct_answer' => 2,
        'rationale' => 'A palavra "não" modifica o verbo negando o fato.'
    ],
    8 => [
        'text' => 'O plural da palavra "Capitão", que poderia aparecer em um contexto militar/naval, segue a mesma regra de "Cidadão"?',
        'options' => ['Sim, ambos fazem plural em -ãos', 'Não, Capitão faz Capitães e Cidadão faz Cidadãos', 'Sim, ambos fazem plural em -ões', 'Não, ambos são invariáveis'],
        'correct_answer' => 1,
        'rationale' => 'Capitães (plural em -ães) vs Cidadãos (plural em -ãos).'
    ],
    9 => [
        'text' => 'Qual o sentimento da passageira sugerido pelo trecho "não parava de olhar para os lados"?',
        'options' => ['Alegria', 'Tédio', 'Nervosismo / Culpa', 'Orgulho'],
        'correct_answer' => 2,
        'rationale' => 'O comportamento esquivo e o olhar constante indicam tensão e medo de ser descoberta.'
    ],
    10 => [
        'text' => 'Indique a classe gramatical da palavra "sangue" no texto:',
        'options' => ['Adjetivo', 'Substantivo', 'Verbo', 'Preposição'],
        'correct_answer' => 1,
        'rationale' => 'Sangue é o nome de uma substância, portanto, um substantivo.'
    ]
];

// Atualizar as primeiras 10 questões do Bloco 1 de Português
foreach ($questionsUpdate as $id => $data) {
    if ($id <= 20) {
        $q = Question::where('id', $id)->first();
        if ($q) {
            $q->base_text = $baseText;
            $q->text = $data['text'];
            $q->options = $data['options'];
            $q->correct_answer = $data['correct_answer'];
            $q->rationale = $data['rationale'];
            $q->save();
            echo "Questão $id atualizada com texto base.\n";
        }
    }
}
echo "Processo concluído.\n";
