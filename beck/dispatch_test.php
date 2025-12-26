<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$request = Request::create('/api/questions?block=1', 'GET');
$request->setUserResolver(fn() => \App\Models\User::first()); // Simular usuário logado se necessário
$response = Route::dispatch($request);

echo "Status: " . $response->getStatusCode() . "\n";
$data = json_decode($response->getContent(), true);

if (isset($data[0])) {
    echo "First Question ID: " . $data[0]['id'] . "\n";
    echo "Base Text exists: " . (isset($data[0]['base_text']) ? 'YES' : 'NO') . "\n";
    if (isset($data[0]['base_text'])) {
        echo "Base Text Length: " . strlen($data[0]['base_text']) . "\n";
    }
} else {
    echo "No questions found or empty response.\n";
}
