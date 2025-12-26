<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$questions = Question::where('block', 1)->where('subject', 'portugues')->offset(10)->limit(10)->get();

foreach ($questions as $q) {
    echo "ID: {$q->id} | Text: {$q->text}\n";
}
