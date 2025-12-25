<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Criar administrador
    $admin = \App\Models\User::create([
        'name' => 'Administrador',
        'login' => 'admin',
        'email' => 'admin@propom.local',
        'password' => \Hash::make('admin123'),
        'role' => 'admin',
        'active' => true,
    ]);

    echo "Admin criado com sucesso! ID: " . $admin->id . "\n";

    // Criar aluno de teste
    $student = \App\Models\User::create([
        'name' => 'João Silva',
        'login' => 'joao.silva',
        'email' => 'joao@propom.local',
        'password' => \Hash::make('123456'),
        'role' => 'student',
        'active' => true,
    ]);

    echo "Aluno criado com sucesso! ID: " . $student->id . "\n";

    // Criar uma questão de teste
    $question = \App\Models\Question::create([
        'subject' => 'portugues',
        'text' => 'Qual é o sujeito da oração: "Os alunos estudaram para a prova"?',
        'options' => ['Os alunos', 'estudaram', 'para a prova', 'Não há sujeito'],
        'correct_answer' => 0,
    ]);

    echo "Questão criada com sucesso! ID: " . $question->id . "\n";

} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n";
}
