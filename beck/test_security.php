<?php

echo "===========================================\n";
echo "  TESTE RIGOROSO DE AUTENTICAÇÃO\n";
echo "===========================================\n\n";

function testLogin($endpoint, $login, $password, $shouldWork = true)
{
    $ch = curl_init("http://localhost:8000/api/auth/$endpoint");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Accept: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['login' => $login, 'password' => $password]));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode($response, true);

    if ($shouldWork) {
        if ($httpCode === 200) {
            echo "   ✅ PASSOU: Login '$login' funcionou como esperado\n";
            return true;
        } else {
            echo "   ❌ FALHOU: Login '$login' deveria funcionar mas retornou HTTP $httpCode\n";
            echo "      Mensagem: " . ($data['message'] ?? 'Sem mensagem') . "\n";
            return false;
        }
    } else {
        if ($httpCode === 401 || $httpCode === 403) {
            echo "   ✅ PASSOU: Login '$login' foi bloqueado como esperado (HTTP $httpCode)\n";
            return true;
        } else {
            echo "   ❌ FALHOU: Login '$login' deveria ser bloqueado mas retornou HTTP $httpCode\n";
            if ($httpCode === 200) {
                echo "      ⚠️  CRÍTICO: Autenticação indevida!\n";
                echo "      Usuário: " . ($data['user']['name'] ?? 'N/A') . "\n";
            }
            return false;
        }
    }
}

echo "📋 TESTE 1: Credenciais VÁLIDAS\n";
echo "─────────────────────────────────────────\n";
testLogin('login/admin', 'admin', 'admin@2026', true);
testLogin('login/student', 'aluno.teste', 'aluno@2026', true);
echo "\n";

echo "📋 TESTE 2: Senhas INCORRETAS\n";
echo "─────────────────────────────────────────\n";
testLogin('login/admin', 'admin', 'senha_errada', false);
testLogin('login/admin', 'admin', '123456', false);
testLogin('login/admin', 'admin', '', false);
testLogin('login/student', 'aluno.teste', 'senha_errada', false);
testLogin('login/student', 'aluno.teste', '123456', false);
echo "\n";

echo "📋 TESTE 3: Logins INEXISTENTES\n";
echo "─────────────────────────────────────────\n";
testLogin('login/admin', 'admin_fake', 'qualquer_senha', false);
testLogin('login/admin', 'usuario_nao_existe', 'senha123', false);
testLogin('login/student', 'aluno_fake', 'qualquer_senha', false);
testLogin('login/student', 'nao_existe', 'senha123', false);
echo "\n";

echo "📋 TESTE 4: Tentativa de CROSS-ROLE\n";
echo "─────────────────────────────────────────\n";
echo "   (Tentar logar como admin usando credenciais de aluno)\n";
testLogin('login/admin', 'aluno.teste', 'aluno@2026', false);
echo "   (Tentar logar como aluno usando credenciais de admin)\n";
testLogin('login/student', 'admin', 'admin@2026', false);
echo "\n";

echo "📋 TESTE 5: Injeção e Caracteres Especiais\n";
echo "─────────────────────────────────────────\n";
testLogin('login/admin', "admin' OR '1'='1", 'qualquer', false);
testLogin('login/admin', 'admin"; DROP TABLE users;--', 'qualquer', false);
testLogin('login/admin', '<script>alert(1)</script>', 'qualquer', false);
echo "\n";

echo "===========================================\n";
echo "  RESULTADO FINAL\n";
echo "===========================================\n";
echo "✅ Se todos os testes passaram, a autenticação está SEGURA\n";
echo "❌ Se algum teste falhou, há VULNERABILIDADE de segurança\n\n";
