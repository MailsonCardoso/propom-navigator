<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$block = 1;
$portugues = Question::where('block', $block)
    ->where('subject', 'portugues')
    ->get();

$questions = $portugues->map(function ($question) {
    return [
        'id' => $question->id,
        'block' => $question->block,
        'subject' => $question->subject,
        'text' => $question->text,
        'base_text' => $question->base_text,
        'options' => $question->options,
        'hint' => $question->hint,
    ];
});

echo "Total Questions: " . $questions->count() . "\n";
echo "Questions with base_text: " . $questions->filter(fn($q) => !empty($q['base_text']))->count() . "\n";

foreach ($questions as $q) {
    if (empty($q['base_text'])) {
        echo "ID " . $q['id'] . " is MISSING base_text\n";
    }
}
