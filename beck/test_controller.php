<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Http\Controllers\Api\QuestionController;
use Illuminate\Http\Request;

$controller = new QuestionController();
$request = new Request(['block' => 1]);
$response = $controller->index($request);

$data = json_decode($response->getContent(), true);

if (count($data) > 0) {
    echo "Total questions: " . count($data) . "\n";
    $q1 = $data[0];
    echo "ID: " . $q1['id'] . "\n";
    echo "Base Text exists in controller response: " . (isset($q1['base_text']) ? "YES" : "NO") . "\n";
    if (isset($q1['base_text'])) {
        echo "Base Text Length: " . strlen($q1['base_text']) . "\n";
    }
} else {
    echo "No questions returned from controller.\n";
}
