<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $block = $request->block;

        if (!$block) {
            return response()->json(['message' => 'Bloco não especificado'], 400);
        }

        // Busca e embaralha separadamente para manter 20 PT e depois 20 MAT (Embaralhamento Inteligente)
        $portugues = Question::where('block', $block)
            ->where('subject', 'portugues')
            ->inRandomOrder()
            ->get();

        $matematica = Question::where('block', $block)
            ->where('subject', 'matematica')
            ->inRandomOrder()
            ->get();

        $questions = $portugues->concat($matematica)->map(function ($question) {
            return [
                'id' => $question->id,
                'block' => $question->block,
                'subject' => $question->subject,
                'text' => $question->text,
                'base_text' => $question->base_text,
                'options' => $question->options,
                'hint' => $question->hint,
                'image_url' => $question->image_url,
            ];
        });

        return response()->json($questions);
    }

    public function demo()
    {
        // 5 de Português
        $portugues = Question::where('is_demo', true)
            ->where('subject', 'portugues')
            ->inRandomOrder()
            ->limit(5)
            ->get();

        // 5 de Matemática
        $matematica = Question::where('is_demo', true)
            ->where('subject', 'matematica')
            ->inRandomOrder()
            ->limit(5)
            ->get();

        // Junta e formata
        $questions = $portugues->concat($matematica)->map(function ($question) {
            return [
                'id' => $question->id,
                'subject' => $question->subject,
                'text' => $question->text,
                'base_text' => $question->base_text,
                'options' => $question->options,
                'correct_answer' => $question->correct_answer,
                'rationale' => $question->rationale,
                'image_url' => $question->image_url,
            ];
        });

        // REGISTRA ACESSO AO SIMULADO DEMO (IP TRACKER)
        try {
            \App\Models\AccessLog::create([
                'ip_address' => request()->ip(),
                'action' => 'VIEW_DEMO',
                'user_agent' => request()->header('User-Agent'),
                'details' => ['questions_count' => $questions->count()]
            ]);
        } catch (\Exception $e) {
            // Silencia erro de log para não bloquear o usuário
            \Log::error("Erro ao registrar access_log: " . $e->getMessage());
        }

        return response()->json($questions);
    }

    public function blocks()
    {
        $blocks = Question::select('block')
            ->where('block', '<>', 0)
            ->where('is_demo', false)
            ->distinct()
            ->orderBy('block')
            ->get()
            ->pluck('block');

        return response()->json($blocks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|in:portugues,matematica',
            'text' => 'required|string',
            'options' => 'required|array|size:4',
            'correct_answer' => 'required|integer|min:0|max:3',
            'rationale' => 'nullable|string',
            'base_text' => 'nullable|string',
            'is_demo' => 'boolean',
            'block' => 'integer',
            'image_url' => 'nullable|string',
        ]);

        $question = Question::create($request->all());

        return response()->json($question, 201);
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $request->validate([
            'subject' => 'sometimes|in:portugues,matematica',
            'text' => 'sometimes|string',
            'options' => 'sometimes|array|size:4',
            'correct_answer' => 'sometimes|integer|min:0|max:3',
            'rationale' => 'nullable|string',
            'base_text' => 'nullable|string',
            'is_demo' => 'boolean',
            'block' => 'integer',
            'image_url' => 'nullable|string',
        ]);

        $question->update($request->all());

        return response()->json($question);
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json(['message' => 'Questão removida com sucesso']);
    }
}
