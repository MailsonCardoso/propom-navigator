<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Question;

$questions = Question::all();
$grouped = [];

foreach ($questions as $q) {
    $normalized = strtolower(preg_replace('/[^a-z0-9]/', '', $q->text));
    $grouped[$normalized][] = $q;
}

$duplicates = array_filter($grouped, function ($group) {
    return count($group) > 1;
});

echo "Relatório de Questões Duplicadas (Mesmo texto ou muito similar):\n";
echo "=============================================================\n\n";

foreach ($duplicates as $norm => $group) {
    echo "Questão: " . substr($group[0]->text, 0, 100) . "...\n";
    echo "Encontrada em " . count($group) . " locais:\n";
    foreach ($group as $q) {
        echo "  - ID: {$q->id} | Bloco: {$q->block} | Disciplina: {$q->subject}\n";
    }
    echo "-------------------------------------------------------------\n";
}

if (empty($duplicates)) {
    echo "Nenhuma questão duplicada encontrada.\n";
}
