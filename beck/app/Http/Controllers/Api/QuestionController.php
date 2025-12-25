<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all()->map(function ($question) {
            // Remove a resposta correta para não expor ao frontend
            return [
                'id' => $question->id,
                'subject' => $question->subject,
                'text' => $question->text,
                'options' => $question->options,
            ];
        });

        return response()->json($questions);
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
