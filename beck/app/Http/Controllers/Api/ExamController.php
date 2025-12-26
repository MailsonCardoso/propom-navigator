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
        $attempts = ExamAttempt::where('user_id', $userId)->get();

        $totalAttempts = $attempts->count();
        $passedAttempts = $attempts->where('passed', true)->count();
        $averageScore = $attempts->avg('score') ?? 0;
        $bestScore = $attempts->max('score') ?? 0;

        return response()->json([
            'total_attempts' => $totalAttempts,
            'passed_attempts' => $passedAttempts,
            'failed_attempts' => $totalAttempts - $passedAttempts,
            'average_score' => round($averageScore, 2),
            'best_score' => $bestScore,
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
}
