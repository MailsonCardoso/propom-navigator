<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

$analysis = [];

for ($b = 1; $b <= 5; $b++) {
    $analysis[$b] = [
        'portugues' => ['interpretacao' => 0, 'gramatica' => 0, 'sintaxe' => 0, 'ortografia' => 0, 'total' => 0],
        'matematica' => ['aritmetica' => 0, 'geometria' => 0, 'algebra' => 0, 'regra3' => 0, 'porcentagem' => 0, 'total' => 0]
    ];

    $questions = Question::where('block', $b)->get();

    foreach ($questions as $q) {
        $text = mb_strtolower($q->text . ' ' . ($q->rationale ?? ''));
        $subject = $q->subject;

        if ($subject === 'portugues') {
            $analysis[$b]['portugues']['total']++;
            if ($q->base_text)
                $analysis[$b]['portugues']['interpretacao']++;
            if (preg_match('/concordância|sujeito|vírgula|pontuação|verbo|oração|predicativo|vocativo|aposto/u', $text)) {
                $analysis[$b]['portugues']['sintaxe']++;
            }
            if (preg_match('/acentuada|ortografia|escrita|corretamente|grafia|plural|feminino|coletivo/u', $text)) {
                $analysis[$b]['portugues']['ortografia']++;
            }
            // Basic grammar is everything else
            $analysis[$b]['portugues']['gramatica']++;
        } else {
            $analysis[$b]['matematica']['total']++;
            if (preg_match('/mmc|mdc|divisores|múltiplos|triplo|dobro|sucessor/u', $text)) {
                $analysis[$b]['matematica']['aritmetica']++;
            }
            if (preg_match('/área|perímetro|triângulo|quadrado|retângulo|pitágoras|hipotenusa|cateto|m²|m³|volume|circular|raio|diâmetro|ângulo/u', $text)) {
                $analysis[$b]['matematica']['geometria']++;
            }
            if (preg_match('/equação|valor de x|valor de y|equação de 1º grau/u', $text)) {
                $analysis[$b]['matematica']['algebra']++;
            }
            if (preg_match('/regra de 3|proporcional/u', $text) || (strpos($text, 'se') !== false && strpos($text, 'quantas') !== false)) {
                $analysis[$b]['matematica']['regra3']++;
            }
            if (preg_match('/%|porcentagem|conjunto|diagrama|venn|gostam|probabilidade|razão/u', $text)) {
                $analysis[$b]['matematica']['porcentagem']++;
            }
        }
    }
}

header('Content-Type: text/plain');
foreach ($analysis as $b => $data) {
    echo "--- BLOCO $b ---\n";
    echo "PORTUGUÊS ({$data['portugues']['total']} questões):\n";
    echo "  - Interpretação: {$data['portugues']['interpretacao']}\n";
    echo "  - Sintaxe/Pontuação: {$data['portugues']['sintaxe']}\n";
    echo "  - Ortografia/Plural: {$data['portugues']['ortografia']}\n";
    echo "  - Gramática Geral: {$data['portugues']['gramatica']}\n";

    echo "MATEMÁTICA ({$data['matematica']['total']} questões):\n";
    echo "  - Aritmética (MMC/MDC): {$data['matematica']['aritmetica']}\n";
    echo "  - Geometria (Áreas/Pitágoras): {$data['matematica']['geometria']}\n";
    echo "  - Álgebra (Equações): {$data['matematica']['algebra']}\n";
    echo "  - Regra de Três/Proporção: {$data['matematica']['regra3']}\n";
    echo "  - Porcentagem/Conjuntos/Prob: {$data['matematica']['porcentagem']}\n\n";
}
