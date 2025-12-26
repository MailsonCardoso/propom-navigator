<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$questions = Question::whereBetween('id', [1, 20])->get();

foreach ($questions as $q) {
    echo "ID: {$q->id} | Block: {$q->block} | Subject: {$q->subject} | HasBaseText: " . ($q->base_text ? 'Yes' : 'No') . "\n";
}
