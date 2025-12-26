<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Question;

// Bloco 2: O Velho Farol
$text2 = "O Velho Farol\n\nO vigia subiu os degraus lentamente. O vento soprava forte lá fora, mas a lanterna do farol precisava de manutenção. Ele sabia que um erro ali poderia custar vidas no mar. Com as mãos calejadas, limpou a lente de cristal e sentiu um alívio quando a luz brilhou novamente sobre as ondas escuras.";
Question::where('block', 2)->where('subject', 'portugues')->update(['base_text' => $text2]);

// Bloco 3: A Travessia Noturna
$text3 = "A Travessia Noturna\n\nO rebocador cortava as águas calmas da baía sob um céu sem estrelas. O mestre, um homem de poucas palavras, mantinha os olhos fixos no radar. Sabia que a neblina era traiçoeira e que qualquer descuido no canal poderia causar uma colisão desastrosa.\n— Café, mestre? — perguntou o marinheiro de convés, estendendo uma caneca fumegante.\nEle recusou com um gesto. Naquele momento, o rádio chiou, trazendo uma mensagem cifrada da capitania. O mestre sentiu um aperto no peito; não era apenas o clima que estava pesado naquela noite, era a responsabilidade de conduzir a carga preciosa até o porto seguro. O silêncio só era quebrado pelo motor rítmico, que parecia pulsar como um coração de ferro.";
Question::where('block', 3)->where('subject', 'portugues')->update(['base_text' => $text3]);

// Bloco 4: O Canteiro de Obras
$text4 = "O Canteiro de Obras\n\nO mestre de obras chegou cedo ao canteiro. Sob o sol ainda pálido da manhã, ele revisou as plantas da fundação com rigor. Sabia que a estrutura de um edifício não perdoa erros de cálculo; uma falha na base comprometeria toda a segurança dos futuros moradores.\n— O cimento chegou? — perguntou ao ajudante, que descarregava as ferramentas.\nO rapaz assentiu silenciosamente. O trabalho ali era árduo, mas a precisão era a ferramenta mais importante. Ao final do dia, exausto, o mestre olhou para o alicerce pronto e sentiu que o dever fora cumprido. A construção era como um organismo vivo: cada tijolo precisava estar no lugar exato para que o todo fizesse sentido.";
Question::where('block', 4)->where('subject', 'portugues')->update(['base_text' => $text4]);

// Bloco 5: A Lição do Mestre
$text5 = "A Lição do Mestre\n\nO professor entrou na sala em silêncio. Sobre a mesa, colocou apenas um pote de vidro vazio e algumas pedras grandes. Os alunos observavam, curiosos, enquanto ele preenchia o recipiente com as pedras até a borda.\n— Está cheio? — perguntou ele. Todos disseram que sim.\nEntão, ele pegou um saco de pedregulhos menores e os despejou no pote. Eles se acomodaram nos espaços entre as pedras grandes. Ele repetiu a pergunta e os alunos, rindo, confirmaram novamente. Por fim, o mestre derramou areia, que preencheu cada fresta restante.\n— A vida é como este pote — explicou. — Se vocês colocarem a areia primeiro, não haverá espaço para as pedras grandes, que são as coisas que realmente importam. Saibam priorizar o que é essencial, antes que o tempo se esgote.";
Question::where('block', 5)->where('subject', 'portugues')->update(['base_text' => $text5]);

echo "Textos base aplicados a todas as 20 questões de Português dos Blocos 2, 3, 4 e 5! ⚓✅";
