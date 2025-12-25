<?php

echo "===========================================\n";
echo "  DIAGNÓSTICO DE PROBLEMA DE AUTENTICAÇÃO\n";
echo "===========================================\n\n";

echo "Por favor, forneça as informações do teste que você fez:\n\n";

// Teste com credenciais que você disse que funcionaram indevidamente
echo "📋 Testando cenários problemáticos...\n\n";

$testCases = [
    ['endpoint' => 'login/admin', 'login' => 'qualquer@email.com', 'password' => 'qualquer_senha'],
    ['endpoint' => 'login/admin', 'login' => 'teste@teste.com', 'password' => '123456'],
    ['endpoint' => 'login/student', 'login' => 'qualquer@email.com', 'password' => 'qualquer_senha'],
    ['endpoint' => 'login/student', 'login' => 'teste@teste.com', 'password' => '123456'],
];

foreach ($testCases as $i => $test) {
    echo ($i + 1) . ". Testando: {$test['login']} / {$test['password']}\n";
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
        echo "   ⚠️  PROBLEMA DETECTADO! Login funcionou quando NÃO deveria!\n";
        echo "   Usuário retornado: " . ($data['user']['name'] ?? 'N/A') . "\n";
        echo "   Login retornado: " . ($data['user']['login'] ?? 'N/A') . "\n";
        echo "   Role: " . ($data['user']['role'] ?? 'N/A') . "\n";
        echo "   Token gerado: " . (isset($data['token']) ? 'SIM' : 'NÃO') . "\n";
    } else {
        echo "   ✅ Bloqueado corretamente\n";
        echo "   Mensagem: " . ($data['message'] ?? 'Sem mensagem') . "\n";
    }
    echo "\n";
}

echo "===========================================\n";
echo "  VERIFICANDO CONFIGURAÇÃO DO BANCO\n";
echo "===========================================\n\n";

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Total de usuários: " . \App\Models\User::count() . "\n";
echo "Admins: " . \App\Models\User::where('role', 'admin')->count() . "\n";
echo "Alunos: " . \App\Models\User::where('role', 'student')->count() . "\n\n";

echo "Listando todos os usuários:\n";
$users = \App\Models\User::all();
foreach ($users as $user) {
    echo "  - ID: {$user->id} | Login: {$user->login} | Nome: {$user->name} | Role: {$user->role} | Ativo: " . ($user->active ? 'Sim' : 'Não') . "\n";
}

echo "\n===========================================\n";
echo "  INSTRUÇÕES\n";
echo "===========================================\n\n";
echo "Se você está conseguindo logar com QUALQUER email/senha:\n\n";
echo "1. Verifique se está usando o endpoint correto:\n";
echo "   - Admin: POST /api/auth/login/admin\n";
echo "   - Aluno: POST /api/auth/login/student\n\n";
echo "2. Verifique se está enviando JSON no body:\n";
echo "   { \"login\": \"admin\", \"password\": \"admin@2026\" }\n\n";
echo "3. Verifique os headers:\n";
echo "   Content-Type: application/json\n";
echo "   Accept: application/json\n\n";
echo "4. Se o problema persistir, me informe:\n";
echo "   - Qual ferramenta está usando (Postman, Insomnia, Frontend)?\n";
echo "   - Qual exatamente o login/senha que funcionou indevidamente?\n";
echo "   - Qual foi a resposta completa da API?\n\n";
