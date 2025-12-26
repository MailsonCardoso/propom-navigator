<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$q = \App\Models\Question::find(22);
print_r($q->toArray());
echo "ANS: " . $q->correct_answer . "\n";
