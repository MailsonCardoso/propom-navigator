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
                'text' => 'Segundo as regras vigentes de acentuação gráfica, assinale a palavra correta:',
                'options' => ['Idéia', 'Heróico', 'Vôo', 'Chapéu'],
                'correct_answer' => 3,
                'rationale' => '“Méier”, “Heroico” e “Ideia” perdem o acento nas paroxítonas. Oxítonas terminadas em ditongo aberto como “Chapéu”, “Céu” e “Troféu” mantêm o acento.',
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
                'text' => 'Durante a organização de um simulado, dois alarmes são programados: Um toca a cada 8 minutos e outro a cada 12 minutos. Após quantos minutos os dois alarmes tocarão juntos novamente?',
                'options' => ['12', '24', '36', '48'],
                'correct_answer' => 1,
                'rationale' => 'Calculamos o MMC para descobrir quando os eventos coincidem. Múltiplos de 8: 8, 16, 24. Múltiplos de 12: 12, 24. O primeiro tempo comum é 24 minutos.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um instrutor deseja dividir 18 apostilas de matemática e 30 apostilas de português em pacotes iguais, sem sobrar nenhuma apostila. Qual é o maior número de apostilas que cada pacote pode ter?',
                'options' => ['3', '6', '9', '18'],
                'correct_answer' => 1,
                'rationale' => 'Usamos o MDC para dividir em partes iguais. Divisores comuns de 18 e 30: 1, 2, 3, 6. O maior divisor comum é 6.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em um treinamento prático, uma escada é posicionada ligando o chão ao convés de uma embarcação. A base da escada está a 6 m da parede e a altura é de 8 m. Qual é o comprimento da escada?',
                'options' => ['10 m', '12 m', '14 m', '16 m'],
                'correct_answer' => 0,
                'rationale' => 'Aplicamos Pitágoras: 6² + 8² = 36 + 64 = 100. √100 = 10 m.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'Uma sala de provas tem formato retangular, com base de 10 m e altura de 4 m. Qual é a área total da sala?',
                'options' => ['14 m²', '20 m²', '40 m²', '80 m²'],
                'correct_answer' => 2,
                'rationale' => 'Área do retângulo = base × altura = 10 × 4 = 40 m².',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um candidato obteve um total de 20 pontos, que inclui 4 pontos extras. Sabendo que cada questão vale 2 pontos, quantas questões ele acertou? (Considere a equação 2x + 4 = 20)',
                'options' => ['6', '7', '8', '9'],
                'correct_answer' => 2,
                'rationale' => '2x = 20 − 4 → 2x = 16 → x = 8 questões.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um aluno iniciou o simulado com x pontos. Após perder 9 pontos, ficou com 11 pontos. Qual era sua pontuação inicial? (Considere x − 9 = 11)',
                'options' => ['2', '11', '18', '20'],
                'correct_answer' => 3,
                'rationale' => 'x = 11 + 9 → x = 20 pontos.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em um grupo de estudo, há 15 candidatos para 3 instrutores. Qual é a razão entre candidatos e instrutores?',
                'options' => ['3', '5', '12', '18'],
                'correct_answer' => 1,
                'rationale' => 'Razão = 15 ÷ 3 = 5 candidatos por instrutor.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um aluno resolve 50 questões em 5 horas. Mantendo o mesmo ritmo, quantas questões ele resolverá em 8 horas?',
                'options' => ['70', '75', '80', '90'],
                'correct_answer' => 2,
                'rationale' => '50 ÷ 5 = 10 questões por hora. 10 × 8 = 80 questões.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em um simulado com 200 candidatos, 25% foram aprovados. Quantos candidatos passaram?',
                'options' => ['25', '40', '50', '60'],
                'correct_answer' => 2,
                'rationale' => '25% = 0,25. 0,25 × 200 = 50 candidatos.',
                'block' => 0,
                'is_demo' => true
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em um exercício de lógica, um dado comum é lançado. Qual é a probabilidade de sair um número ímpar?',
                'options' => ['1/6', '1/3', '1/2', '2/3'],
                'correct_answer' => 2,
                'rationale' => 'Números ímpares no dado: 1, 3, 5 → 3 resultados. Total de possibilidades: 6. 3/6 = 1/2.',
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
