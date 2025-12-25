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
            'answers' => 'required|array',
        ]);

        // Busca apenas as questões do bloco específico
        $questions = Question::where('block', $request->block)->get();
        $score = 0;
        $detailedResults = [];

        foreach ($questions as $index => $question) {
            $userAnswer = $request->answers[$index] ?? null;
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
                'options' => $question->options,
            ];
        }

        $totalQuestions = $questions->count();
        $passed = $score >= ($totalQuestions * 0.775); // Mantendo os ~31/40 (77.5%)

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

        // Busca as questões do bloco relativo à tentativa
        $questions = Question::where('block', $attempt->block)->get();
        $detailedResults = [];

        // Monta o gabarito comparando as respostas salvas com as corretas
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
                'options' => $question->options
            ];
        }

        return response()->json([
            'attempt' => $attempt,
            'results' => $detailedResults
        ]);
    }
}
