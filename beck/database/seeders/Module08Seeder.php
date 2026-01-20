<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class Module08Seeder extends Seeder
{
    public function run(): void
    {
        $textVerne = "Capítulo 01\n\nNo dia 14 de janeiro de 1862, os membros da Sociedade Real de Geografia de Londres compareceram em peso à sessão convocada pelo presidente. Num discurso interrompido várias vezes por aplausos dos honrados colegas, Sir Francis deu lhes uma importante notícia, terminando a comunicação com frases entusiásticas de patriotismo:\n\n- A Inglaterra sempre esteve à frente de todas as nações pela bravura de seus homens nas viagens de descobertas. O Dr. Samuel Fergusson, um dos seus ilustres filhos, manterá essa tradição. Se a tentativa desse homem, como todos nós esperamos, for coroada de sucesso, ela completará as noções esparsas que temos do continente africano. E, se fracassar, ficará na história como uma das mais ousadas concepções da genialidade humana!\n\n- Viva! Viva! - gritou a assembleia, arrebatada pelas emocionantes palavras.\n\n- Um viva para o corajoso Fergusson! exclamou um dos membros mais expansivos do auditório. Gritos de entusiasmo ecoaram por toda a sala.\n\nA sessão ficou em polvorosa. Todos os audaciosos viajantes, que o espírito de aventura levara aos cinco continentes, estavam presentes, alguns já envelhecidos e cansados. A maioria deles, física ou moralmente, havia escapado de naufrágios, de incêndios, das machadinhas dos índios, dos tacapes de selvagens, do tronco de tortura e dos estômagos dos antropófagos.\n\nPor tudo o que já haviam passado não puderam controlar as aceleradas batidas do coração, tão comovidos ficaram com as palavras do orador. Aquele discurso ficou na memória de todos os membros da Sociedade Real de Geografia, de Londres. E, como na Inglaterra o entusiasmo não se limitava às palavras, foi posta em votação uma ajuda de custo, como encorajamento ao dr. Fergusson, ajuda esta que atingiu o valor de duas mil e quinhentas libras. A grandeza da soma mostrava-se proporcional à importância do projeto.\n\n(VERNE, Júlio. Cinco semanas num balão.)";

        $textWells = "Na amurada da escuna\n\nNaquela noite avistamos terra logo após o anoitecer, e a escuna tomou aquela direção. Montgomery deu a entender que era para ali que se dirigia. Estávamos muito longe para poder vê-la em detalhe; a meus olhos, parecia apenas uma longa faixa azulada de encontro à tonalidade azul acinzentada do mar. Dali se elevava uma coluna quase vertical de fumaça que se dissipava no céu.\n\nO capitão não estava no convés quando a avistamos. Depois de ter despejado sobre mim sua fúria ele havia descido aos tropeções, e ouvi alguém comentar que estava dormindo no chão da própria cabine. O imediato havia assumido o comando; era aquele indivíduo magro e taciturno que eu já vira à roda do leme. Aparentemente, também ele detestava Montgomery, e não dava o menor sinal de perceber nossa presença ali. Comemos todos juntos em um silêncio pesado, depois de algumas tentativas frustradas de minha parte para entabular conversação. Percebi que os homens daquele navio viam meu companheiro de viagem e seus animais de maneira estranhamente hostil. Percebi também que Montgomery era muito reticente quanto ao seu propósito no transporte das criaturas e sobre seu lugar de destino, e, embora curioso quanto a essas duas questões, abstive-me de fazer mais perguntas.\n\nDepois do jantar, ficamos conversando no tombadilho até que o céu se cobriu de estrelas. Exceto por sons ocasionais vindos do castelo da proa, onde brilhava uma luz amarelada, e um ou outro movimento dos animais nas jaulas, tudo estava quieto. A onça estava encolhida, fitando nos com olhos faiscantes, e era apenas um vulto escuro num canto da jaula. Os cães pareciam adormecidos.\n\nMontgomery acendeu charutos para nós e pôs se a falar sobre Londres num tom de reminiscência nostálgica, fazendo todo tipo de perguntas sobre as mudanças que teriam ocorrido lá. Falava como um homem que um dia amou a vida que teve num lugar mas que se separou dele para sempre. Fiz comentários sobre este ou aquele aspecto, mas durante todo aquele tempo a estranheza do seu comportamento se infiltrava em minha mente, e enquanto falava eu observava seu rosto estranho e pálido à luz da lanterna pendurada às minhas costas. Depois olhei para o oceano escuro, em cujas sombras estava oculta a sua ilha.\n\n(WELLS, H. G. A ilha do doutor Moreau.)";

        $questions = [
            // MATEMÁTICA - BLOCO 8
            [
                'subject' => 'matematica',
                'block' => 8,
                'text' => 'Um navio de carga tem um total de 200 toneladas de carga. Ele já descarregou 80 toneladas e precisa descarregar o restante em 4 dias. Quantas toneladas ele precisa descarregar por dia?',
                'options' => ['30 toneladas', '40 toneladas', '50 toneladas', '60 toneladas', '70 toneladas'],
                'correct_answer' => 0,
                'rationale' => '200 (total) - 80 (já descarregado) = 120 toneladas restantes. 120 / 4 dias = 30 toneladas por dia.',
            ],
            [
                'subject' => 'matematica',
                'block' => 8,
                'text' => 'Um capitão de navio está planejando uma viagem. Ele sabe que seu navio consome 45,25 litros de combustível por hora de viagem. Se o tempo de navegação for de 1 dia e 16 horas, qual o volume mínimo de combustível, em metros cúbicos, é necessário para fazer essa viagem?',
                'options' => ['1,01 m³', '1,21 m³', '1,41 m³', '1,61 m³', '1,81 m³'],
                'correct_answer' => 4,
                'rationale' => 'Tempo total: 1 dia (24h) + 16h = 40 horas. Consumo: 45,25 L * 40h = 1.810 Litros. Convertendo para m³: 1.810 / 1000 = 1,81 m³.',
            ],
            [
                'subject' => 'matematica',
                'block' => 8,
                'text' => 'Um navio partiu de um porto A e viajou a uma velocidade constante de 17,5 km/h em direção ao porto B, que está a 100 km de distância de A. Se o navio viajou por 4 horas, quantos quilômetros ele ainda precisa percorrer para chegar ao porto B?',
                'options' => ['20 km', '30 km', '40 km', '50 km', '60 km'],
                'correct_answer' => 1,
                'rationale' => 'Distância percorrida: 17,5 km/h * 4h = 70 km. Restante: 100 km - 70 km = 30 km.',
            ],
            [
                'subject' => 'matematica',
                'block' => 8,
                'text' => 'Um navio partiu de um porto A e navegou em direção ao porto B seguindo uma derrota (trajetória) de comprimento 200 milhas náuticas a uma velocidade constante de 10 milhas náuticas por hora. Após 16 horas de viagem, qual a distância que o navio ainda precisa percorrer para chegar ao porto B?',
                'options' => ['60 milhas náuticas', '50 milhas náuticas', '40 milhas náuticas', '30 milhas náuticas', '20 milhas náuticas'],
                'correct_answer' => 2,
                'rationale' => 'Distância percorrida: 10 mn/h * 16h = 160 milhas. Distância restante: 200 - 160 = 40 milhas náuticas.',
            ],
            [
                'subject' => 'matematica',
                'block' => 8,
                'text' => 'Um navio transporta caixas de carga, cada uma pesando 150 kg. Se o peso total da carga é de 18 toneladas, quantas caixas de carga esse navio transporta?',
                'options' => ['90', '100', '110', '120', '130'],
                'correct_answer' => 3,
                'rationale' => '18 toneladas = 18.000 kg. Quantidade de caixas: 18.000 / 150 = 120 caixas.',
            ],
            [
                'subject' => 'matematica',
                'block' => 8,
                'text' => 'Se 3^x + 3^-x = 3 então 7 * (9^x + 9^-x) é igual a:',
                'options' => ['56', '49', '25', '21', '18'],
                'correct_answer' => 1,
                'rationale' => 'Elevando ao quadrado: (3^x + 3^-x)² = 3² -> 9^x + 2 + 9^-x = 9 -> 9^x + 9^-x = 7. Multiplicando por 7: 7 * 7 = 49.',
            ],
            [
                'subject' => 'matematica',
                'block' => 8,
                'text' => 'A expressão (x² - 4) / (x - 2) é igual a:',
                'options' => ['x² + 4', 'x + 4', 'x + 2', 'x² + 25', 'x + 16'],
                'correct_answer' => 2,
                'rationale' => 'Diferença de quadrados: (x² - 4) = (x - 2)(x + 2). Simplificando por (x - 2), obtemos x + 2.',
            ],
            [
                'subject' => 'matematica',
                'block' => 8,
                'text' => 'Dois ângulos são alternos internos e expressos por (2x² + 9)° e (3x² - 16)°. Sabendo que ângulos alternos internos são iguais, qual a soma dessas medidas?',
                'options' => ['48°', '68°', '72°', '96°', '118°'],
                'correct_answer' => 4,
                'rationale' => '2x² + 9 = 3x² - 16 -> x² = 25. Cada ângulo mede: 2(25) + 9 = 59°. A soma é 59 + 59 = 118°.',
            ],
            [
                'subject' => 'matematica',
                'block' => 8,
                'text' => 'Um cais em formato de trapézio é utilizado para atracação de navios. Se a altura desse trapézio é de 8 metros e as bases medem, respectivamente, 5 metros e 12 metros, qual é a área total do cais?',
                'options' => ['68 m²', '81 m²', '100 m²', '128 m²', '136 m²'],
                'correct_answer' => 0,
                'rationale' => 'Área = (Base Maior + Base Menor) * Altura / 2 = (12 + 5) * 8 / 2 = 17 * 4 = 68 m².',
            ],
            [
                'subject' => 'matematica',
                'block' => 8,
                'text' => 'Sobre conjuntos numéricos, analise:\nI. O produto de dois números irracionais é sempre irracional.\nII. Todo número racional é natural.\nIII. A soma de dois irracionais é sempre irracional.\nIV. Irracionais podem ser escritos como fração.\nA pontuação correta (V/F) é:',
                'options' => ['V - F - F - F', 'F - F - F - F', 'F - F - F - V', 'F - F - V - V', 'V - V - V - V'],
                'correct_answer' => 1,
                'rationale' => 'I: Falso (ex: √2 * √2 = 2). II: Falso (ex: 1/2 não é natural). III: Falso (ex: √2 + (-√2) = 0). IV: Falso (esta é a definição de Racional).',
            ],

            // PORTUGUÊS - BLOCO 8
            [
                'subject' => 'portugues',
                'block' => 8,
                'base_text' => $textVerne,
                'text' => 'Qual o tema principal do discurso de Sir Francis?',
                'options' => ['A necessidade de explorar a África', 'A importância da Sociedade Real', 'A bravura dos homens ingleses', 'A genialidade do Dr. Fergusson', 'O patriotismo dos ingleses'],
                'correct_answer' => 2,
                'rationale' => 'O discurso enfatiza que "A Inglaterra sempre esteve à frente... pela bravura de seus homens", usando Fergusson como exemplo dessa tradição.',
            ],
            [
                'subject' => 'portugues',
                'block' => 8,
                'base_text' => "A menina leu o livro interessante",
                'text' => 'Na frase "A menina leu o livro interessante", qual a função sintática das palavras "A menina" e "o livro interessante"?',
                'options' => ['Sujeito e complemento nominal', 'Sujeito e objeto direto', 'Adjunto adverbial e adjunto adnominal', 'Complemento nominal e objeto direto', 'Agente da passiva e objeto direto'],
                'correct_answer' => 1,
                'rationale' => '"A menina" realiza a ação (Sujeito) e "o livro interessante" sofre a ação de ser lido (Objeto Direto).',
            ],
            [
                'subject' => 'portugues',
                'block' => 8,
                'base_text' => $textVerne,
                'text' => 'Identifique o tempo verbal predominante no primeiro parágrafo do texto.',
                'options' => ['Presente do indicativo', 'Pretérito perfeito do indicativo', 'Pretérito imperfeito do indicativo', 'Futuro do presente', 'Futuro do pretérito'],
                'correct_answer' => 1,
                'rationale' => 'Verbos como "compareceram", "deu" e "exclamou" indicam ações concluídas no passado (Pretérito Perfeito).',
            ],
            [
                'subject' => 'portugues',
                'block' => 8,
                'base_text' => $textVerne,
                'text' => 'Marque a alternativa que melhor explica o verbo “manterá” está no futuro do presente.',
                'options' => ['Indica uma ação que ainda vai acontecer', 'Indica uma ação que está acontecendo agora', 'Indica uma ação que aconteceu no passado', 'Indica uma ação que é habitual', 'Indica uma ação que é desejada'],
                'correct_answer' => 0,
                'rationale' => 'O futuro do presente é utilizado para expressar ações que ocorrerão após o momento da fala.',
            ],
            [
                'subject' => 'portugues',
                'block' => 8,
                'base_text' => $textWells,
                'text' => 'Qual a primeira impressão do narrador sobre a terra avistada?',
                'options' => ['Uma ilha verdejante', 'Uma costa rochosa', 'Uma longa faixa azulada', 'Uma cidade iluminada', 'Uma floresta densa'],
                'correct_answer' => 2,
                'rationale' => 'O texto diz: "a meus olhos, parecia apenas uma longa faixa azulada de encontro à tonalidade azul acinzentada do mar".',
            ],
            [
                'subject' => 'portugues',
                'block' => 8,
                'base_text' => $textWells,
                'text' => 'Qual o comportamento de Montgomery em relação ao narrador e sua missão?',
                'options' => ['Amigável e receptivo', 'Distante e hostil', 'Curioso e intrometido', 'Indiferente e apático', 'Reservado e misterioso'],
                'correct_answer' => 4,
                'rationale' => 'O narrador descreve Montgomery como "muito reticente quanto ao seu propósito" e dotado de uma estranheza de comportamento.',
            ],
            [
                'subject' => 'portugues',
                'block' => 8,
                'base_text' => $textWells,
                'text' => 'Por que o verbo “avistamos” está no pretérito perfeito na frase “Naquela noite avistamos terra”? ',
                'options' => ['Indica ação futura', 'Indica ação acontecendo agora', 'Indica ação concluída no passado', 'Indica ação habitual', 'Indica ação desejada'],
                'correct_answer' => 2,
                'rationale' => 'O pretérito perfeito indica um fato pontual e totalmente finalizado antes do momento da narração.',
            ],
            [
                'subject' => 'portugues',
                'block' => 8,
                'base_text' => $textWells,
                'text' => 'Identifique o tempo verbal predominante no segundo parágrafo do texto.',
                'options' => ['Presente e futuro', 'Pretérito perfeito e subjuntivo', 'Pretérito imperfeito e mais-que-perfeito', 'Futuro do presente', 'Futuro do pretérito'],
                'correct_answer' => 2,
                'rationale' => 'Verbos como "estava", "havia descido", "detestava" e "viam" marcam os tempos pretéritos imperfeito e mais-que-perfeito.',
            ],
            [
                'subject' => 'portugues',
                'block' => 8,
                'base_text' => $textWells,
                'text' => 'Na frase “Percebi que os homens... viam... de maneira estranhamente hostil”, qual a função sintática do termo em destaque?',
                'options' => ['Adjunto adverbial de modo', 'Adjunto adverbial de lugar', 'Adjunto adverbial de tempo', 'Complemento nominal', 'Objeto direto'],
                'correct_answer' => 0,
                'rationale' => '"De maneira estranhamente hostil" indica o modo como os homens viam o companheiro; logo, adjunto adverbial de modo.',
            ],
            [
                'subject' => 'portugues',
                'block' => 8,
                'base_text' => $textWells,
                'text' => 'No trecho “...num tom de reminiscência nostálgica”, qual a função dos termos destacados?',
                'options' => ['Descrever o tom de voz', 'Classificar em categoria', 'Estabelecer comparação', 'Indicar opinião definitiva', 'Expressar emoção do narrador'],
                'correct_answer' => 0,
                'rationale' => 'Os termos servem como caracterizadores (adjetivação) para descrever a qualidade e a característica do tom de fala.',
            ],
        ];

        foreach ($questions as $q) {
            Question::create($q);
        }
    }
}
