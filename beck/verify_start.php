<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

foreach ([2, 3, 4, 5] as $block) {
    echo "Bloco $block:\n";
    $qs = Question::where('block', $block)->orderBy('id')->get();
    echo "  - Total: " . $qs->count() . " questões\n";
    foreach ($qs as $index => $q) {
        if ($index < 5) {
            echo "    Question " . ($index + 1) . " (ID {$q->id}): " . ($q->base_text ? "Tem Texto" : "NÃO TEM TEXTO") . "\n";
        }
    }
}
