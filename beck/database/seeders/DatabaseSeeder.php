<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar administrador
        \App\Models\User::create([
            'name' => 'Administrador',
            'login' => 'admin',
            'email' => 'admin@prepom.local',
            'password' => \Hash::make('admin123'),
            'role' => 'admin',
            'active' => true,
        ]);

        // Criar alguns alunos de teste
        \App\Models\User::create([
            'name' => 'João Silva',
            'login' => 'joao.silva',
            'email' => 'joao@prepom.local',
            'password' => \Hash::make('123456'),
            'role' => 'student',
            'active' => true,
        ]);

        \App\Models\User::create([
            'name' => 'Maria Santos',
            'login' => 'maria.santos',
            'email' => 'maria@prepom.local',
            'password' => \Hash::make('123456'),
            'role' => 'student',
            'active' => true,
        ]);

        // Criar 40 questões (20 português + 20 matemática)
        $portuguesQuestions = [
            [
                'subject' => 'portugues',
                'text' => 'Qual é o sujeito da oração: "Os alunos estudaram para a prova"?',
                'options' => ['Os alunos', 'estudaram', 'para a prova', 'Não há sujeito'],
                'correct_answer' => 0,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Assinale a alternativa que apresenta um verbo no modo imperativo:',
                'options' => ['Ele canta bem', 'Cante comigo', 'Cantarei amanhã', 'Cantava todos os dias'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Qual é o plural de "cidadão"?',
                'options' => ['cidadões', 'cidadães', 'cidadãos', 'cidadans'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Identifique a figura de linguagem: "A vida é uma caixinha de surpresas"',
                'options' => ['Metáfora', 'Metonímia', 'Hipérbole', 'Eufemismo'],
                'correct_answer' => 0,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Qual palavra está corretamente acentuada?',
                'options' => ['saúde', 'saude', 'sáude', 'saudê'],
                'correct_answer' => 0,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Em "Ele é muito inteligente", a palavra "muito" é:',
                'options' => ['Adjetivo', 'Advérbio', 'Substantivo', 'Pronome'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Qual frase está na voz passiva?',
                'options' => ['O professor corrigiu as provas', 'As provas foram corrigidas pelo professor', 'Corrigindo as provas', 'Ele corrige'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Assinale a opção com erro de concordância:',
                'options' => ['Fazem dois anos', 'Há dois anos', 'Existem dois anos', 'Completam-se dois anos'],
                'correct_answer' => 0,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Qual é o sinônimo de "efêmero"?',
                'options' => ['Eterno', 'Passageiro', 'Duradouro', 'Permanente'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Em "Comprei um livro de história", a preposição "de" indica:',
                'options' => ['Posse', 'Assunto', 'Origem', 'Finalidade'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Qual é o aumentativo de "casa"?',
                'options' => ['casinha', 'casarão', 'casita', 'casona'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Identifique o pronome relativo:',
                'options' => ['Este', 'Aquele', 'Que', 'Meu'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Qual frase apresenta um adjunto adverbial de tempo?',
                'options' => ['Ele mora em São Paulo', 'Chegou ontem', 'Falou com calma', 'Estudou muito'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Assinale a alternativa com dígrafo:',
                'options' => ['Sapo', 'Carro', 'Bola', 'Mesa'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Qual é o feminino de "réu"?',
                'options' => ['réa', 'ré', 'réia', 'réu'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Em "Ele ficou feliz", o verbo "ficar" é:',
                'options' => ['Transitivo direto', 'Transitivo indireto', 'De ligação', 'Intransitivo'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Qual palavra é um substantivo abstrato?',
                'options' => ['Cadeira', 'Amor', 'Casa', 'Livro'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Assinale a opção com erro de regência:',
                'options' => ['Assisti ao filme', 'Prefiro café do que chá', 'Obedeço às leis', 'Aspiro ao cargo'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Qual é o coletivo de "abelhas"?',
                'options' => ['Enxame', 'Cardume', 'Matilha', 'Rebanho'],
                'correct_answer' => 0,
            ],
            [
                'subject' => 'portugues',
                'text' => 'Em "Choveu muito ontem", o sujeito é:',
                'options' => ['Muito', 'Ontem', 'Inexistente (oração sem sujeito)', 'Indeterminado'],
                'correct_answer' => 2,
            ],
        ];

        $matematicaQuestions = [
            [
                'subject' => 'matematica',
                'text' => 'Quanto é 15% de 200?',
                'options' => ['20', '25', '30', '35'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Qual é a raiz quadrada de 144?',
                'options' => ['10', '11', '12', '13'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Se x + 5 = 12, qual é o valor de x?',
                'options' => ['5', '6', '7', '8'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Qual é o resultado de 8 × 7?',
                'options' => ['54', '56', '58', '60'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um triângulo equilátero tem quantos graus em cada ângulo?',
                'options' => ['45°', '60°', '90°', '120°'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Qual é o perímetro de um quadrado com lado de 5 cm?',
                'options' => ['15 cm', '20 cm', '25 cm', '30 cm'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Se 3x = 21, qual é o valor de x?',
                'options' => ['5', '6', '7', '8'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Qual é a área de um retângulo de 4 cm por 6 cm?',
                'options' => ['20 cm²', '22 cm²', '24 cm²', '26 cm²'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Quanto é 2³ (dois elevado ao cubo)?',
                'options' => ['6', '8', '9', '12'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Qual é o próximo número na sequência: 2, 4, 8, 16, ...?',
                'options' => ['20', '24', '28', '32'],
                'correct_answer' => 3,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Se um produto custa R$ 80 e tem 25% de desconto, qual é o preço final?',
                'options' => ['R$ 55', 'R$ 60', 'R$ 65', 'R$ 70'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Qual é o valor de π (pi) aproximadamente?',
                'options' => ['2,14', '3,14', '4,14', '5,14'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Quantos minutos há em 2,5 horas?',
                'options' => ['120', '130', '140', '150'],
                'correct_answer' => 3,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Se um carro percorre 60 km em 1 hora, quantos km percorre em 3,5 horas?',
                'options' => ['180 km', '200 km', '210 km', '220 km'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Qual é o MDC (Máximo Divisor Comum) de 12 e 18?',
                'options' => ['2', '3', '6', '9'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Quanto é 0,5 em fração?',
                'options' => ['1/4', '1/3', '1/2', '2/3'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Se um ângulo mede 45°, qual é o seu complemento?',
                'options' => ['35°', '45°', '55°', '135°'],
                'correct_answer' => 1,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Qual é o volume de um cubo com aresta de 3 cm?',
                'options' => ['9 cm³', '18 cm³', '27 cm³', '36 cm³'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Se 2x - 4 = 10, qual é o valor de x?',
                'options' => ['5', '6', '7', '8'],
                'correct_answer' => 2,
            ],
            [
                'subject' => 'matematica',
                'text' => 'Qual é a média aritmética de 10, 20 e 30?',
                'options' => ['15', '18', '20', '25'],
                'correct_answer' => 2,
            ],
        ];

        foreach ($portuguesQuestions as $question) {
            \App\Models\Question::create($question);
        }

        foreach ($matematicaQuestions as $question) {
            \App\Models\Question::create($question);
        }

        $this->call(Module08Seeder::class);
    }
}
