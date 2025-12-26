<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$result = Question::select('block', 'subject', \DB::raw('count(*) as count'))
    ->groupBy('block', 'subject')
    ->get();

foreach ($result as $r) {
    echo "Bloco {$r->block} | {$r->subject}: {$r->count}\n";
}
