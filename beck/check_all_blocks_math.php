<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$blocks = Question::distinct()->pluck('block')->sort();

foreach ($blocks as $block) {
    echo "=== BLOCO $block ===\n";
    $mathQuestions = Question::where('subject', 'matematica')
        ->where('block', $block)
        ->limit(3) // Check just a few to see the pattern
        ->get();

    if ($mathQuestions->isEmpty()) {
        echo "Nenhuma questão de matemática neste bloco.\n";
    } else {
        foreach ($mathQuestions as $q) {
            echo "ID: {$q->id} | Text: " . substr($q->text, 0, 100) . "...\n";
        }
    }
    echo "\n";
}
