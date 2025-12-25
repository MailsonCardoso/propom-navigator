<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Verificando usuários...\n\n";

$admin = \App\Models\User::where('login', 'admin')->first();
if ($admin) {
    echo "✅ Admin encontrado:\n";
    echo "   ID: " . $admin->id . "\n";
    echo "   Nome: " . $admin->name . "\n";
    echo "   Login: " . $admin->login . "\n";
    echo "   Email: " . $admin->email . "\n";
    echo "   Role: " . $admin->role . "\n";
    echo "   Ativo: " . ($admin->active ? 'Sim' : 'Não') . "\n\n";

    // Testar senha
    if (\Hash::check('admin@2026', $admin->password)) {
        echo "   ✅ Senha 'admin@2026' está CORRETA\n\n";
    } else {
        echo "   ❌ Senha 'admin@2026' está INCORRETA\n\n";
    }
} else {
    echo "❌ Admin não encontrado!\n\n";
}

$aluno = \App\Models\User::where('login', 'aluno.teste')->first();
if ($aluno) {
    echo "✅ Aluno encontrado:\n";
    echo "   ID: " . $aluno->id . "\n";
    echo "   Nome: " . $aluno->name . "\n";
    echo "   Login: " . $aluno->login . "\n";
    echo "   Email: " . $aluno->email . "\n";
    echo "   Role: " . $aluno->role . "\n";
    echo "   Ativo: " . ($aluno->active ? 'Sim' : 'Não') . "\n\n";

    // Testar senha
    if (\Hash::check('aluno@2026', $aluno->password)) {
        echo "   ✅ Senha 'aluno@2026' está CORRETA\n\n";
    } else {
        echo "   ❌ Senha 'aluno@2026' está INCORRETA\n\n";
    }
} else {
    echo "❌ Aluno não encontrado!\n\n";
}

echo "Total de usuários: " . \App\Models\User::count() . "\n";
