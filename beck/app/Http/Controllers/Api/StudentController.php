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
            'cpf' => 'required|string|unique:users,cpf',
            'phone' => 'nullable|string',
        ]);

        $cpfNumbers = preg_replace('/\D/', '', $request->cpf);
        $tempPassword = substr($cpfNumbers, 0, 6);

        $student = User::create([
            'name' => $request->name,
            'cpf' => $cpfNumbers,
            'phone' => $request->phone,
            'email' => $cpfNumbers . '@prepom.local', // Email fictício
            'password' => Hash::make($tempPassword),
            'role' => 'student',
            'active' => true,
            'must_change_password' => true,
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

    public function resetPassword($id)
    {
        $student = User::where('role', 'student')->findOrFail($id);

        // Reseta para os 6 primeiros dígitos do CPF
        $tempPassword = substr($student->cpf, 0, 6);
        $student->password = Hash::make($tempPassword);
        $student->must_change_password = true;
        $student->save();

        return response()->json(['message' => 'Senha resetada com sucesso! A nova senha são os 6 primeiros dígitos do CPF do aluno.']);
    }

    public function destroy($id)
    {
        $student = User::where('role', 'student')->findOrFail($id);
        $student->delete();

        return response()->json(['message' => 'Aluno removido com sucesso']);
    }
}
