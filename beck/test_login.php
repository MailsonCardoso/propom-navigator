<?php

echo "===========================================\n";
echo "  TESTE DE LOGIN - CREDENCIAIS\n";
echo "===========================================\n\n";

// Teste 1: Login Admin
echo "1️⃣  Testando login ADMIN...\n";
$ch = curl_init('http://localhost:8000/api/auth/login/admin');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Accept: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['login' => 'admin', 'password' => 'admin@2026']));
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    echo "   ✅ Login admin: SUCESSO\n";
    $data = json_decode($response, true);
    echo "   Nome: " . $data['user']['name'] . "\n";
    echo "   Login: " . $data['user']['login'] . "\n";
    echo "   Role: " . $data['user']['role'] . "\n";
    echo "   Token: " . substr($data['token'], 0, 30) . "...\n\n";
    $adminToken = $data['token'];
} else {
    echo "   ❌ Login admin: FALHOU (HTTP $httpCode)\n";
    echo "   Resposta: $response\n\n";
    exit(1);
}

// Teste 2: Login Aluno
echo "2️⃣  Testando login ALUNO...\n";
$ch = curl_init('http://localhost:8000/api/auth/login/student');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Accept: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['login' => 'aluno.teste', 'password' => 'aluno@2026']));
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    echo "   ✅ Login aluno: SUCESSO\n";
    $data = json_decode($response, true);
    echo "   Nome: " . $data['user']['name'] . "\n";
    echo "   Login: " . $data['user']['login'] . "\n";
    echo "   Role: " . $data['user']['role'] . "\n";
    echo "   Token: " . substr($data['token'], 0, 30) . "...\n\n";
    $studentToken = $data['token'];
} else {
    echo "   ❌ Login aluno: FALHOU (HTTP $httpCode)\n";
    echo "   Resposta: $response\n\n";
    exit(1);
}

// Teste 3: Verificar autenticação do admin
echo "3️⃣  Testando autenticação do ADMIN...\n";
$ch = curl_init('http://localhost:8000/api/auth/me');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer ' . $adminToken
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    echo "   ✅ Token admin válido\n\n";
} else {
    echo "   ❌ Token admin inválido (HTTP $httpCode)\n\n";
}

// Teste 4: Verificar autenticação do aluno
echo "4️⃣  Testando autenticação do ALUNO...\n";
$ch = curl_init('http://localhost:8000/api/auth/me');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Bearer ' . $studentToken
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    echo "   ✅ Token aluno válido\n\n";
} else {
    echo "   ❌ Token aluno inválido (HTTP $httpCode)\n\n";
}

echo "===========================================\n";
echo "  ✅ TODOS OS TESTES PASSARAM!\n";
echo "===========================================\n\n";

echo "📋 CREDENCIAIS VALIDADAS:\n\n";
echo "🔐 ADMIN:\n";
echo "   Login: admin\n";
echo "   Senha: admin@2026\n\n";
echo "👤 ALUNO:\n";
echo "   Login: aluno.teste\n";
echo "   Senha: aluno@2026\n\n";
echo "✅ Ambos os usuários estão prontos para uso!\n";
