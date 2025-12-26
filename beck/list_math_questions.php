<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$questions = Question::where('subject', 'Matemática')->get();

foreach ($questions as $q) {
    echo "--- QUESTION ID: {$q->id} ---\n";
    echo "TEXT: {$q->text}\n";
    echo "BLOCK: {$q->block}\n\n";
}
