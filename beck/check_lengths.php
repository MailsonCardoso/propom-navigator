<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

foreach ([1, 2, 3, 4, 5] as $block) {
    echo "Bloco $block:\n";
    $qs = Question::where('block', $block)->where('subject', 'portugues')->get();
    foreach ($qs as $q) {
        $len = strlen($q->base_text);
        echo "  ID: {$q->id} | Len: $len\n";
    }
}
