<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class Block7QuestionsSeeder extends Seeder
{
    public function run(): void
    {
        $text1 = "Os colegas da escola em que Marianna Santos, 12 anos, estuda adoram os trabalhos que ela faz na TV. E, como qualquer fã de um programa, eles não deixam passar uma oportunidade de descobrir em primeira mão o que vai acontecer nos próximos capítulos daquela história.
'Os alunos sempre querem spoiler e ficam com raiva, às vezes, pois eu nunca conto', brinca Marianna, que, como se vê, leva a profissão a sério.
Mari atualmente está no ar no streaming como a protagonista da série 'Luz', da Netflix. Na trama, Luz é uma menina órfã acolhida e criada desde bebê em uma comunidade kaingang. Quando completa 9 anos, ela descobre algo que vinha sendo mantido em segredo até então e resolve fugir.
Como brinca a personagem no trailer da série, todo mundo sabe que fugir de noite sozinha na floresta não é a melhor ideia do mundo, então Luz quase não consegue pôr seus planos em prática. Por sorte, ela é ajudada por um vagalume e consegue chegar a um internato, onde vai contar com novos amigos para descobrir sua verdadeira origem. Ela deu entrevista à Folhinha para contar como é ser uma atriz desde os 4 anos de idade (quando ela começou, ainda nem sabia ler!) e o que aprendeu de mais legal com esse novo trabalho.";

        $text2 = "Capítulo 01
No dia 14 de janeiro de 1862, os membros da Sociedade Real de Geografia de Londres compareceram em peso à sessão convocada pelo presidente. Num discurso interrompido várias vezes por aplausos dos honrados colegas, Sir Francis deu-lhes uma importante notícia, terminando a comunicação com frases entusiásticas de patriotismo:
- A Inglaterra sempre esteve à frente de todas as nações pela bravura de seus homens nas viagens de descobertas. O Dr. Samuel Fergusson, um dos seus ilustres filhos, manterá essa tradição. Se a tentativa desse homem, como todos nós esperamos, for coroada de sucesso, ela completará as noções esparsas que temos do continente africano. E, se fracassar, ficará na história como uma das mais ousadas concepções da genialidade humana!
- Viva! Viva! - gritou a assembleia, arrebatada pelas emocionantes palavras.
- Um viva para o corajoso Fergusson! - exclamou um dos membros mais expansivos do auditório.
Gritos de entusiasmo ecoaram por toda a sala.
A sessão ficou em polvorosa. Todos os audaciosos viajantes, que o espírito de aventura levara aos cinco continentes, estavam presentes, alguns já envelhecidos e cansados. A maioria deles, física ou moralmente, havia escapado de naufrágios, de incêndios, das machadinhas dos índios, dos ataques de selvagens, do tronco de tortura e dos estômagos dos antropófagos.
Por tudo o que já haviam passado não puderam controlar as aceleradas batidas do coração, tão comovidos ficaram com as palavras do orador. Aquele discurso ficou na memória de todos os membros da Sociedade Real de Geografia, de Londres.";

        $text3 = "Na amurada da escuna
Naquela noite avistamos terra logo após o anoitecer, e a escuna tomou aquela direção. Montgomery deu a entender que era para ali que se dirigia. Estávamos muito longe para poder vê-la em detalhe; a meus olhos, parecia apenas uma longa faixa azulada de encontro à tonalidade azul acinzentada do mar. Dali se elevava uma coluna quase vertical de fumaça que se dissipava no céu.
O capitão não estava no convés quando a avistamos. Depois de ter despejado sobre mim sua fúria ele havia descido aos tropeções, e ouvi alguém comentar que estava dormindo no chão da própria cabine. O imediato havia assumido o comando; era aquele indivíduo magro e taciturno que eu já vira à roda do leme. Aparentemente, também ele detestava Montgomery, e não dava o menor sinal de perceber nossa presença ali. Comemos todos juntos em um silêncio pesado, depois de algumas tentativas frustradas de minha parte para entabular conversação. Percebi que os homens daquele navio viam meu companheiro de viagem e seus animais de maneira estranhamente hostil. Percebi também que Montgomery era muito reticente quanto ao seu propósito no transporte das criaturas e sobre seu lugar de destino, e, embora curioso quanto a essas duas questões, abstive-me de fazer mais perguntas.
Depois do jantar, ficamos conversando no tombadilho até que o céu se cobriu de estrelas. Exceto por sons ocasionais vindos do castelo da proa, onde brilhava uma luz amarelada, e um ou outro movimento dos animais nas jaulas, tudo estava quieto. A onça estava encolhida, fitando-nos com olhos faiscantes, e era apenas um vulto escuro num canto da jaula. Os cães pareciam adormecidos.
Montgomery acendeu charutos para nós e pôs-se a falar sobre Londres num tom de reminiscência nostálgica, fazendo todo tipo de perguntas sobre as mudanças que teriam ocorrido lá. Falava como um homem que um dia amou a vida que teve num lugar, mas que se separou dele para sempre. Fiz comentários sobre este ou aquele aspecto, mas durante todo aquele tempo a estranheza do seu comportamento se infiltrava em minha mente, e enquanto falava eu observava seu rosto estranho e pálido à luz da lanterna pendurada às minhas costas. Depois olhei para o oceano escuro, em cujas sombras estava oculta a sua ilha.";

        $questions = [
            // PORTUGUÊS (1-20)
            [
                'subject' => 'portugues',
                'base_text' => $text1,
                'text' => 'Qual a profissão de Marianna Santos?',
                'options' => ['Estudante de medicina', 'Youtuber', 'Escritora', 'Cantora', 'Atriz'],
                'correct_answer' => 4,
                'rationale' => 'O texto afirma que ela é uma atriz desde os 4 anos de idade.',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'base_text' => $text1,
                'text' => 'Por que os colegas de Marianna ficam com raiva dela?',
                'options' => ['Porque ela não é uma boa atriz.', 'Porque ela não faz trabalhos na TV.', 'Porque ela não é fã de programas de TV.', 'Porque ela não estuda na mesma escola que eles.', 'Porque ela não conta spoilers da série "Luz".'],
                'correct_answer' => 4,
                'rationale' => 'O texto menciona: "Os alunos sempre querem spoiler e ficam com raiva, às vezes, pois eu nunca conto".',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'base_text' => $text1,
                'text' => 'Na frase "Luz quase não consegue pôr seus planos em prática", qual o objeto direto do verbo "pôr"?',
                'options' => ['Seus planos', 'Em prática', 'Quase', 'Consegue', 'Luz'],
                'correct_answer' => 0,
                'rationale' => '"Seus planos" é o complemento direto do verbo pôr (quem põe, põe algo).',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'base_text' => $text1,
                'text' => 'Na frase "Ela deu entrevista à Folhinha para contar como é ser uma atriz desde os 4 anos de idade", qual o objeto direto e o objeto indireto do verbo "dar" respectivamente?',
                'options' => ['atriz / como é ser uma atriz', 'como é ser uma atriz / Folhinha', 'entrevista / Folhinha', 'Folhinha / desde os 4 anos de idade', 'como é ser uma atriz / desde os 4 anos de idade'],
                'correct_answer' => 2,
                'rationale' => 'Quem dá, dá algo (entrevista - OD) a alguém (à Folhinha - OI).',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'text' => 'Assinale a alternativa que apresenta a pontuação adequada para o período: "Ele disse que não viria mas depois mudou de ideia."',
                'options' => ['Vírgula após "depois"', 'Vírgula após "disse".', 'Vírgula após "viria".', 'Vírgula após "mas".', 'Vírgula após "ideia".'],
                'correct_answer' => 2,
                'rationale' => 'Deve-se usar vírgula antes da conjunção adversativa "mas".',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'text' => 'De acordo com a gramática normativa da língua portuguesa, assinale a frase em que há concordância verbal incorreta:',
                'options' => ['Fazem cinco dias que ele não vem.', 'O menino gosta de futebol.', 'A casa é grande.', 'As meninas estudam muito.', 'Há somente sete alunos em sala de aula.'],
                'correct_answer' => 0,
                'rationale' => 'O verbo "fazer" indicando tempo decorrido é impessoal, devendo ficar no singular: "Faz cinco dias".',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'text' => 'Em "A casa azul era enorme", qual a função sintática do adjetivo "azul"?',
                'options' => ['Adjunto adverbial', 'Adjunto adnominal', 'Predicativo do sujeito', 'Complemento nominal', 'Agente da passiva'],
                'correct_answer' => 1,
                'rationale' => '"Azul" caracteriza o substantivo "casa" diretamente dentro do sujeito, sendo um adjunto adnominal.',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'text' => 'Assinale a frase que apresenta concordância nominal incorreta.',
                'options' => ['As meninas bonitas estavam na festa.', 'Os livros interessantes foram vendidos.', 'A água fresca é deliciosa.', 'Haviam muitas pessoas na fila.', 'As flores coloridas decoravam o ambiente.'],
                'correct_answer' => 3,
                'rationale' => 'A questão pede concordância nominal, mas a alternativa D apresenta erro de concordância verbal (verbo haver no plural). De acordo com o gabarito original, a resposta é D.',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'text' => 'No trecho "ela é ajudada por um vagalume", a expressão destacada exerce a função sintática de:',
                'options' => ['Objeto direto', 'Objeto indireto', 'Agente da passiva', 'Adjunto adverbial', 'Aposto'],
                'correct_answer' => 2,
                'rationale' => '"Por um vagalume" é quem realiza a ação na voz passiva (Agente da Passiva).',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'text' => 'Assinale a alternativa que contém um substantivo abstrato retirado do texto:',
                'options' => ['Escola', 'Marianna', 'Raiva', 'Vagalume', 'Internato'],
                'correct_answer' => 2,
                'rationale' => '"Raiva" nomeia um sentimento, sendo um substantivo abstrato.',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'base_text' => $text2,
                'text' => 'Qual o tema principal do discurso de Sir Francis?',
                'options' => ['A necessidade de explorar o continente africano.', 'A importância da Sociedade Real de Geografia de Londres.', 'A bravura dos homens ingleses nas viagens de descobertas.', 'A genialidade do Dr. Samuel Fergusson.', 'O patriotismo dos ingleses.'],
                'correct_answer' => 2,
                'rationale' => 'O discurso enfatiza que a Inglaterra sempre esteve à frente pela bravura de seus homens.',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'text' => 'Na frase "A menina leu o livro interessante", qual a função sintática das palavras "A menina" e "o livro interessante"?',
                'options' => ['Sujeito e complemento nominal', 'Sujeito e objeto direto', 'Adjunto adverbial e adjunto adnominal', 'Complemento nominal e objeto direto', 'Agente da passiva e objeto direto'],
                'correct_answer' => 1,
                'rationale' => '"A menina" pratica a ação (sujeito) e "o livro interessante" sofre a ação diretamente (objeto direto).',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'base_text' => $text2,
                'text' => 'Identifique o tempo verbal predominante no primeiro parágrafo do texto.',
                'options' => ['Presente do indicativo', 'Pretérito perfeito do indicativo', 'Pretérito imperfeito do indicativo', 'Futuro do presente', 'Futuro do pretérito'],
                'correct_answer' => 1,
                'rationale' => 'Verbos como "compareceram", "deu" e "ficou" estão no Pretérito Perfeito.',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'text' => 'Marque a alternativa que melhor explica o verbo "manterá" estar no futuro do presente na frase "O Dr. Samuel Fergusson, um dos seus ilustres filhos, manterá essa tradição."',
                'options' => ['Indica uma ação que ainda vai acontecer.', 'Indica uma ação que está acontecendo no momento da fala.', 'Indica uma ação que aconteceu no passado.', 'Indica uma ação que é habitual.', 'Indica uma ação que é desejada.'],
                'correct_answer' => 0,
                'rationale' => 'O futuro do presente indica um fato posterior ao momento da fala.',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'base_text' => $text3,
                'text' => 'Qual a primeira impressão do narrador sobre a terra avistada?',
                'options' => ['Uma ilha verdejante com rica fauna e flora.', 'Uma costa rochosa e árida.', 'Uma longa faixa azulada.', 'Uma cidade iluminada.', 'Uma floresta densa e impenetrável.'],
                'correct_answer' => 2,
                'rationale' => 'O texto diz: "parecia apenas uma longa faixa azulada de encontro à tonalidade azul acinzentada do mar".',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'base_text' => $text3,
                'text' => 'Qual o comportamento de Montgomery em relação ao narrador?',
                'options' => ['Amigável e receptivo.', 'Distante e hostil.', 'Curioso e intrometido.', 'Indiferente e apático.', 'Reservado e misterioso.'],
                'correct_answer' => 4,
                'rationale' => 'O texto descreve Montgomery como reticente sobre seus propósitos e destino, agindo com estranheza.',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'text' => 'Marque a alternativa que explica a razão pela qual o verbo "avistamos" está no pretérito perfeito do indicativo na frase "Naquela noite avistamos terra logo após o anoitecer."',
                'options' => ['Porque indica uma ação que ainda vai acontecer.', 'Porque indica uma ação que está acontecendo no momento da fala.', 'Porque indica uma ação que aconteceu no passado e foi concluída.', 'Porque indica uma ação que é habitual.', 'Porque indica uma ação que é desejada.'],
                'correct_answer' => 2,
                'rationale' => 'O pretérito perfeito indica um processo iniciado e concluído no passado.',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'text' => 'Assinale a alternativa que apresenta um antônimo para a palavra "audaciosos":',
                'options' => ['Corajosos', 'Destemidos', 'Medrosos', 'Valentes', 'Atrevidos'],
                'correct_answer' => 2,
                'rationale' => '"Medrosos" é o oposto de quem tem audácia.',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'text' => 'Na frase "Percebi que os homens daquele navio viam meu companheiro de viagem e seus animais de maneira estranhamente hostil", qual a função sintática do termo "de maneira estranhamente hostil"?',
                'options' => ['Adjunto adverbial de modo', 'Adjunto adverbial de lugar', 'Adjunto adverbial de tempo', 'Complemento nominal', 'Objeto direto'],
                'correct_answer' => 0,
                'rationale' => 'Indica o modo como os homens viam o companheiro.',
                'block' => 7
            ],
            [
                'subject' => 'portugues',
                'text' => 'No trecho "Montgomery acendeu charutos para nós e pôs-se a falar sobre Londres num tom de reminiscência nostálgica", qual a função dos termos destacados?',
                'options' => ['Descrever características do tom de voz de Montgomery.', 'Classificar o tom de voz de Montgomery em uma categoria específica.', 'Estabelecer uma comparação entre o tom de voz de Montgomery e outros tons.', 'Indicar definitivamente a opinião do narrador sobre o tom de voz de Montgomery.', 'Expressar a emoção do narrador ao ouvir o tom de voz de Montgomery.'],
                'correct_answer' => 0,
                'rationale' => 'Os termos qualificam e descrevem o tom de voz usado pelo personagem.',
                'block' => 7
            ],

            // MATEMÁTICA (21-40)
            [
                'subject' => 'matematica',
                'text' => 'Um navio de carga tem um total de 200 toneladas de carga. Ele já descarregou 80 toneladas e precisa descarregar o restante em 4 dias. Quantas toneladas ele precisa descarregar por dia?',
                'options' => ['30 toneladas.', '40 toneladas.', '50 toneladas.', '60 toneladas.', '70 toneladas.'],
                'correct_answer' => 0,
                'rationale' => 'Restante = 200 - 80 = 120 toneladas. Por dia = 120 / 4 = 30 toneladas.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um capitão de navio está planejando uma viagem. Ele sabe que seu navio consome 45,25 litros de combustível por hora de viagem. Se o tempo de navegação for de 1 dia e 16 horas, qual o volume mínimo de combustível, em metros cúbicos, é necessário para fazer essa viagem?',
                'options' => ['1,01 m³.', '1,21 m³.', '1,41 m³.', '1,61 m³.', '1,81 m³.'],
                'correct_answer' => 4,
                'rationale' => 'Tempo = 24 + 16 = 40 horas. Total = 40 * 45,25 = 1810 litros. 1810 L = 1,81 m³.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um navio partiu de um porto A e viajou a uma velocidade constante de 17,5 km/h em direção ao porto B, que está a 100 km de distância de A. Se o navio viajou por 4 horas, quantos quilômetros ele ainda precisa percorrer para chegar ao porto B?',
                'options' => ['20 km.', '30 km.', '40 km.', '50 km.', '60 km.'],
                'correct_answer' => 1,
                'rationale' => 'Distância percorrida = 17,5 * 4 = 70 km. Resta = 100 - 70 = 30 km.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um navio partiu de um porto A e navegou em direção ao porto B seguindo uma derrota (trajetória) de comprimento 200 milhas náuticas a uma velocidade constante de 10 milhas náuticas por hora. Após 16 horas de viagem, qual a distância que o navio ainda precisa percorrer para chegar ao porto B?',
                'options' => ['60 milhas náuticas.', '50 milhas náuticas.', '40 milhas náuticas.', '30 milhas náuticas.', '20 milhas náuticas.'],
                'correct_answer' => 2,
                'rationale' => 'Percorrido = 10 * 16 = 160 milhas. Resta = 200 - 160 = 40 milhas.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um navio transporta caixas de carga, cada uma pesando 150 kg. Se o peso total da carga é de 18 toneladas, quantas caixas de carga esse navio transporta?',
                'options' => ['90', '100', '110', '120', '130'],
                'correct_answer' => 3,
                'rationale' => '18 toneladas = 18.000 kg. Caixas = 18.000 / 150 = 120 caixas.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Se 3^x + 3^-x = 3 então 7 * (9^x + 9^-x) é igual a:',
                'options' => ['56', '49', '25', '21', '18'],
                'correct_answer' => 1,
                'rationale' => '(3^x + 3^-x)² = 9 -> 9^x + 2 + 9^-x = 9 -> 9^x + 9^-x = 7. Resultado = 7 * 7 = 49.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'A expressão (x² - 4) / (x - 2) é igual a:',
                'options' => ['x² + 4', 'x + 4', 'x + 2', 'x² + 2', 'x + 16'],
                'correct_answer' => 2,
                'rationale' => 'x² - 4 = (x - 2)(x + 2). Simplificando com (x - 2), resta x + 2.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Uma transversal intercepta duas paralelas formando ângulos alternos internos expressos em graus por (2x² + 9) e (3x² - 16). A soma das medidas desses ângulos é:',
                'options' => ['48°', '68°', '72°', '96°', '118°'],
                'correct_answer' => 4,
                'rationale' => 'Alternos internos são iguais: 2x² + 9 = 3x² - 16 -> x² = 25. Ângulo = 2(25)+9 = 59°. Soma = 59+59 = 118°.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um cais em formato de trapézio é utilizado para atracação de navios. Se a altura desse trapézio é de 8 metros e as bases medem, respectivamente, 5 metros e 12 metros, qual é a área total do cais?',
                'options' => ['68 m²', '81 m²', '100 m²', '128 m²', '136 m²'],
                'correct_answer' => 0,
                'image_url' => '/questions/block7_q29.png',
                'rationale' => 'Área = (B + b) * h / 2 = (12 + 5) * 8 / 2 = 17 * 4 = 68 m².',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Considerando os conjuntos numéricos, analise as sentenças a seguir e assinale V, se verdadeiras, ou F, se falsas.
( ) O produto de dois números irracionais é sempre um número irracional.
( ) Todo número racional é também um número natural, mas nem todo número natural é racional.
( ) A soma de dois números irracionais é sempre um número irracional.
( ) Os números irracionais são números que podem ser escritos em forma de fração e são sempre dízimas periódicas.
A ordem correta é:',
                'options' => ['V – F – F – F', 'F – F – F – F', 'F – F – F – V', 'F – F – V – V', 'V – V – V – V'],
                'correct_answer' => 1,
                'rationale' => 'Todas são falsas: Prod. Irracionais pode ser racional (√2*√2); Racionais nem sempre são naturais (0,5); Soma Irracionais pode ser racional (√2+(-√2)); Irracionais NÃO são frações.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Considerando os conjuntos numéricos, analise as sentenças a seguir e assinale V, se verdadeiras, ou F, se falsas.
( ) Todo número negativo é um número inteiro.
( ) Entre os números reais 3 e 4 existe apenas um número irracional.
( ) Todo número natural é um número real.
( ) A diferença entre dois números inteiros negativos é sempre um número inteiro negativo.
A ordem correta é:',
                'options' => ['V – F – F – F', 'F – F – F – F', 'F – V – F – V', 'F – F – V – F', 'V – V – V – V'],
                'correct_answer' => 3,
                'rationale' => 'Apenas a III é verdadeira. I (F): -1.5 é negativo e não inteiro; II (F): infinitos irracionais; IV (F): -1 - (-2) = 1.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Em um navio, uma escada de acesso forma um triângulo retângulo com o convés (piso) e a antepara (parede) do navio. Se a escada tem 5 metros de comprimento e 4 metros de altura em relação ao convés, qual é a distância da base da escada até a antepara do navio?',
                'options' => ['1,0 metro.', '1,5 metro.', '2,0 metros.', '2,5 metros.', '3,0 metros.'],
                'correct_answer' => 4,
                'rationale' => 'Pitágoras: 5² = 4² + d² -> 25 = 16 + d² -> d² = 9 -> d = 3 m.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um navio de cruzeiro possui uma piscina retangular em seu convés e deseja-se construir um deck ao redor dela. Se a piscina tem 12 metros de comprimento e 8 metros de largura, e a área total do deck é de 96 m², qual é a largura uniforme do deck?',
                'options' => ['2,0 metros.', '2,5 metros.', '3,0 metros.', '3,5 metros.', '4,0 metros.'],
                'correct_answer' => 0,
                'image_url' => '/questions/block7_q33.png',
                'rationale' => '(12+2x)(8+2x) - 12*8 = 96. Resolvendo: 4x² + 40x - 96 = 0 -> x² + 10x - 24 = 0 -> (x+12)(x-2)=0. x = 2 m.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Qual o perímetro do triângulo retângulo ABC da figura, sabendo que o segmento BC é igual a 5m e cos α = 3/5?',
                'options' => ['10 m', '12 m', '14 m', '16 m', '18 m'],
                'correct_answer' => 1,
                'image_url' => '/questions/block7_q34.png',
                'rationale' => 'AC = BC * cos α = 5 * 3/5 = 3m. AB² = 5² - 3² = 16 -> AB = 4m. Perímetro = 3 + 4 + 5 = 12 m.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Na equação (k + 1)x² - 5x + 3 = 0, uma das raízes é igual ao inverso da outra. Nessas condições, qual o valor de k?',
                'options' => ['k = 6', 'k = 5', 'k = 4', 'k = 3', 'k = 2'],
                'correct_answer' => 4,
                'rationale' => 'Produto das raízes = 1. c/a = 3/(k+1) = 1 -> k+1 = 3 -> k = 2.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Para reformar um navio em 90 dias, um estaleiro naval selecionou 24 de seus funcionários. Por motivos operacionais, apenas 20 funcionários puderam realizar esse trabalho. Quantos dias a mais esses trabalhadores levarão para finalizar essa reforma?',
                'options' => ['10 dias.', '12 dias.', '16 dias.', '18 dias.', '20 dias.'],
                'correct_answer' => 3,
                'rationale' => 'Regra de 3 inversa: 90 * 24 = x * 20 -> x = 108 dias. Dias a mais = 108 - 90 = 18 dias.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um engenheiro naval foi contratado para conduzir uma operação de manutenção em um navio. Sua equipe de 15 operários faria a manutenção em dez dias. O contratante precisa da manutenção pronta em seis dias. Quantos operários serão necessários?',
                'options' => ['20 operários.', '21 operários.', '22 operários.', '24 operários.', '25 operários.'],
                'correct_answer' => 4,
                'rationale' => 'Regra de 3 inversa: 15 * 10 = x * 6 -> x = 150 / 6 = 25 operários.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um navio comprou combustível com um aumento de 10% no preço em relação ao mês passado. No entanto, por uma promoção, conseguiu um desconto de 5% no valor total. Se o preço original era R$ 3.000,00, qual o preço a ser pago?',
                'options' => ['R$ 3.135,00', 'R$ 3.140,00', 'R$ 3.145,00', 'R$ 3.150,00', 'R$ 3.160,00'],
                'correct_answer' => 0,
                'rationale' => '3000 + 10% = 3300. 3300 - 5% = 3135. Resultado: R$ 3.135,00.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Uma importadora de produtos eletrônicos vende um smartphone com um lucro de 25%. Se o custo do smartphone foi de R$ 8.000, qual é o valor total da venda?',
                'options' => ['R$ 8.500,00', 'R$ 9.000,00', 'R$ 9.500,00', 'R$ 10.000,00', 'R$ 10.500,00'],
                'correct_answer' => 3,
                'rationale' => 'Venda = Custo + Lucro. Venda = 8000 + (0,25 * 8000) = 8000 + 2000 = R$ 10.000,00.',
                'block' => 7
            ],
            [
                'subject' => 'matematica',
                'text' => 'Um navio precisa carregar caixas cúbicas. Se a área da base de uma dessas caixas é de 2.500 dm², qual é o perímetro da base da caixa?',
                'options' => ['16 metros.', '20 metros.', '24 metros.', '28 metros.', '32 metros.'],
                'correct_answer' => 1,
                'rationale' => '2.500 dm² = 25 m². Lado² = 25 -> Lado = 5m. Perímetro = 4 * 5 = 20 metros.',
                'block' => 7
            ],
        ];

        foreach ($questions as $q) {
            Question::create([
                'subject' => $q['subject'],
                'base_text' => $q['base_text'] ?? null,
                'text' => $q['text'],
                'image_url' => $q['image_url'] ?? null,
                'options' => json_encode($q['options']),
                'correct_answer' => $q['correct_answer'],
                'rationale' => $q['rationale'],
                'block' => $q['block'],
                'is_demo' => false
            ]);
        }
    }
}
