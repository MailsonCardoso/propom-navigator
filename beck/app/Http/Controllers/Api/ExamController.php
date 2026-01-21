<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExamAttempt;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'block' => 'required|integer',
            'answers' => 'required|array', // Agora esperado: [ ['question_id' => 1, 'answer' => 2], ... ]
        ]);

        $score = 0;
        $detailedResults = [];
        $totalQuestions = count($request->answers);

        foreach ($request->answers as $submission) {
            $questionId = $submission['question_id'];
            $userAnswer = $submission['answer'];

            $question = Question::find($questionId);
            if (!$question)
                continue;

            $isCorrect = ($userAnswer !== null && $question->correct_answer == $userAnswer);

            if ($isCorrect) {
                $score++;
            }

            $detailedResults[] = [
                'question_id' => $question->id,
                'user_answer' => $userAnswer,
                'correct_answer' => $question->correct_answer,
                'is_correct' => $isCorrect,
                'rationale' => $question->rationale,
                'text' => $question->text,
                'base_text' => $question->base_text,
                'options' => $question->options,
            ];
        }

        $passed = $totalQuestions > 0 ? $score >= ($totalQuestions * 0.775) : false;

        $attempt = ExamAttempt::create([
            'user_id' => $request->user()->id,
            'block' => $request->block,
            'score' => $score,
            'total_questions' => $totalQuestions,
            'passed' => $passed,
            'answers' => $request->answers,
            'completed_at' => now(),
        ]);

        return response()->json([
            'attempt' => $attempt,
            'score' => $score,
            'total_questions' => $totalQuestions,
            'passed' => $passed,
            'results' => $detailedResults,
        ]);
    }

    public function history(Request $request)
    {
        $attempts = ExamAttempt::where('user_id', $request->user()->id)
            ->orderBy('completed_at', 'desc')
            ->get();

        return response()->json($attempts);
    }

    public function userStats(Request $request)
    {
        $userId = $request->user()->id;
        // Pega estatísticas gerais (rápido)
        $totalAttempts = ExamAttempt::where('user_id', $userId)->count();
        $passedAttempts = ExamAttempt::where('user_id', $userId)->where('passed', true)->count();
        $averageScore = ExamAttempt::where('user_id', $userId)->avg('score') ?? 0;
        $bestScore = ExamAttempt::where('user_id', $userId)->max('score') ?? 0;

        // Calcula desempenho por matéria baseado nas últimas 10 tentativas (para performance)
        $attempts = ExamAttempt::where('user_id', $userId)
            ->orderBy('completed_at', 'desc')
            ->take(10)
            ->get();

        $statsBySubject = [
            'portugues' => ['total' => 0, 'correct' => 0],
            'matematica' => ['total' => 0, 'correct' => 0],
        ];

        $statsByTopic = [];

        $answersMap = [];

        foreach ($attempts as $attempt) {
            $answers = $attempt->answers;
            if (is_array($answers)) {
                foreach ($answers as $ans) {
                    if (isset($ans['question_id'])) {
                        $answersMap[] = [
                            'q_id' => $ans['question_id'],
                            'user_ans' => $ans['answer']
                        ];
                    }
                }
            }
        }

        if (!empty($answersMap)) {
            $qIds = array_column($answersMap, 'q_id');
            $questions = Question::whereIn('id', array_unique($qIds))->get()->keyBy('id');

            foreach ($answersMap as $item) {
                $qId = $item['q_id'];
                $userAns = $item['user_ans'];

                if (isset($questions[$qId])) {
                    $q = $questions[$qId];
                    if (in_array($q->subject, ['portugues', 'matematica'])) {
                        $statsBySubject[$q->subject]['total']++;
                        if ($userAns !== null && $userAns == $q->correct_answer) {
                            $statsBySubject[$q->subject]['correct']++;
                        }
                    }

                    if ($q->topic) {
                        if (!isset($statsByTopic[$q->topic])) {
                            $statsByTopic[$q->topic] = [
                                'name' => $q->topic,
                                'subject' => $q->subject,
                                'total' => 0,
                                'correct' => 0
                            ];
                        }
                        $statsByTopic[$q->topic]['total']++;
                        if ($userAns !== null && $userAns == $q->correct_answer) {
                            $statsByTopic[$q->topic]['correct']++;
                        }
                    }
                }
            }
        }

        // Calcula porcentagens por assunto
        $portuguesPercent = $statsBySubject['portugues']['total'] > 0
            ? round(($statsBySubject['portugues']['correct'] / $statsBySubject['portugues']['total']) * 100)
            : 0;

        $matematicaPercent = $statsBySubject['matematica']['total'] > 0
            ? round(($statsBySubject['matematica']['correct'] / $statsBySubject['matematica']['total']) * 100)
            : 0;

        // Calcula porcentagens por tópico (assunto específico) e formata
        $topicsRanking = [];
        foreach ($statsByTopic as $topic) {
            $topic['performance'] = round(($topic['correct'] / $topic['total']) * 100);
            $topicsRanking[] = $topic;
        }

        // Ordena tópicos por performance (opcional, vamos deixar por ordem alfabética ou deixar p/ frontend)
        usort($topicsRanking, function ($a, $b) {
            return $b['performance'] <=> $a['performance'];
        });

        return response()->json([
            'total_attempts' => $totalAttempts,
            'passed_attempts' => $passedAttempts,
            'failed_attempts' => $totalAttempts - $passedAttempts,
            'average_score' => round($averageScore, 2),
            'best_score' => $bestScore,
            'subjects' => [
                'portugues' => $portuguesPercent,
                'matematica' => $matematicaPercent
            ],
            'topics' => $topicsRanking
        ]);
    }

    public function stats()
    {
        $totalAttempts = ExamAttempt::count();
        $passedAttempts = ExamAttempt::where('passed', true)->count();
        $averageScore = ExamAttempt::avg('score');

        return response()->json([
            'total_attempts' => $totalAttempts,
            'passed_attempts' => $passedAttempts,
            'average_score' => round($averageScore, 2),
        ]);
    }
    public function show($id, Request $request)
    {
        $attempt = ExamAttempt::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $detailedResults = [];
        $answers = collect($attempt->answers);

        // Se o formato for o novo (array de objetos com question_id)
        if ($answers->first() && is_array($answers->first()) && isset($answers->first()['question_id'])) {
            foreach ($answers as $submission) {
                $question = Question::find($submission['question_id']);
                if (!$question)
                    continue;

                $userAnswer = $submission['answer'];
                $isCorrect = ($userAnswer !== null && $question->correct_answer == $userAnswer);

                $detailedResults[] = [
                    'question_id' => $question->id,
                    'user_answer' => $userAnswer,
                    'correct_answer' => $question->correct_answer,
                    'is_correct' => $isCorrect,
                    'rationale' => $question->rationale,
                    'hint' => $question->hint,
                    'text' => $question->text,
                    'base_text' => $question->base_text,
                    'options' => $question->options
                ];
            }
        } else {
            // Formato antigo (array simples de índices) - Busca questões do bloco na ordem original
            $questions = Question::where('block', $attempt->block)->orderBy('id')->get();
            foreach ($questions as $index => $question) {
                $userAnswer = $attempt->answers[$index] ?? null;
                $isCorrect = ($userAnswer !== null && $question->correct_answer == $userAnswer);

                $detailedResults[] = [
                    'question_id' => $question->id,
                    'user_answer' => $userAnswer,
                    'correct_answer' => $question->correct_answer,
                    'is_correct' => $isCorrect,
                    'rationale' => $question->rationale,
                    'hint' => $question->hint,
                    'text' => $question->text,
                    'base_text' => $question->base_text,
                    'options' => $question->options
                ];
            }
        }

        return response()->json([
            'attempt' => $attempt,
            'results' => $detailedResults
        ]);
    }

    public function ranking()
    {
        // Ranking dos últimos 7 dias
        $sevenDaysAgo = now()->subDays(7);

        $ranking = ExamAttempt::with('user:id,name')
            ->where('completed_at', '>=', $sevenDaysAgo)
            ->select('user_id', \DB::raw('MAX(score) as best_score'), \DB::raw('COUNT(*) as attempts'))
            ->groupBy('user_id')
            ->orderBy('best_score', 'desc')
            ->take(10) // Limit to top 10
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->user->name ?? 'Usuário Removido',
                    'best_score' => $item->best_score,
                    'attempts' => $item->attempts,
                    'performance' => round(($item->best_score / 40) * 100, 1) . '%'
                ];
            });

        return response()->json($ranking);
    }

    public function errors(Request $request)
    {
        // Fetch attempts
        $attempts = ExamAttempt::where('user_id', $request->user()->id)
            ->orderBy('completed_at', 'desc')
            ->take(20) // Analyze last 20 exams to keep it fast
            ->get();

        $wrongQuestionIds = [];

        foreach ($attempts as $attempt) {
            $answers = $attempt->answers; // Automatically cast to array/collection by Model

            // Handle both legacy (simple array) and new format (array of objects)
            if (is_array($answers)) {
                foreach ($answers as $index => $answerData) {
                    // New format: ['question_id' => 1, 'answer' => 2]
                    if (isset($answerData['question_id'])) {
                        $qId = $answerData['question_id'];
                        $userAns = $answerData['answer'];

                        // We need to check correctness again or trust the attempt.
                        // Ideally ExamAttempt should save correctness, but for now let's query the question
                        // Wait, querying inside loop is bad.
                        // Better strategy: Collect all IDs, then fetch questions and compare.
                        $wrongQuestionIds[] = $qId;
                    }
                }
            }
        }

        // Simplify strategy: Just get the questions the user got WRONG. 
        // Since we don't store "is_correct" in the JSON efficiently for querying, 
        // we'll fetch questions and re-evaluate or use a smarter query if possible.
        // Given the constraints and current structure, let's just return ALL questions from attempts 
        // and let frontend verify correctness? NO, security.

        // Revised Strategy:
        // 1. Collect all Question IDs and User Answers from attempts
        // 2. Fetch Questions
        // 3. Filter Wrong Ones

        $candidateErrors = [];
        foreach ($attempts as $attempt) {
            $answers = $attempt->answers;
            if (is_array($answers)) {
                foreach ($answers as $ans) {
                    if (isset($ans['question_id'])) {
                        // Key by Question ID to avoid duplicates (show latest error only?)
                        // Or show all? Let's show unique questions user struggles with.
                        if (!isset($candidateErrors[$ans['question_id']])) {
                            $candidateErrors[$ans['question_id']] = $ans['answer'];
                        }
                    }
                }
            }
        }

        if (empty($candidateErrors)) {
            return response()->json([]);
        }

        $questions = Question::whereIn('id', array_keys($candidateErrors))->get();
        $finalErrors = [];

        foreach ($questions as $q) {
            $userAnswer = $candidateErrors[$q->id];
            if ($userAnswer !== null && $userAnswer != $q->correct_answer) {
                $finalErrors[] = [
                    'question' => $q,
                    'user_answer' => $userAnswer
                ];
            }
        }

        return response()->json(array_values($finalErrors));
    }

    public function adminStats()
    {
        $now = now();
        $yesterday = $now->copy()->subDay();
        $weekAgo = $now->copy()->subDays(7);

        // Engajamento Hoje: Alunos com tentativas nas últimas 24h
        $engagedUserIds = ExamAttempt::where('completed_at', '>=', $yesterday)
            ->distinct()
            ->pluck('user_id')
            ->toArray();

        $engagementCount = count($engagedUserIds);

        // Risco de Abandono: Alunos ATIVOS mas sem tentativas há 7+ dias
        // Pega todos os alunos ativos
        $activeUsers = \App\Models\User::where('role', 'student')
            ->where('active', true)
            ->get();

        // Para cada aluno ativo, verifica a última tentativa
        $atRiskUsers = [];
        foreach ($activeUsers as $user) {
            $lastAttempt = ExamAttempt::where('user_id', $user->id)
                ->orderBy('completed_at', 'desc')
                ->first();

            // Se nunca fez tentativa OU a última foi há mais de 7 dias
            if (!$lastAttempt || $lastAttempt->completed_at < $weekAgo) {
                $atRiskUsers[] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'cpf' => $user->cpf,
                    'last_activity' => $lastAttempt ? $lastAttempt->completed_at->format('d/m/Y H:i') : 'Nunca',
                    'days_inactive' => $lastAttempt
                        ? now()->diffInDays($lastAttempt->completed_at)
                        : 'Nunca ativo'
                ];
            }
        }

        // TOP 5 QUESTÕES MAIS ERRADAS
        // Pega todas as tentativas
        $allAttempts = ExamAttempt::all();
        $questionStats = [];

        foreach ($allAttempts as $attempt) {
            $questionIds = $attempt->question_ids;
            $userAnswers = $attempt->user_answers;

            if (!$questionIds || !$userAnswers)
                continue;

            foreach ($questionIds as $index => $questionId) {
                $userAnswer = $userAnswers[$index] ?? null;

                // Busca a questão para verificar resposta correta
                $question = Question::find($questionId);
                if (!$question)
                    continue;

                // Inicializa estatísticas desta questão se não existir
                if (!isset($questionStats[$questionId])) {
                    $questionStats[$questionId] = [
                        'question_id' => $questionId,
                        'text' => $question->text,
                        'subject' => $question->subject,
                        'block' => $question->block,
                        'total_attempts' => 0,
                        'wrong_count' => 0
                    ];
                }

                $questionStats[$questionId]['total_attempts']++;

                // Se errou ou não respondeu
                if ($userAnswer === null || $userAnswer != $question->correct_answer) {
                    $questionStats[$questionId]['wrong_count']++;
                }
            }
        }

        // Calcula taxa de erro e ordena
        $topWrongQuestions = [];
        foreach ($questionStats as $stat) {
            if ($stat['total_attempts'] >= 3) { // Mínimo de 3 tentativas para ser relevante
                $stat['error_rate'] = round(($stat['wrong_count'] / $stat['total_attempts']) * 100, 1);
                $topWrongQuestions[] = $stat;
            }
        }

        // Ordena por taxa de erro (maior primeiro)
        usort($topWrongQuestions, function ($a, $b) {
            return $b['error_rate'] <=> $a['error_rate'];
        });

        // Pega apenas os top 5
        $topWrongQuestions = array_slice($topWrongQuestions, 0, 5);

        return response()->json([
            'engagement_today' => $engagementCount,
            'at_risk_count' => count($atRiskUsers),
            'at_risk_students' => $atRiskUsers,
            'top_wrong_questions' => $topWrongQuestions
        ]);
    }
}
