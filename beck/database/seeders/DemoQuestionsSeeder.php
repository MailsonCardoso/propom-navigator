<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baseTextPort = "A vida a bordo exige disciplina, responsabilidade e respeito às normas estabelecidas. O cumprimento correto dos procedimentos garante a segurança da tripulação, preserva a embarcação e contribui para a eficiência das operações marítimas. Cada tripulante deve conhecer suas funções e agir com atenção, pois pequenas falhas podem resultar em grandes riscos.";

        $questions = [
            // PORTUGUES
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'Segundo o texto, o cumprimento das normas a bordo é importante porque:',
                'options' => ['Aumenta a autonomia dos tripulantes', 'Evita a necessidade de treinamento', 'Garante segurança e eficiência', 'Reduz a hierarquia naval'],
                'correct_answer' => 2,
                'rationale' => 'O texto afirma claramente que o cumprimento dos procedimentos garante a segurança da tripulação e contribui para a eficiência das operações, o que corresponde exatamente à alternativa c.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'portugues',
                'base_text' => $baseTextPort,
                'text' => 'De acordo com o texto, pequenas falhas podem:',
                'options' => ['Ser ignoradas', 'Não causar prejuízos', 'Resultar em grandes riscos', 'Melhorar o aprendizado'],
                'correct_answer' => 2,
                'rationale' => 'O texto afirma que “pequenas falhas podem resultar em grandes riscos”, deixando explícita a ideia da alternativa c.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'portugues',
                'text' => 'Na frase “A vida a bordo exige disciplina”, a palavra “disciplina” é:',
                'options' => ['Verbo', 'Adjetivo', 'Substantivo', 'Advérbio'],
                'correct_answer' => 2,
                'rationale' => '“Disciplina” nomeia uma ideia/qualidade abstrata, portanto é um substantivo.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'portugues',
                'text' => 'Assinale a alternativa que contém apenas adjetivos:',
                'options' => ['disciplina – normas – riscos', 'correta – marítimas – grandes', 'embarcação – tripulação – vida', 'exige – agir – conhecer'],
                'correct_answer' => 1,
                'rationale' => 'As palavras “correta”, “marítimas” e “grandes” caracterizam substantivos, logo são adjetivos.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'portugues',
                'text' => 'Na frase “Cada tripulante deve conhecer suas funções”, o sujeito é:',
                'options' => ['deve conhecer', 'suas funções', 'tripulante', 'cada tripulante'],
                'correct_answer' => 3,
                'rationale' => 'O núcleo do sujeito é “tripulante”, acompanhado do determinante “cada”. Logo, o sujeito é “cada tripulante”.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'portugues',
                'text' => 'Assinale a frase corretamente pontuada:',
                'options' => ['A vida a bordo exige disciplina responsabilidade e atenção.', 'A vida a bordo, exige disciplina, responsabilidade e atenção.', 'A vida a bordo exige disciplina, responsabilidade e atenção.', 'A vida, a bordo exige disciplina responsabilidade e atenção.'],
                'correct_answer' => 2,
                'rationale' => 'A vírgula é usada corretamente para separar elementos de uma enumeração: disciplina, responsabilidade e atenção.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'portugues',
                'text' => 'Assinale la forma correta:',
                'options' => ['idéia', 'heróico', 'vôo', 'risco'],
                'correct_answer' => 3,
                'rationale' => 'As palavras “idéia”, “heróico” e “vôo” perderam o acento pelo Novo Acordo. “Risco” já está corretamente escrita.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'portugues',
                'text' => 'A grafia correta é:',
                'options' => ['auto-estima', 'anti-social', 'micro-ondas', 'contra-regra'],
                'correct_answer' => 2,
                'rationale' => '“Micro-ondas” mantém o hífen por regra do Novo Acordo. As demais não utilizam mais hífen.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'portugues',
                'text' => 'O plural correto de “tripulante” é:',
                'options' => ['tripulantes', 'tripulãos', 'tripulães', 'tripulanteses'],
                'correct_answer' => 0,
                'rationale' => 'Substantivos terminados em -e formam o plural com -s: tripulante → tripulantes.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'portugues',
                'text' => 'Assinale a alternativa correta:',
                'options' => ['paes', 'ceus', 'céus', 'lapis'],
                'correct_answer' => 2,
                'rationale' => '“Céus” é oxítona terminada em ditongo aberto “éu”, devendo ser acentuada.',
                'block' => 0,
                'is_demo' => true
            ],
            // MATEMATICA
            [
                'subject' => 'matematica',
                'text' => 'O MMC entre 8 e 12 é:',
                'options' => ['12', '24', '36', '48'],
                'correct_answer' => 1,
                'rationale' => 'Múltiplos de 8: 8, 16, 24. Múltiplos de 12: 12, 24. O menor comum é 24.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'O MDC entre 18 e 30 é:',
                'options' => ['3', '6', '9', '18'],
                'correct_answer' => 1,
                'rationale' => 'Divisores comuns de 18 e 30: 1, 2, 3, 6. O maior é 6.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'Catetos: 6 m e 8 m. Hipotenusa:',
                'options' => ['10 m', '12 m', '14 m', '16 m'],
                'correct_answer' => 0,
                'rationale' => '6² + 8² = 36 + 64 = 100. √100 = 10',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'Área de um retângulo de base 10 m e altura 4 m:',
                'options' => ['14', '20', '40', '80'],
                'correct_answer' => 2,
                'rationale' => 'Área = base × altura = 10 × 4 = 40 m²',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => '2x + 4 = 20',
                'options' => ['6', '7', '8', '9'],
                'correct_answer' => 2,
                'rationale' => '2x = 16 → x = 8',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'x − 9 = 11',
                'options' => ['2', '11', '18', '20'],
                'correct_answer' => 2,
                'rationale' => 'x = 11 + 9 = 18',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'A razão entre 15 e 3 é:',
                'options' => ['3', '5', '12', '18'],
                'correct_answer' => 1,
                'rationale' => '15 ÷ 3 = 5',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => '5 horas → 50 questões. 8 horas → ?',
                'options' => ['70', '75', '80', '90'],
                'correct_answer' => 2,
                'rationale' => '50 ÷ 5 = 10 questões por hora. 10 × 8 = 80',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => '25% de 200 é:',
                'options' => ['25', '40', '50', '60'],
                'correct_answer' => 2,
                'rationale' => '25% = 0,25. 0,25 × 200 = 50',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'Probabilidade de sair número ímpar em um dado:',
                'options' => ['1/6', '1/3', '1/2', '2/3'],
                'correct_answer' => 2,
                'rationale' => 'Números ímpares: 1, 3, 5 → 3 resultados. Total: 6 → 3/6 = 1/2',
                'block' => 0,
                'is_demo' => true
            ],
        ];

        \App\Models\Question::where('is_demo', true)->delete();

        foreach ($questions as $q) {
            \App\Models\Question::create($q);
        }
    }
}
