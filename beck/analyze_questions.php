<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Question;
use Illuminate\Support\Facades\DB;

echo "Análise de Questões Repetidas\n";
echo "============================\n\n";

// 1. Verificar duplicatas exatas de texto no banco todo
$duplicates = DB::table('questions')
    ->select('text', DB::raw('count(*) as occurrences'))
    ->groupBy('text')
    ->having('occurrences', '>', 1)
    ->get();

if ($duplicates->isEmpty()) {
    echo "✅ Nenhuma questão com texto idêntico encontrada no banco todo.\n";
} else {
    echo "❌ Foram encontradas questões repetidas:\n";
    foreach ($duplicates as $dup) {
        $blocks = Question::where('text', $dup->text)->pluck('block')->toArray();
        echo "- O texto '" . mb_substr($dup->text, 0, 80) . "...' aparece " . $dup->occurrences . " vezes nos Módulos: (" . implode(', ', $blocks) . ")\n";
    }
}

echo "\nAnálise por Módulo:\n";
$blocks = Question::select('block')->distinct()->orderBy('block')->pluck('block');
foreach ($blocks as $block) {
    $count = Question::where('block', $block)->count();
    echo "Módulo $block: $count questões\n";
}
