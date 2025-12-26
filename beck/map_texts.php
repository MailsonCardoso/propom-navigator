<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

foreach ([1, 2, 3, 4, 5] as $block) {
    echo "--- BLOCO $block ---\n";
    $qs = Question::where('block', $block)->orderBy('id')->get();
    foreach ($qs as $i => $q) {
        $num = $i + 1;
        if ($q->base_text) {
            echo "Questão $num (ID: {$q->id}) - TEM TEXTO\n";
        } else {
            // echo "Questão $num (ID: {$q->id}) - não tem\n";
        }
    }
}
