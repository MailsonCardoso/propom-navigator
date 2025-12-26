<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$block = 2;
$portugues = Question::where('block', $block)
    ->where('subject', 'portugues')
    ->inRandomOrder()
    ->get();

$matematica = Question::where('block', $block)
    ->where('subject', 'matematica')
    ->inRandomOrder()
    ->get();

$questions = $portugues->concat($matematica);

echo "Ordem de retorno da API para o Bloco 2 (Amostra):\n";
foreach ($questions as $i => $q) {
    if ($i < 25) {
        echo "Posição " . ($i + 1) . " | ID: {$q->id} | Matéria: {$q->subject} | Texto Base: " . ($q->base_text ? "SIM" : "NÃO") . "\n";
    }
}
