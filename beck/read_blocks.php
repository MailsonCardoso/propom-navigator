<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

for ($i = 1; $i <= 5; $i++) {
    echo "=== BLOCO $i ===\n";
    $q = Question::where('block', $i)->where('subject', 'matematica')->first();
    if ($q) {
        echo "Exemplo: {$q->text}\n";
    } else {
        echo "Sem questões de matemática.\n";
    }
}
