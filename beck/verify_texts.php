<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

foreach ([2, 3, 4, 5] as $block) {
    echo "Bloco $block:\n";
    $withText = Question::where('block', $block)->whereNotNull('base_text')->where('base_text', '!=', '')->count();
    $total = Question::where('block', $block)->count();
    echo "  - Total de questões: $total\n";
    echo "  - Questões com base_text: $withText\n";

    if ($withText > 0) {
        $first = Question::where('block', $block)->whereNotNull('base_text')->orderBy('id')->first();
        echo "  - Amostra do base_text: " . substr($first->base_text, 0, 50) . "...\n";
        echo "  - IDs com texto: " . Question::where('block', $block)->whereNotNull('base_text')->pluck('id')->implode(', ') . "\n";
    }
}
