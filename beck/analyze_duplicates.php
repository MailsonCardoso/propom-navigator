<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Question;
use Illuminate\Support\Facades\DB;

$duplicates = DB::table('questions')
    ->select('text', DB::raw('count(*) as total'), DB::raw('GROUP_CONCAT(id) as ids'), DB::raw('GROUP_CONCAT(block) as blocks'))
    ->groupBy('text')
    ->having('total', '>', 1)
    ->get();

if ($duplicates->isEmpty()) {
    echo "Nenhuma questão duplicada encontrada pelo texto exato.\n";
} else {
    echo "Questões duplicadas encontradas:\n\n";
    foreach ($duplicates as $duplicate) {
        echo "Texto: " . substr($duplicate->text, 0, 80) . "...\n";
        echo "Total: " . $duplicate->total . " ocorrências\n";
        echo "IDs: " . $duplicate->ids . "\n";
        echo "Blocos: " . $duplicate->blocks . "\n";
        echo "--------------------------------------------------\n";
    }
}
