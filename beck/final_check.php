<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$block = 1;
$portugues = Question::where('block', $block)->where('subject', 'portugues')->get();

foreach ($portugues as $q) {
    echo "ID: " . $q->id . " | Meta: " . (empty($q->base_text) ? "EMPTY" : "OK") . "\n";
}
echo "Total: " . count($portugues) . "\n";
