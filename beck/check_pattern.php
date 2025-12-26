<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$blocks = Question::distinct()->pluck('block')->sort();

foreach ($blocks as $block) {
    echo "--- BLOCO $block ---\n";
    $subjects = ['portugues', 'matematica'];
    foreach ($subjects as $subject) {
        $count = Question::where('block', $block)->where('subject', $subject)->count();
        if ($count > 0) {
            $sample = Question::where('block', $block)->where('subject', $subject)->first();
            echo "$subject ($count): " . substr($sample->text, 0, 80) . "...\n";
        }
    }
}
