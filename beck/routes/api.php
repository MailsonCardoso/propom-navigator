<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\SecurityLogController;

// Rotas públicas
Route::post('/auth/login/admin', [AuthController::class, 'loginAdmin']);
Route::post('/auth/login/student', [AuthController::class, 'loginStudent']);
Route::get('/questions/demo', [QuestionController::class, 'demo']);

// Rotas protegidas
Route::middleware(['auth:sanctum', \App\Http\Middleware\PreventSimultaneousAccess::class])->group(function () {
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/change-password', [AuthController::class, 'changePassword']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Rotas de Aluno
    Route::get('/questions/blocks', [QuestionController::class, 'blocks']);
    Route::get('/questions', [QuestionController::class, 'index']);
    Route::post('/exam/submit', [ExamController::class, 'submit']);
    Route::get('/exam/history', [ExamController::class, 'history']);
    Route::get('/exam/attempt/{id}', [ExamController::class, 'show']);
    Route::get('/exam/user-stats', [ExamController::class, 'userStats']);

    // Admin (Somente administradores)
    Route::middleware('admin')->group(function () {
        // Students
        Route::get('/students', [StudentController::class, 'index']);
        Route::post('/students', [StudentController::class, 'store']);
        Route::patch('/students/{id}/toggle-status', [StudentController::class, 'toggleStatus']);
        Route::post('/students/{id}/reset-password', [StudentController::class, 'resetPassword']);
        Route::delete('/students/{id}', [StudentController::class, 'destroy']);

        // Management
        Route::post('/questions', [QuestionController::class, 'store']);
        Route::put('/questions/{id}', [QuestionController::class, 'update']);
        Route::delete('/questions/{id}', [QuestionController::class, 'destroy']);

        // Stats & Logs
        Route::get('/exam/stats', [ExamController::class, 'stats']);
        Route::get('/exam/ranking', [ExamController::class, 'ranking']);
        Route::get('/security-logs', [SecurityLogController::class, 'index']);
    });
});
