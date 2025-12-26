<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Question;
use Illuminate\Support\Facades\DB;

$questions = Question::all();
$grouped = [];

foreach ($questions as $q) {
    // Normaliza o texto: minusculas, remove espaços e pontuação básica
    $normalized = strtolower(preg_replace('/[^a-z0-9]/', '', $q->text));
    $grouped[$normalized][] = [
        'id' => $q->id,
        'block' => $q->block,
        'subject' => $q->subject,
        'text' => $q->text
    ];
}

$duplicates = array_filter($grouped, function ($group) {
    return count($group) > 1;
});

echo json_encode(array_values($duplicates), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
