<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

foreach ([1, 2, 3, 4, 5] as $block) {
    echo "Bloco $block:\n";
    $ptCount = Question::where('block', $block)->where('subject', 'portugues')->count();
    $matCount = Question::where('block', $block)->where('subject', 'matematica')->count();
    $ptWithText = Question::where('block', $block)->where('subject', 'portugues')->whereNotNull('base_text')->count();

    echo "  - Português: $ptCount (Com texto: $ptWithText)\n";
    echo "  - Matemática: $matCount\n";
}
