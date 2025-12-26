<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$summary = Question::select('block', 'subject', \DB::raw('count(*) as total'))
    ->groupBy('block', 'subject')
    ->orderBy('block')
    ->get();

foreach ($summary as $s) {
    echo "Bloco {$s->block} | {$s->subject}: {$s->total}\n";

    if ($s->subject == 'matematica') {
        $sample = Question::where('block', $s->block)
            ->where('subject', 'matematica')
            ->orderBy('id')
            ->limit(2)
            ->get();
        foreach ($sample as $q) {
            echo "   - ID {$q->id}: " . substr($q->text, 0, 60) . "...\n";
        }
    }
}
