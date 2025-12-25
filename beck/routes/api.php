<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ExamController;

// Rotas públicas de autenticação
Route::post('/auth/login/admin', [AuthController::class, 'loginAdmin']);
Route::post('/auth/login/student', [AuthController::class, 'loginStudent']);

// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Students (apenas admin)
    Route::get('/students', [StudentController::class, 'index']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::patch('/students/{id}/toggle-status', [StudentController::class, 'toggleStatus']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);

    // Questions
    Route::get('/questions', [QuestionController::class, 'index']);
    Route::post('/questions', [QuestionController::class, 'store']);
    Route::put('/questions/{id}', [QuestionController::class, 'update']);
    Route::delete('/questions/{id}', [QuestionController::class, 'destroy']);

    // Exam
    Route::post('/exam/submit', [ExamController::class, 'submit']);
    Route::get('/exam/history', [ExamController::class, 'history']);
    Route::get('/exam/user-stats', [ExamController::class, 'userStats']);
    Route::get('/exam/stats', [ExamController::class, 'stats']);
});
