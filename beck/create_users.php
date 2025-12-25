<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "========================================\n";
echo "  CRIANDO USUÁRIOS PARA LOGIN\n";
echo "========================================\n\n";

try {
    // Verificar se admin já existe
    $existingAdmin = \App\Models\User::where('login', 'admin')->first();
    if ($existingAdmin) {
        echo "⚠️  Admin 'admin' já existe!\n";
        echo "   Nome: " . $existingAdmin->name . "\n";
        echo "   Login: " . $existingAdmin->login . "\n\n";
    } else {
        // Criar administrador
        $admin = \App\Models\User::create([
            'name' => 'Administrador Sistema',
            'login' => 'admin',
            'email' => 'admin@propom.com.br',
            'password' => \Hash::make('admin@2026'),
            'role' => 'admin',
            'active' => true,
        ]);

        echo "✅ Admin criado com sucesso!\n";
        echo "   Nome: " . $admin->name . "\n";
        echo "   Login: " . $admin->login . "\n";
        echo "   Senha: admin@2026\n";
        echo "   Email: " . $admin->email . "\n\n";
    }

    // Verificar se aluno já existe
    $existingStudent = \App\Models\User::where('login', 'aluno.teste')->first();
    if ($existingStudent) {
        echo "⚠️  Aluno 'aluno.teste' já existe!\n";
        echo "   Nome: " . $existingStudent->name . "\n";
        echo "   Login: " . $existingStudent->login . "\n\n";
    } else {
        // Criar aluno de teste
        $student = \App\Models\User::create([
            'name' => 'Aluno Teste',
            'login' => 'aluno.teste',
            'email' => 'aluno@propom.com.br',
            'password' => \Hash::make('aluno@2026'),
            'role' => 'student',
            'active' => true,
        ]);

        echo "✅ Aluno criado com sucesso!\n";
        echo "   Nome: " . $student->name . "\n";
        echo "   Login: " . $student->login . "\n";
        echo "   Senha: aluno@2026\n";
        echo "   Email: " . $student->email . "\n\n";
    }

    echo "========================================\n";
    echo "  RESUMO DAS CREDENCIAIS\n";
    echo "========================================\n\n";

    echo "🔐 ADMINISTRADOR:\n";
    echo "   Login: admin\n";
    echo "   Senha: admin@2026\n";
    echo "   URL: http://localhost:8000/api/auth/login/admin\n\n";

    echo "👤 ALUNO:\n";
    echo "   Login: aluno.teste\n";
    echo "   Senha: aluno@2026\n";
    echo "   URL: http://localhost:8000/api/auth/login/student\n\n";

    echo "========================================\n";
    echo "  Total de usuários no sistema: " . \App\Models\User::count() . "\n";
    echo "  Admins: " . \App\Models\User::where('role', 'admin')->count() . "\n";
    echo "  Alunos: " . \App\Models\User::where('role', 'student')->count() . "\n";
    echo "========================================\n\n";

    echo "✅ Usuários prontos para login!\n";

} catch (\Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n";
}
