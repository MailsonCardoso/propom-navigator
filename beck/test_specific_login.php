<?php

echo "===========================================\n";
echo "  TESTANDO CREDENCIAIS ESPECÍFICAS\n";
echo "===========================================\n\n";

$testCases = [
    [
        'endpoint' => 'login/admin',
        'login' => 'mailsonccardoso@gmail.com',
        'password' => '1q2w3e',
        'description' => 'Email que você disse que funciona'
    ],
    [
        'endpoint' => 'login/student',
        'login' => 'mailsonccardoso@gmail.com',
        'password' => '1q2w3e',
        'description' => 'Email que você disse que funciona (student)'
    ],
    [
        'endpoint' => 'login/admin',
        'login' => 'admin',
        'password' => 'admin@2026',
        'description' => 'Credencial correta do admin'
    ],
];

foreach ($testCases as $i => $test) {
    echo ($i + 1) . ". " . $test['description'] . "\n";
    echo "   Login: {$test['login']}\n";
    echo "   Senha: {$test['password']}\n";
    echo "   Endpoint: /api/auth/{$test['endpoint']}\n";

    $ch = curl_init("http://localhost:8000/api/auth/{$test['endpoint']}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Accept: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'login' => $test['login'],
        'password' => $test['password']
    ]));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode($response, true);

    echo "   Status HTTP: $httpCode\n";

    if ($httpCode === 200) {
        echo "   ⚠️  LOGIN FUNCIONOU!\n";
        echo "   Usuário: " . ($data['user']['name'] ?? 'N/A') . "\n";
        echo "   Login retornado: " . ($data['user']['login'] ?? 'N/A') . "\n";
        echo "   Role: " . ($data['user']['role'] ?? 'N/A') . "\n";
    } else {
        echo "   ✅ Bloqueado corretamente\n";
        echo "   Mensagem: " . ($data['message'] ?? 'Sem mensagem') . "\n";
    }
    echo "\n";
}

echo "===========================================\n";
echo "  VERIFICANDO FRONTEND\n";
echo "===========================================\n\n";

echo "O problema é que o FRONTEND está usando dados MOCKADOS!\n";
echo "Isso significa que ele NÃO está se conectando à API.\n\n";
echo "Vou corrigir o frontend para usar a API real.\n";
