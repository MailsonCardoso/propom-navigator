<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

// Limpar o Bloco 2 para recomeçar
Question::where('block', 2)->delete();

$baseText = "O Velho Farol\n\nO vigia subiu os degraus lentamente. O vento soprava forte lá fora, mas a lanterna do farol precisava de manutenção. Ele sabia que um erro ali poderia custar vidas no mar. Com as mãos calejadas, limpou a lente de cristal e sentiu um alívio quando a luz brilhou novamente sobre as ondas escuras.";

$portugueseQuestions = [
    [
        'text' => 'No início do texto, o advérbio "lentamente" indica uma circunstância de:',
        'options' => ['Tempo', 'Modo', 'Intensidade', 'Lugar'],
        'correct_answer' => 1,
        'rationale' => 'Advérbios terminados em "-mente" geralmente indicam o modo como a ação (subir os degraus) foi realizada.',
        'hint' => 'Responde à pergunta: "De que maneira ele subiu?".',
        'base_text' => $baseText
    ],
    [
        'text' => 'A palavra "manutenção" é acentuada seguindo a mesma regra de:',
        'options' => ['Herói', 'Álbum', 'Atenção', 'Convém'],
        'correct_answer' => 3,
        'rationale' => '"Manutenção" e "Convém" recebem acento circunflexo ou agudo para marcar a tonicidade e, no caso de manutenção, a diferenciação de número/flexão em oxítonas terminadas em -em/-ens.',
        'hint' => 'Observe a posição da sílaba tônica (última).',
        'base_text' => $baseText
    ],
    [
        'text' => 'Qual o núcleo do sujeito na frase: "O vento soprava forte lá fora"?',
        'options' => ['Soprava', 'Forte', 'Vento', 'Fora'],
        'correct_answer' => 2,
        'rationale' => 'O núcleo do sujeito é o substantivo principal que realiza a ação, neste caso, "vento".',
        'hint' => 'Quem soprava forte?',
        'base_text' => $baseText
    ],
    [
        'text' => 'A conjunção "mas" no texto estabelece uma relação de:',
        'options' => ['Adição', 'Conclusão', 'Oposição', 'Explicação'],
        'correct_answer' => 2,
        'rationale' => '"Mas" é uma conjunção coordenativa adversativa, que liga ideias contrárias (o vento estava forte, PORÉM ele subiu assim mesmo).',
        'hint' => 'Tente trocar por "entretanto" ou "porém".',
        'base_text' => $baseText
    ],
    [
        'text' => 'Em "Ele sabia que um erro ali...", o termo destacado refere-se a:',
        'options' => ['Um lugar (o farol)', 'Um tempo (o passado)', 'Uma pessoa (o vigia)', 'Uma dúvida'],
        'correct_answer' => 0,
        'rationale' => '"Ali" é um advérbio de lugar que aponta para o local onde o vigia estava (o farol).',
        'hint' => 'Onde o erro poderia acontecer?',
        'base_text' => $baseText
    ],
    [
        'text' => 'Assinale a alternativa onde todas as palavras são oxítonas:',
        'options' => ['Café, cipó, caju.', 'Mesa, livro, caneta.', 'Lâmpada, médico, ônibus.', 'Janela, porta, teto.'],
        'correct_answer' => 0,
        'rationale' => 'Café, cipó e caju possuem a última sílaba como tônica.',
        'hint' => 'A última sílaba deve ser a mais forte.'
    ],
    [
        'text' => 'O plural da palavra "Capitão" é:',
        'options' => ['Capitãos', 'Capitões', 'Capitães', 'Capitãoses'],
        'correct_answer' => 2,
        'rationale' => 'Substantivos terminados em "-ão" podem fazer o plural em "-ões", como é o caso de capitães (embora capitões seja aceito em alguns registros, "capitães" é a forma padrão erudita). Nota: Na Marinha, usa-se Capitães.',
        'hint' => 'Segue o mesmo padrão de "pães".'
    ],
    [
        'text' => 'Na frase "O marinheiro é corajoso", o termo destacado é um:',
        'options' => ['Substantivo', 'Verbo', 'Adjetivo', 'Artigo'],
        'correct_answer' => 2,
        'rationale' => '"Corajoso" é uma característica ou qualidade atribuída ao marinheiro.',
        'hint' => 'Classe que qualifica o nome.'
    ],
    [
        'text' => 'Indique o tempo verbal de "limpou" e "sentiu" no texto:',
        'options' => ['Presente do Indicativo', 'Pretérito Perfeito do Indicativo', 'Futuro do Pretérito', 'Pretérito Imperfeito do Indicativo'],
        'correct_answer' => 1,
        'rationale' => 'Indicam ações concluídas no passado.',
        'hint' => 'Ações que já acabaram totalmente.'
    ],
    [
        'text' => 'Qual palavra abaixo está escrita CORRETAMENTE?',
        'options' => ['Excessão', 'Exceção', 'Esceção', 'Exsessão'],
        'correct_answer' => 1,
        'rationale' => 'A grafia correta da palavra é Exceção (com \'x\' e \'ç\').',
        'hint' => 'Lembre-se do radical latino "exceptio".'
    ],
    [
        'text' => 'O sinônimo da palavra "calejadas" (mãos calejadas) é:',
        'options' => ['Macias', 'Sensíveis', 'Endurecidas', 'Limpas'],
        'correct_answer' => 2,
        'rationale' => 'Mãos calejadas são mãos que possuem calos pelo trabalho braçal, logo, estão endurecidas.',
        'hint' => 'Resultado de esforço físico repetitivo.'
    ],
    [
        'text' => 'Assinale a alternativa que contém apenas substantivos femininos:',
        'options' => ['Mar, vento, barco.', 'Viagem, onda, tripulação.', 'Capitão, porto, peixe.', 'Sal, céu, sol.'],
        'correct_answer' => 1,
        'rationale' => 'A viagem, a onda, a tripulação. Todas admitem o artigo definido feminino.',
        'hint' => 'Tente colocar o artigo "A" antes das palavras.'
    ],
    [
        'text' => 'Em "O farol é alto", se passarmos para o superlativo absoluto sintético, teremos:',
        'options' => ['Muito alto', 'Altíssimo', 'Mais alto', 'Alto demais'],
        'correct_answer' => 1,
        'rationale' => 'O superlativo sintético utiliza sufixos como "-íssimo".',
        'hint' => 'É a forma reduzida (uma só palavra) para intensificar o adjetivo.'
    ],
    [
        'text' => 'Qual a função da vírgula em: "João, traga as cordas!"?',
        'options' => ['Isolar o vocativo', 'Separar o sujeito do verbo', 'Isolar um adjunto adverbial', 'Marcar uma omissão de verbo'],
        'correct_answer' => 0,
        'rationale' => '"João" é um chamamento (vocativo), por isso deve ser isolado por vírgula.',
        'hint' => 'Usada quando chamamos alguém.'
    ],
    [
        'text' => 'A palavra "balaústre" é acentuada por ser:',
        'options' => ['Uma oxítona terminada em \'e\'.', 'Um hiato onde o \'u\' tônico está sozinho na sílaba.', 'Uma proparoxítona.', 'Uma paroxítona terminada em \'e\'.'],
        'correct_answer' => 1,
        'rationale' => 'Regra do hiato: acentuam-se \'i\' e \'u\' tônicos quando formam hiato com a vogal anterior e estão sozinhos na sílaba (ou com \'s\').',
        'hint' => 'Ba-la-ús-tre. O \'u\' fica separado do \'a\'.'
    ],
    [
        'text' => 'Indique a frase com erro de concordância verbal:',
        'options' => ['Eles chegaram cedo.', 'Fazem dois anos que não navego.', 'Sobrou apenas uma vaga.', 'Nós fomos ao convés.'],
        'correct_answer' => 1,
        'rationale' => 'O verbo "fazer" indicando tempo decorrido é impessoal (fica sempre no singular): "Faz dois anos".',
        'hint' => 'Verbo de tempo não vai para o plural.'
    ],
    [
        'text' => 'O coletivo de "navios de guerra" é:',
        'options' => ['Frota', 'Armada', 'Cardume', 'Enxame'],
        'correct_answer' => 1,
        'rationale' => 'Armada é o coletivo específico para forças navais ou navios de guerra.',
        'hint' => 'Termo ligado às Forças Armadas no mar.'
    ],
    [
        'text' => 'Qual o antônimo de "fortuita" (ocorrida por acaso)?',
        'options' => ['Casual', 'Planejada', 'Rápida', 'Inesperada'],
        'correct_answer' => 1,
        'rationale' => 'Se algo é fortuito, ocorre ao acaso. O contrário é algo que foi planejado.',
        'hint' => 'Pense em algo que não foi por acidente.'
    ],
    [
        'text' => 'Na frase "O policial prendeu o suspeito", o termo "o suspeito" é:',
        'options' => ['Sujeito', 'Objeto Direto', 'Objeto Indireto', 'Predicativo'],
        'correct_answer' => 1,
        'rationale' => 'Quem prende, prende ALGUÉM. O complemento não exige preposição, sendo objeto direto.',
        'hint' => 'É o alvo da ação do verbo.'
    ],
    [
        'text' => 'A palavra "atropelado" deriva da palavra "atropelar". Esse processo de formação é:',
        'options' => ['Prefixação', 'Sufixação', 'Composição', 'Parassíntese'],
        'correct_answer' => 1,
        'rationale' => 'Adicionou-se o sufixo "-ado" ao radical do verbo.',
        'hint' => 'Mudança no final da palavra.'
    ]
];

