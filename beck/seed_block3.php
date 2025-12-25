<?php

use App\Models\Question;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$block3 = [
    // LÍNGUA PORTUGUESA (81 a 100)
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Assinale a alternativa em que o substantivo está no grau DIMINUTIVO:',
        'options' => ['Navio', 'Barquinho', 'Prédio', 'Vidro'],
        'correct_answer' => 1,
        'rationale' => 'O sufixo "-inho" é formador do grau diminutivo na língua portuguesa.',
        'hint' => 'Indica algo de tamanho reduzido.'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Na frase "O mar estava muito agitado", a palavra "muito" é:',
        'options' => ['Um substantivo', 'Um adjetivo', 'Um advérbio de intensidade', 'Uma preposição'],
        'correct_answer' => 2,
        'rationale' => '"Muito" está intensificando a característica "agitado" (adjetivo).',
        'hint' => 'Indica a quantidade ou força de uma característica.'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Qual das palavras abaixo é uma PROPAROXÍTONA?',
        'options' => ['Bússola', 'Maré', 'Oceano', 'Anzol'],
        'correct_answer' => 0,
        'rationale' => 'Em "Bússola" (BÚS-so-la), a antepenúltima sílaba é a tônica. Todas as proparoxítonas são acentuadas.',
        'hint' => 'A terceira sílaba de trás para frente é a mais forte.'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'O coletivo de "peixes" é:',
        'options' => ['Manada', 'Cardume', 'Rebanho', 'Constelação'],
        'correct_answer' => 1,
        'rationale' => 'Cardume é o substantivo coletivo específico para um conjunto de peixes.',
        'hint' => 'Termo muito usado na pesca e biologia marinha.'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Assinale a frase que contém um pronome possessivo:',
        'options' => ['Aquele navio é grande.', 'Meu barco está pronto.', 'Quem chegou agora?', 'Eu vi o capitão.'],
        'correct_answer' => 1,
        'rationale' => '"Meu" indica posse em relação à 1ª pessoa do singular.',
        'hint' => 'Indica que algo pertence a alguém.'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Qual é o sinônimo de "auxílio"?',
        'options' => ['Abandono', 'Ajuda', 'Perigo', 'Distância'],
        'correct_answer' => 1,
        'rationale' => 'Auxiliar alguém é o mesmo que prestar ajuda.',
        'hint' => 'Quando você socorre alguém, você dá...'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'A palavra "anoitecer" é formada pelo processo de:',
        'options' => ['Prefixação', 'Sufixação', 'Parassíntese', 'Composição'],
        'correct_answer' => 2,
        'rationale' => 'Ocorre parassíntese quando um prefixo (a-) e um sufixo (-ecer) são adicionados simultaneamente ao radical (noit-).',
        'hint' => 'Se tirar o começo ou o fim, a palavra deixa de existir.'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Na frase "O marinheiro canta uma canção", qual o objeto direto?',
        'options' => ['O marinheiro', 'Canta', 'Uma canção', 'Não tem objeto'],
        'correct_answer' => 2,
        'rationale' => 'Quem canta, canta alguma coisa. "Uma canção" completa o sentido do verbo sem preposição.',
        'hint' => 'É o que está sendo cantado.'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Assinale a palavra escrita de forma INCORRETA:',
        'options' => ['Atrás', 'Atraz', 'Talvez', 'Capaz'],
        'correct_answer' => 1,
        'rationale' => '"Atrás" escreve-se com \'s\' e leva acento por ser oxítona terminada em \'as\'.',
        'hint' => 'Oposto de "na frente".'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'O plural de "Paiol" é:',
        'options' => ['Paiols', 'Paiois', 'Paióis', 'Paioles'],
        'correct_answer' => 2,
        'rationale' => 'Substantivos terminados em "-ol" fazem o plural em "-óis".',
        'hint' => 'Segue la regra de "anzol -> anzóis".'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Em "Ele feriu-se com o anzol", o pronome "se" indica uma ação:',
        'options' => ['Recíproca', 'Reflexiva', 'Passiva', 'Indeterminada'],
        'correct_answer' => 1,
        'rationale' => 'Ação reflexiva é aquela que o sujeito pratica e recebe a própria ação.',
        'hint' => 'Ele feriu a si mesmo.'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Qual a classe gramatical de "amanhã"?',
        'options' => ['Substantivo', 'Verbo', 'Advérbio de tempo', 'Adjetivo'],
        'correct_answer' => 2,
        'rationale' => 'Indica quando a ação ocorrerá.',
        'hint' => 'Indica tempo.'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Assinale a alternativa que apresenta um encontro consonantal:',
        'options' => ['Ilha', 'Prato', 'Carro', 'Pássaro'],
        'correct_answer' => 1,
        'rationale' => '"Prato" possui duas consoantes juntas (p+r) com sons distintos. (Ilha, carro e pássaro possuem dígrafos).',
        'hint' => 'Procure duas consoantes onde você ouve o som de ambas.'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'O feminino de "Herói" é:',
        'options' => ['Heroína', 'Heroisa', 'Mulher-herói', 'Herois'],
        'correct_answer' => 0,
        'rationale' => 'Forma feminina padrão para o substantivo herói.',
        'hint' => 'Termina em "-ína".'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Na frase "Espero que você SEJA feliz", o verbo destacado está no:',
        'options' => ['Presente do Indicativo', 'Presente do Subjuntivo', 'Imperativo', 'Pretérito Perfeito'],
        'correct_answer' => 1,
        'rationale' => 'O modo subjuntivo expressa desejo, dúvida ou possibilidade.',
        'hint' => 'Geralmente vem acompanhado da palavra "que".'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => '"O navio cargueiro é enorme". O antônimo de "enorme" é:',
        'options' => ['Grande', 'Gigante', 'Minúsculo', 'Largo'],
        'correct_answer' => 2,
        'rationale' => 'Minúsculo indica algo muito pequeno, o oposto de enorme.',
        'hint' => 'O contrário de algo muito grande.'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Qual pontuação deve ser usada para separar itens em uma lista?',
        'options' => ['Ponto final', 'Dois-pontos', 'Vírgula', 'Ponto de exclamação'],
        'correct_answer' => 2,
        'rationale' => 'A vírgula é usada para enumerar elementos.',
        'hint' => 'Usada em "comprei pão, leite, café e açúcar".'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'A palavra "marujo" é:',
        'options' => ['Primitiva', 'Derivada', 'Composta', 'Estrangeirismo'],
        'correct_answer' => 1,
        'rationale' => 'Deriva da palavra primitiva "mar".',
        'hint' => 'Vem da palavra "mar".'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Assinale a alternativa com um artigo indefinido:',
        'options' => ['O capitão', 'A rede', 'Umas ondas', 'Pelos mares'],
        'correct_answer' => 2,
        'rationale' => '"Um, uma, uns, umas" são artigos indefinidos.',
        'hint' => 'Refere-se a algo de forma vaga ou genérica.'
    ],
    [
        'block' => 3,
        'subject' => 'portugues',
        'text' => 'Na expressão "Cuidado, mar alto!", o termo "Cuidado" é:',
        'options' => ['Um advérbio', 'Um substantivo', 'Uma interjeição', 'Um verbo'],
        'correct_answer' => 2,
        'rationale' => 'Interjeições são palavras que expressam emoções ou apelos súbitos (alerta).',
        'hint' => 'Expressa uma advertência.'
    ],

    // MATEMÁTICA (101 a 120)
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Uma corda de 40 metros foi dividida em duas partes. Uma parte tem 15 metros. Quantos centímetros tem a outra parte?',
        'options' => ['25 cm', '250 cm', '2.500 cm', '25.000 cm'],
        'correct_answer' => 2,
        'rationale' => '40−15=25 metros. Para converter para centímetros, multiplica-se por 100 (25×100=2.500).',
        'hint' => 'Subtraia e depois converta metros para centímetros.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Qual o valor da expressão 10+20÷5?',
        'options' => ['6', '14', '16', '30'],
        'correct_answer' => 1,
        'rationale' => 'A divisão deve ser feita antes da soma. 20÷5=4. Então, 10+4=14.',
        'hint' => 'Divisão primeiro, soma depois.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Um ângulo reto mede 90°. Qual a medida de dois ângulos retos somados?',
        'options' => ['45°', '90°', '180°', '360°'],
        'correct_answer' => 2,
        'rationale' => '90+90=180. Um ângulo de 180° é chamado de ângulo raso.',
        'hint' => 'É a metade de uma volta completa.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Se 5 kg de peixe custam R$ 150,00, quanto custam 2 kg?',
        'options' => ['R$ 30,00', 'R$ 60,00', 'R$ 75,00', 'R$ 90,00'],
        'correct_answer' => 1,
        'rationale' => '1 kg custa 150/5=30. Logo, 2 kg custam 30×2=60.',
        'hint' => 'Descubra o preço de 1 kg primeiro.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'O que é um número primo?',
        'options' => ['Um número que é par.', 'Um número divisível apenas por 1 e por ele mesmo.', 'Um número que termina em 0 ou 5.', 'Um número que tem mais de 4 divisores.'],
        'correct_answer' => 1,
        'rationale' => 'Definição matemática de números primos (Ex: 2, 3, 5, 7, 11...).',
        'hint' => 'Ele só tem dois divisores.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Qual o perímetro de um retângulo de 10 cm de base e 4 cm de altura?',
        'options' => ['14 cm', '28 cm', '40 cm', '20 cm'],
        'correct_answer' => 1,
        'rationale' => 'Perímetro = 10+10+4+4=28 cm.',
        'hint' => 'Some todos os quatro lados do retângulo.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Um relógio marca 14h 45min. Quanto tempo falta para as 16h?',
        'options' => ['1h 15min', '1h 25min', '2h 15min', '55min'],
        'correct_answer' => 0,
        'rationale' => 'De 14h45 até 15h são 15 min. De 15h até 16h é 1h. Total: 1h 15min.',
        'hint' => 'Pense primeiro nos minutos para completar a hora cheia.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'O resultado de 3^4 (três elevado à quarta potência) é:',
        'options' => ['12', '27', '64', '81'],
        'correct_answer' => 3,
        'rationale' => '3×3×3×3=81.',
        'hint' => 'Multiplique o 3 por ele mesmo quatro vezes.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Em um mapa, 1 cm representa 50 km. Se a distância entre duas cidades no mapa é de 4 cm, qual a distância real?',
        'options' => ['100 km', '150 km', '200 km', '250 km'],
        'correct_answer' => 2,
        'rationale' => '4×50=200 km.',
        'hint' => 'Multiplique o valor do mapa pela escala.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'A fração 3/4 é equivalente a que porcentagem?',
        'options' => ['25%', '50%', '75%', '80%'],
        'correct_answer' => 2,
        'rationale' => '3÷4=0,75. Para porcentagem, multiplica por 100 (0,75×100=75%).',
        'hint' => 'Divida o numerador pelo denominador.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Qual o valor de y na proporção 2/5=10/y?',
        'options' => ['20', '25', '30', '50'],
        'correct_answer' => 1,
        'rationale' => 'Multiplicação cruzada: 2y=50⇒y=25.',
        'hint' => 'Multiplique em cruz e resolva.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Um triângulo que possui um ângulo de 120° é classificado como:',
        'options' => ['Acutângulo', 'Retângulo', 'Obtusângulo', 'Equilátero'],
        'correct_answer' => 2,
        'rationale' => 'Triângulos com um ângulo maior que 90° são obtusângulos.',
        'hint' => 'Observe se há um ângulo "aberto" (obtuso).'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Quantos lados tem um decágono?',
        'options' => ['8', '10', '12', '20'],
        'correct_answer' => 1,
        'rationale' => 'O prefixo "deca" significa dez.',
        'hint' => 'Lembra a palavra "década".'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Resolva: 4x−5=3x+10. Qual o valor de x?',
        'options' => ['5', '10', '15', '20'],
        'correct_answer' => 2,
        'rationale' => '4x−3x=10+5⇒x=15.',
        'hint' => 'Agrupe os x de um lado e os números do outro.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Um produto que custava R$ 200,00 está com 20% de desconto. Qual o valor do desconto?',
        'options' => ['R$ 20,00', 'R$ 40,00', 'R$ 160,00', 'R$ 180,00'],
        'correct_answer' => 1,
        'rationale' => '0,20×200=40.',
        'hint' => 'Calcule quanto é 20% do total.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Qual o volume de um paralelepípedo com 4m de comprimento, 3m de largura e 2m de altura?',
        'options' => ['9 m³', '12 m³', '24 m³', '48 m³'],
        'correct_answer' => 2,
        'rationale' => 'Volume = 4×3×2=24.',
        'hint' => 'Multiplique as três dimensões.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'A soma de dois números é 50 e a diferença entre eles é 10. Quais são esses números?',
        'options' => ['20 e 30', '25 e 25', '15 e 35', '40 e 10'],
        'correct_answer' => 0,
        'rationale' => '30+20=50 e 30−20=10.',
        'hint' => 'Teste as alternativas somando e subtraindo os pares.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Quantos graus tem um ângulo suplementar a um de 60°?',
        'options' => ['30°', '90°', '120°', '180°'],
        'correct_answer' => 2,
        'rationale' => 'Ângulos suplementares somam 180°. 180−60=120.',
        'hint' => 'Quanto falta para chegar em 180 graus?'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Qual a raiz quadrada de 400?',
        'options' => ['10', '20', '40', '200'],
        'correct_answer' => 1,
        'rationale' => '20×20=400.',
        'hint' => 'Pense na raiz de 4 e acrescente um zero.'
    ],
    [
        'block' => 3,
        'subject' => 'matematica',
        'text' => 'Um dado comum (6 faces) é lançado. Qual a probabilidade de sair o número 5?',
        'options' => ['1/5', '1/6', '5/6', '1/2'],
        'correct_answer' => 1,
        'rationale' => 'Existe apenas 1 face com o número 5 em um total de 6 faces.',
        'hint' => 'Número de resultados favoráveis sobre o total.'
    ],
];

foreach ($block3 as $q) {
    Question::create($q);
}

echo "Block 3 seeded successfully!\n";
