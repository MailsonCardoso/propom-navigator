<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginAdmin(Request $request)
    {
        $validated = $request->validate([
            'cpf' => 'required|string',
            'password' => 'required|string',
        ]);

        $cpf = preg_replace('/\D/', '', $validated['cpf']);
        $password = $validated['password'];

        $user = \App\Models\User::where('cpf', $cpf)
            ->where('role', 'admin')
            ->first();

        if (!$user || !\Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function loginStudent(Request $request)
    {
        $validated = $request->validate([
            'cpf' => 'required|string',
            'password' => 'required|string',
        ]);

        $cpf = preg_replace('/\D/', '', $validated['cpf']);
        $password = $validated['password'];

        $user = \App\Models\User::where('cpf', $cpf)
            ->where('role', 'student')
            ->first();

        if (!$user || !\Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        if (!$user->active) {
            return response()->json(['message' => 'Acesso não liberado. Entre em contato com o administrador.'], 403);
        }

        // Se o aluno precisa trocar a senha (primeiro acesso), retornamos um status específico
        if ($user->must_change_password) {
            $token = $user->createToken('temp-pwd-change-token')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token,
                'must_change_password' => true,
                'message' => 'Você precisa alterar sua senha no primeiro acesso.'
            ], 200);
        }

        $token = $user->createToken('student-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = $request->user();
        $user->password = \Hash::make($request->password);
        $user->must_change_password = false;
        $user->save();

        return response()->json(['message' => 'Senha alterada com sucesso!']);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
