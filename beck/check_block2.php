<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$block = 2;
$subjects = ['portugues', 'matematica'];

echo "Análise do BLOCO $block:\n";
foreach ($subjects as $subject) {
    $count = Question::where('block', $block)->where('subject', $subject)->count();
    echo "- $subject: $count questões\n";
    if ($count > 0) {
        $sample = Question::where('block', $block)->where('subject', $subject)->first();
        echo "  Amostra: " . substr($sample->text, 0, 100) . "\n";
    }
}
