<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$mathQuestions = Question::where('subject', 'matematica')->where('block', 1)->get();

foreach ($mathQuestions as $q) {
    echo "ID: {$q->id}\n";
    echo "Text: {$q->text}\n";
    echo "Options: " . json_encode($q->options) . "\n";
    echo "-------------------\n";
}
