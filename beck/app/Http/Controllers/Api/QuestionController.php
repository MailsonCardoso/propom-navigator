<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::query();

        if ($request->has('block')) {
            $query->where('block', $request->block);
        }

        $questions = $query->get()->map(function ($question) {
            return [
                'id' => $question->id,
                'block' => $question->block,
                'subject' => $question->subject,
                'text' => $question->text,
                'options' => $question->options,
                'hint' => $question->hint, // Enviamos a dica para o aluno
            ];
        });

        return response()->json($questions);
    }

    public function blocks()
    {
        $blocks = Question::select('block')
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
