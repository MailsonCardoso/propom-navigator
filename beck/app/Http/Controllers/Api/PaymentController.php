<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function createPreference(Request $request)
    {
        // 1. Validar dados do aluno
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'cpf' => 'required|string', // Validar formato no frontend
            'phone' => 'required|string',
        ]);

        // 2. Verificar se email ou CPF já existem (opcional, mas bom pra evitar duplicidade)
        $userExists = User::where('email', $request->email)->orWhere('cpf', $request->cpf)->exists();
        if ($userExists) {
            // Em tese, se já existe, poderíamos mandar para login, mas vamos deixar passar por enquanto 
            // ou retornar erro se você preferir bloquear recompra.
            // return response()->json(['message' => 'Email ou CPF já cadastrados.'], 409);
        }

        // 3. Configurar SDK do Mercado Pago
        // ATENÇÃO: Coloque seu ACCESS TOKEN no .env como MP_ACCESS_TOKEN
        MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));

        // 4. Criar a Preferência
        $client = new PreferenceClient();

        try {
            $preference = $client->create([
                "items" => [
                    [
                        "id" => "curso-prepom-completo",
                        "title" => "Acesso Completo PREPOM Navigator",
                        "quantity" => 1,
                        "unit_price" => 50.00
                    ]
                ],
                "payer" => [
                    "name" => $request->name,
                    "email" => $request->email,
                    "identification" => [
                        "type" => "CPF",
                        "number" => preg_replace('/[^0-9]/', '', $request->cpf)
                    ]
                ],
                "back_urls" => [
                    "success" => "https://platformx.com.br/login", // Ajustar para sua URL de sucesso
                    "failure" => "https://platformx.com.br/comprar",
                    "pending" => "https://platformx.com.br/comprar"
                ],
                "auto_return" => "approved",
                "metadata" => [
                    "user_name" => $request->name,
                    "user_email" => $request->email,
                    "user_cpf" => preg_replace('/[^0-9]/', '', $request->cpf),
                    "user_phone" => $request->phone
                ],
                "notification_url" => "https://api.platformx.com.br/api/payment/webhook" // IMPORTANTE: Sua URL de webhook
            ]);

            return response()->json(['init_point' => $preference->init_point, 'sandbox_init_point' => $preference->sandbox_init_point]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar pagamento: ' . $e->getMessage()], 500);
        }
    }

    public function webhook(Request $request)
    {
        // Log para debug
        Log::info('Webhook recebido', $request->all());

        // O Mercado Pago envia o ID do tópico (pagamento) na query ou no body
        $paymentId = $request->query('id') ?? $request->input('data.id');
        $type = $request->input('type') ?? $request->input('topic');

        if ($type == 'payment' && $paymentId) {
            MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));
            $client = new \MercadoPago\Client\Payment\PaymentClient();

            try {
                $payment = $client->get($paymentId);

                // Se aprovado, criar o usuário
                if ($payment->status == 'approved') {

                    $metadata = $payment->metadata;

                    // Recuperar dados do metadata (o MP converte user_email para user_email no objeto, mas as vezes vem camelCase)
                    // Vamos tentar acessar como propriedade dinâmica

                    // Nota: O SDK novo retorna um objeto, o metadata também é objeto
                    $email = $metadata->user_email ?? null;
                    $cpf = $metadata->user_cpf ?? null;
                    $name = $metadata->user_name ?? null;
                    $phone = $metadata->user_phone ?? null;

                    if ($email && $cpf) {
                        // Verifica se já existe para não quebrar
                        $user = User::where('email', $email)->first();

                        if (!$user) {
                            // Senha = 6 primeiros dígitos do CPF
                            $rawCpf = preg_replace('/[^0-9]/', '', $cpf);
                            $password = substr($rawCpf, 0, 6);

                            User::create([
                                'name' => $name,
                                'email' => $email,
                                'cpf' => $rawCpf,
                                'phone' => $phone,
                                'password' => Hash::make($password),
                                'role' => 'student',
                                'active' => true,
                                'must_change_password' => false // Opcional, se quiser forçar troca depois
                            ]);

                            Log::info("Aluno criado via Webhook: $email");
                        } else {
                            Log::info("Aluno já existia, pagou de novo? $email");
                            // Opcional: Reativar se estiver inativo
                            if (!$user->active) {
                                $user->active = true;
                                $user->save();
                            }
                        }
                    }
                }

            } catch (\Exception $e) {
                Log::error('Erro no processamento do webhook: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