$mathQuestions = [
    [
        'text' => 'Um marinheiro ganha R$ 2.400,00 por mês. Ele gasta 25% do seu salário com aluguel. Qual o valor pago no aluguel?',
        'options' => ['R$ 400,00', 'R$ 500,00', 'R$ 600,00', 'R$ 800,00'],
        'correct_answer' => 2,
        'rationale' => '25% = 1/4. Então, 2400 / 4 = 600.',
        'hint' => '25% é o mesmo que dividir o total por 4.'
    ],
    [
        'text' => 'Um navio parte de 10 em 10 dias e outro de 12 em 12 dias. Se saíram juntos hoje, daqui a quantos dias sairão juntos novamente?',
        'options' => ['22 dias', '40 dias', '60 dias', '120 dias'],
        'correct_answer' => 2,
        'rationale' => 'MMC(10, 12). 10 = 2 x 5; 12 = 2^2 x 3. MMC = 2^2 x 3 x 5 = 60.',
        'hint' => 'Calcule o Mínimo Múltiplo Comum.'
    ],
    [
        'text' => 'Qual a área de um convés retangular que mede 15 metros de comprimento por 6 metros de largura?',
        'options' => ['21 m²', '42 m²', '80 m²', '90 m²'],
        'correct_answer' => 3,
        'rationale' => 'Área = comprimento x largura. 15 x 6 = 90.',
        'hint' => 'Multiplique as duas dimensões.'
    ],
    [
        'text' => 'Um cabo de 120 metros deve ser cortado em 5 pedaços iguais. Qual o tamanho de cada pedaço?',
        'options' => ['20 metros', '22 metros', '24 metros', '25 metros'],
        'correct_answer' => 2,
        'rationale' => 'Divisão simples: 120 / 5 = 24.',
        'hint' => 'Divida o total pelo número de partes.'
    ],
    [
        'text' => 'Se 4 máquinas produzem 800 peças em um dia, quantas peças 7 máquinas produzirão?',
        'options' => ['1.200', '1.400', '1.600', '1.800'],
        'correct_answer' => 1,
        'rationale' => '1 máquina produz 800 / 4 = 200 peças. 7 máquinas: 200 x 7 = 1.400.',
        'hint' => 'Descubra a produção de uma máquina primeiro.'
    ],
    [
        'text' => 'O valor da expressão 2 + 3 x 5 - 4 é:',
        'options' => ['21', '13', '11', '9'],
        'correct_answer' => 1,
        'rationale' => 'Seguindo a ordem: multiplicação primeiro. 3 x 5 = 15. Então 2 + 15 - 4 = 13.',
        'hint' => 'Multiplicação e divisão vêm antes de soma e subtração.'
    ],
    [
        'text' => 'O perímetro de um quadrado de lado 8 cm é:',
        'options' => ['16 cm', '32 cm', '64 cm', '48 cm'],
        'correct_answer' => 1,
        'rationale' => 'Perímetro é a soma dos 4 lados. 8 x 4 = 32.',
        'hint' => 'Lado + Lado + Lado + Lado.'
    ],
    [
        'text' => 'Resolva a equação: 2x + 10 = 30. O valor de x é:',
        'options' => ['5', '10', '15', '20'],
        'correct_answer' => 1,
        'rationale' => '2x = 30 - 10 => 2x = 20 => x = 10.',
        'hint' => 'Isole o x passando o 10 subtraindo.'
    ],
    [
        'text' => 'Qual o resultado de 1/2 + 1/4?',
        'options' => ['2/6', '3/4', '1/6', '3/2'],
        'correct_answer' => 1,
        'rationale' => 'MMC(2, 4) = 4. (2+1)/4 = 3/4.',
        'hint' => 'Deixe os denominadores iguais antes de somar.'
    ],
    [
        'text' => 'Uma escada de 5 metros está encostada em uma parede. A base da escada está a 3 metros da parede. Qual a altura que a escada atinge na parede?',
        'options' => ['3 metros', '4 metros', '5 metros', '6 metros'],
        'correct_answer' => 1,
        'rationale' => 'Teorema de Pitágoras: 5^2 = 3^2 + h^2 => 25 = 9 + h^2 => h^2 = 16 => h = 4.',
        'hint' => 'Use a² = b² + c², onde 5 é a hipotenusa.'
    ],
    [
        'text' => 'Em um grupo de 40 pessoas, 25 gostam de peixe e 20 gostam de carne. Se 10 gostam dos dois, quantas pessoas não gostam de nenhum?',
        'options' => ['5', '10', '15', '2'],
        'correct_answer' => 0,
        'rationale' => 'Somente peixe: 25-10=15. Somente carne: 20-10=10. Total que gosta de algo: 15+10+10 = 35. Sobram 5 (40-35).',
        'hint' => 'Use o diagrama de Venn.'
    ],
    [
        'text' => 'Converta 2,5 km para metros:',
        'options' => ['250 m', '2.500 m', '25.000 m', '25 m'],
        'correct_answer' => 1,
        'rationale' => '1 km = 1.000 m. 2,5 x 1.000 = 2.500.',
        'hint' => 'Multiplique por mil.'
    ],
    [
        'text' => 'O triplo de um número somado a 5 é igual a 20. Que número é esse?',
        'options' => ['3', '4', '5', '6'],
        'correct_answer' => 2,
        'rationale' => '3x + 5 = 20 => 3x = 15 => x = 5.',
        'hint' => 'Monte a equação 3x + 5 = 20.'
    ],
    [
        'text' => 'Um tanque tem formato de cubo com lado 2m. Qual o volume em litros?',
        'options' => ['4.000 L', '8.000 L', '2.000 L', '6.000 L'],
        'correct_answer' => 1,
        'rationale' => 'Volume = 2 x 2 x 2 = 8 m³. Como 1 m³ = 1000 L, temos 8.000 L.',
        'hint' => 'Volume do cubo é lado ao cubo.'
    ],
    [
        'text' => 'Qual a soma dos ângulos internos de qualquer triângulo?',
        'options' => ['90°', '180°', '270°', '360°'],
        'correct_answer' => 1,
        'rationale' => 'É uma propriedade fundamental da geometria euclidiana plana.',
        'hint' => 'Metade de um círculo completo.'
    ],
    [
        'text' => 'Uma caixa contém 12 bolas vermelhas e 18 bolas azuis. Qual a razão entre vermelhas e o total?',
        'options' => ['2/3', '2/5', '3/5', '1/2'],
        'correct_answer' => 1,
        'rationale' => 'Total = 12+18=30. Razão = 12/30. Simplificando por 6: 2/5.',
        'hint' => 'Divida o número de vermelhas pela soma de todas.'
    ],
    [
        'text' => 'Qual o MDC entre 30 e 45?',
        'options' => ['5', '10', '15', '30'],
        'correct_answer' => 2,
        'rationale' => 'Divisores de 30: 1, 2, 3, 5, 6, 10, 15, 30. Divisores de 45: 1, 3, 5, 9, 15, 45. O maior é 15.',
        'hint' => 'É o maior número que divide ambos.'
    ],
    [
        'text' => 'O sucessor do dobro de 14 é:',
        'options' => ['28', '29', '30', '27'],
        'correct_answer' => 1,
        'rationale' => 'Dobro de 14 = 28. Sucessor de 28 = 29.',
        'hint' => 'Calcule o dobro primeiro e depois some 1.'
    ],
    [
        'text' => 'Se um ângulo mede 40°, qual o seu complemento?',
        'options' => ['40°', '50°', '60°', '140°'],
        'correct_answer' => 1,
        'rationale' => 'Ângulos complementares somam 90°. 90 - 40 = 50.',
        'hint' => 'Quanto falta para chegar em 90 graus?'
    ],
    [
        'text' => 'Uma balsa transporta 15 carros por viagem. Quantas viagens serão necessárias para levar 100 carros?',
        'options' => ['6', '6,6', '7', '8'],
        'correct_answer' => 2,
        'rationale' => '100 / 15 = 6,66... Como não existe meia viagem para completar o transporte, são necessárias 7 viagens.',
        'hint' => 'Arredonde para cima para não deixar nenhum carro para trás.'
    ]
];

foreach ($portugueseQuestions as $q) {
    Question::create(array_merge($q, ['block' => 2, 'subject' => 'portugues']));
}

foreach ($mathQuestions as $q) {
    Question::create(array_merge($q, ['block' => 2, 'subject' => 'matematica']));
}

echo "Bloco 2 reformulado com sucesso!\n";
