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
            'answers' => 'required|array|size:40',
        ]);

        $questions = Question::all();
        $score = 0;

        foreach ($request->answers as $index => $answer) {
            if ($answer !== null && isset($questions[$index])) {
                if ($questions[$index]->correct_answer == $answer) {
                    $score++;
                }
            }
        }

        $passed = $score >= 31;

        $attempt = ExamAttempt::create([
            'user_id' => $request->user()->id,
            'score' => $score,
            'total_questions' => 40,
            'passed' => $passed,
            'answers' => $request->answers,
            'completed_at' => now(),
        ]);

        return response()->json([
            'attempt' => $attempt,
            'score' => $score,
            'passed' => $passed,
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
}
