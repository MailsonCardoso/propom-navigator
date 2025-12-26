<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use App\Models\SecurityLog;

class PreventSimultaneousAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user) {
            $userId = $user->id;
            $currentIp = $request->ip();
            $cacheKey = "session_lock:user:{$userId}";

            $storedIp = Cache::get($cacheKey);

            if ($storedIp && $storedIp !== $currentIp) {
                // Colisão detectada!
                // Throttle: Só registra no log uma vez a cada 30 segundos por usuário/ip para não inundar o banco
                $logKey = "security_log_throttle:user:{$userId}:ip:{$currentIp}";
                if (!Cache::has($logKey)) {
                    SecurityLog::create([
                        'user_id' => $userId,
                        'ip_address' => $currentIp,
                        'browser_info' => $request->header('User-Agent'),
                        'type' => 'simultaneous_access',
                        'description' => "Tentativa de acesso simultâneo. IP Original: {$storedIp}. IP Bloqueado: {$currentIp}.",
                    ]);
                    Cache::put($logKey, true, 30);
                }

                return response()->json([
                    'message' => 'Sessão ativa em outro dispositivo. O acesso simultâneo não é permitido e foi registrado para auditoria. Aguarde 30 segundos ou encerre o acesso no outro aparelho.'
                ], 403);
            }

            // Sem colisão, renova o lock por 30 segundos
            Cache::put($cacheKey, $currentIp, 30);
        }

        return $next($request);
    }
}
