<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginAdmin(Request $request)
    {
        // Validação rigorosa dos campos
        $validated = $request->validate([
            'login' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:6',
        ]);

        $login = trim($validated['login']);
        $password = $validated['password']; // Senha não deve ter trim se for proposital, mas login sim.

        // Buscar usuário APENAS pelo login E role admin
        $user = \App\Models\User::where('login', $login)
            ->where('role', 'admin')
            ->first();

        // Se usuário não existe, retorna erro genérico
        if (!$user) {
            \Log::warning('Tentativa de login admin com login inexistente', [
                'login' => $login,
                'ip' => $request->ip()
            ]);
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        // Verificar senha
        if (!\Hash::check($password, $user->password)) {
            \Log::warning('Tentativa de login admin com senha incorreta', [
                'login' => $login,
                'user_id' => $user->id,
                'ip' => $request->ip()
            ]);
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        // Login bem-sucedido
        \Log::info('Login admin bem-sucedido', [
            'user_id' => $user->id,
            'login' => $user->login,
            'ip' => $request->ip()
        ]);

        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function loginStudent(Request $request)
    {
        // Validação rigorosa dos campos
        $validated = $request->validate([
            'login' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:6',
        ]);

        $login = trim($validated['login']);
        $password = $validated['password'];

        // Buscar usuário APENAS pelo login E role student
        $user = \App\Models\User::where('login', $login)
            ->where('role', 'student')
            ->first();

        // Se usuário não existe, retorna erro genérico
        if (!$user) {
            \Log::warning('Tentativa de login student com login inexistente', [
                'login' => $login,
                'ip' => $request->ip()
            ]);
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        // Verificar senha
        if (!\Hash::check($password, $user->password)) {
            \Log::warning('Tentativa de login student com senha incorreta', [
                'login' => $login,
                'user_id' => $user->id,
                'ip' => $request->ip()
            ]);
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        // Verificar se o aluno está ativo
        if (!$user->active) {
            \Log::warning('Tentativa de login de aluno inativo', [
                'user_id' => $user->id,
                'login' => $user->login,
                'ip' => $request->ip()
            ]);
            return response()->json(['message' => 'Acesso não liberado. Entre em contato com o administrador.'], 403);
        }

        // Login bem-sucedido
        \Log::info('Login student bem-sucedido', [
            'user_id' => $user->id,
            'login' => $user->login,
            'ip' => $request->ip()
        ]);

        $token = $user->createToken('student-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
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
