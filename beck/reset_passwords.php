<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "### RESETANDO SENHAS ###\n\n";

// 1. Reset Admin
$admin = \App\Models\User::where('login', 'admin')->first();
if ($admin) {
    $admin->password = \Hash::make('admin@2026');
    $admin->role = 'admin'; // Garantir que está como admin
    $admin->active = true;
    $admin->save();
    echo "✅ Admin (admin) -> Senha: admin@2026 [OK]\n";
} else {
    \App\Models\User::create([
        'name' => 'Administrador',
        'login' => 'admin',
        'email' => 'admin@propom.com.br',
        'password' => \Hash::make('admin@2026'),
        'role' => 'admin',
        'active' => true
    ]);
    echo "✅ Admin (admin) criado -> Senha: admin@2026 [OK]\n";
}

// 2. Reset Aluno Teste
$aluno = \App\Models\User::where('login', 'aluno.teste')->first();
if ($aluno) {
    $aluno->password = \Hash::make('aluno@2026');
    $aluno->role = 'student';
    $aluno->active = true;
    $aluno->save();
    echo "✅ Aluno (aluno.teste) -> Senha: aluno@2026 [OK]\n";
} else {
    \App\Models\User::create([
        'name' => 'Aluno Teste',
        'login' => 'aluno.teste',
        'email' => 'aluno@propom.com.br',
        'password' => \Hash::make('aluno@2026'),
        'role' => 'student',
        'active' => true
    ]);
    echo "✅ Aluno (aluno.teste) criado -> Senha: aluno@2026 [OK]\n";
}

echo "\nFIM\n";
