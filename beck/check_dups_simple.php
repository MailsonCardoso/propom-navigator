<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use App\Models\Question;

$dupData = [];
$all = Question::all();
foreach ($all as $q) {
    $n = strtolower(preg_replace('/[^a-z0-9]/', '', $q->text));
    $dupData[$n][] = "ID:{$q->id}(B{$q->block})";
}

$final = [];
foreach ($dupData as $text => $occ) {
    if (count($occ) > 1) {
        $final[] = implode(", ", $occ) . " -> " . substr($text, 0, 30);
    }
}

file_put_contents('dups.txt', implode("\n", $final));
echo "Encontrados " . count($final) . " grupos de duplicatas.\n";
