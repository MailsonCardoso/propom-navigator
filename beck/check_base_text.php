<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$q = \App\Models\Question::find(1);
if ($q) {
    echo "ID: " . $q->id . "\n";
    echo "Subject: " . $q->subject . "\n";
    echo "Base Text Length: " . strlen($q->base_text ?? '') . "\n";
    echo "Base Text Snippet: " . substr($q->base_text ?? '', 0, 50) . "...\n";
} else {
    echo "Question ID 1 not found.\n";
}
