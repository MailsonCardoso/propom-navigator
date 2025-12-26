<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

function applyProfessionalText($q)
{
    $text = $q->text;
    $subject = $q->subject;

    // Professionalization patterns
    if ($subject === 'matematica') {
        // Area/Geometry
        if (strpos($text, 'Raiz quadrada de') !== false || preg_match('/raiz/i', $text)) {
            $num = filter_var($text, FILTER_SANITIZE_NUMBER_INT);
            if (!$num)
                $num = 144;
            $q->text = "O convés de uma balsa mercante tem formato perfeitamente quadrado com área de {$num} m². Qual é a medida do lado deste convés em metros?";
            $q->rationale = "Lado = √{$num}.";
        }
        // Percentage
        elseif (strpos($text, '%') !== false || strpos($text, 'porcento') !== false) {
            preg_match('/(\d+)/', $text, $matches);
            $p = $matches[1] ?? 10;
            $q->text = "De um lote de 200 sinalizadores pirotécnicos, {$p}% apresentaram falhas no teste de ignição. Quantos sinalizadores deverão sofrer manutenção?";
            $q->rationale = "{$p}% de 200 = " . (200 * ($p / 100)) . ".";
        }
        // Rule of Three / Speed
        elseif (preg_match('/milhas|horas|nós/i', $text) || strpos($text, '/') !== false) {
            $q->text = "Um rebocador navegando a uma velocidade constante de 12 nós pretende chegar a um porto a 60 milhas de distância. Quanto tempo durará a navegação?";
            $q->options = ['4 horas', '5 horas', '6 horas', '7 horas'];
            $q->correct_answer = 1;
            $q->rationale = "Tempo = Distância / Velocidade = 60 / 12 = 5 horas.";
        }
        // Generic Math
        else {
            $q->text = "Durante o inventário de bordo, o mestre informou que o estoque de óleo lubrificante possui 500 litros. Se o consumo médio diário é de 25 litros, para quantos dias o estoque será suficiente?";
            $q->options = ['15 dias', '20 dias', '25 dias', '30 dias'];
            $q->correct_answer = 1;
            $q->rationale = "500 / 25 = 20 dias.";
        }
    }

    if ($subject === 'portugues' && (strlen($text) < 40 || strpos($text, '[Nova') !== false)) {
        $q->text = "Nas comunicações via rádio (VHF), a clareza gramatical é fundamental. Assinale a alternativa cuja concordância verbal obedece à norma culta da língua portuguesa:";
        $q->options = [
            'Seguem os documentos da embarcação para conferência.',
            'Segue os documentos da embarcação para conferência.',
            'Faziam cinco dias que o navio estava atracado.',
            'Haviam muitos suprimentos no armazém do cais.'
        ];
        $q->correct_answer = 0;
    }

    $q->save();
}

$targetBlocks = [4, 5];

foreach ($targetBlocks as $blockId) {
    echo "Limpando e Profissionalizando Bloco $blockId...\n";

    foreach (['portugues', 'matematica'] as $subject) {
        $questions = Question::where('block', $blockId)
            ->where('subject', $subject)
            ->get();

        $count = $questions->count();
        echo "   Subject: $subject | Found: $count\n";

        // 1. If more than 20, delete excess
        if ($count > 20) {
            $excess = $count - 20;
            echo "   - Removendo $excess questões excedentes...\n";
            $toDelete = $questions->slice(20);
            foreach ($toDelete as $dq) {
                $dq->delete();
            }
            $questions = $questions->slice(0, 20);
        }

        // 2. If less than 20, create (should not happen for math, but for coverage)
        if ($count < 20) {
            $needed = 20 - $count;
            echo "   - Criando $needed questões para completar 20...\n";
            for ($i = 0; $i < $needed; $i++) {
                $newQ = Question::create([
                    'block' => $blockId,
                    'subject' => $subject,
                    'text' => 'Temporary',
                    'options' => ['A', 'B', 'C', 'D'],
                    'correct_answer' => 0
                ]);
                applyProfessionalText($newQ);
            }
        }

        // 3. Professionalize all remaining 20
        $finalQuestions = Question::where('block', $blockId)
            ->where('subject', $subject)
            ->get();

        foreach ($finalQuestions as $fq) {
            applyProfessionalText($fq);
        }
    }
}

echo "Padronização concluída com sucesso!\n";
