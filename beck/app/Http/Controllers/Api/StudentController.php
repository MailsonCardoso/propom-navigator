<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($students);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'login' => 'required|string|unique:users,login',
            'password' => 'required|string|min:6',
        ]);

        $student = User::create([
            'name' => $request->name,
            'login' => $request->login,
            'email' => $request->login . '@propom.local', // Email fictício
            'password' => Hash::make($request->password),
            'role' => 'student',
            'active' => true,
        ]);

        return response()->json($student, 201);
    }

    public function toggleStatus($id)
    {
        $student = User::where('role', 'student')->findOrFail($id);
        $student->active = !$student->active;
        $student->save();

        return response()->json($student);
    }

    public function destroy($id)
    {
        $student = User::where('role', 'student')->findOrFail($id);
        $student->delete();

        return response()->json(['message' => 'Aluno removido com sucesso']);
    }
}
