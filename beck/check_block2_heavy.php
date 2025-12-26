<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$counts = Question::where('block', 2)->groupBy('subject')->select('subject', \DB::raw('count(*) as total'))->get();

echo "CONTAGEM BLOCO 2:\n";
foreach ($counts as $c) {
    echo "Assunto: {$c->subject} | Total: {$c->total}\n";
}

$allInBlock2 = Question::where('block', 2)->get();
echo "IDs no Bloco 2:\n";
foreach ($allInBlock2 as $q) {
    echo "ID: {$q->id} | Matéria: {$q->subject} | Texto: " . substr($q->text, 0, 50) . "...\n";
}
