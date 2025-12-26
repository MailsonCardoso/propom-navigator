<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$questions = Question::where('block', 1)->get();

echo "ID | Subject | BaseText Status | Text Start\n";
echo "---|---------|-----------------|-----------\n";
foreach ($questions as $q) {
    $bt = empty($q->base_text) ? "EMPTY" : "OK (" . strlen($q->base_text) . ")";
    echo "{$q->id} | {$q->subject} | {$bt} | " . substr($q->text, 0, 30) . "...\n";
}
