<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Payment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function createPreference(Request $request)
    {
        // 1. Validar dados
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'cpf' => 'required|string',
            'phone' => 'required|string',
        ]);

        try {
            // 2. Configurar SDK
            SDK::setAccessToken(env('MP_ACCESS_TOKEN'));

            // 3. Criar Itens
            $item = new Item();
            $item->id = "curso-prepom-completo";
            $item->title = "Acesso Completo PREPOM Navigator";
            $item->quantity = 1;
            $item->unit_price = 150.00;
            $item->currency_id = "BRL";

            // 4. Criar Payer (Pagador)
            $payer = new Payer();
            $payer->name = $request->name;
            $payer->email = $request->email;
            $payer->date_created = date('Y-m-d\TH:i:s.vP'); // ISO 8601

            // Tentar identificar documento se possível, mas o SDK PHP antigo é meio chato com isso
            // Vamos deixar o usuário preencher no checkout para evitar erro, ou passar no identification
            // $payer->identification = array(
            //     "type" => "CPF",
            //     "number" => preg_replace('/[^0-9]/', '', $request->cpf)
            // );

            // 5. Preferência
            $preference = new Preference();
            $preference->items = [$item];
            $preference->payer = $payer;

            // Retorno
            $preference->back_urls = [
                "success" => "https://platformx.com.br/login?status=success",
                "failure" => "https://platformx.com.br/comprar?status=failure",
                "pending" => "https://platformx.com.br/comprar?status=pending"
            ];
            $preference->auto_return = "approved";

            // Webhook e Metadata
            $preference->notification_url = "https://api.platformx.com.br/api/payment/webhook";
            $preference->external_reference = json_encode([
                "user_name" => $request->name,
                "user_email" => $request->email,
                "user_cpf" => preg_replace('/[^0-9]/', '', $request->cpf),
                "user_phone" => $request->phone
            ]);
            $preference->binary_mode = true; // Força aprovação instantânea ou recusa (sem pendente)

            $preference->save();

            return response()->json([
                'init_point' => $preference->init_point,
                'sandbox_init_point' => $preference->sandbox_init_point
            ]);

        } catch (\Exception $e) {
            Log::error("Erro MP Create: " . $e->getMessage());
            return response()->json(['error' => 'Erro ao criar pagamento: ' . $e->getMessage()], 500);
        }
    }

    public function webhook(Request $request)
    {
        Log::info('Webhook recebido', $request->all());

        $type = $request->input('type') ?? $request->input('topic');
        $dataId = $request->input('data.id') ?? $request->input('id');

        if (($type == 'payment' || $type == 'collection') && $dataId) {
            try {
                SDK::setAccessToken(env('MP_ACCESS_TOKEN'));

                $payment = Payment::find_by_id($dataId);

                if ($payment && $payment->status == 'approved') {

                    // Recuperar dados do external_reference (pois passamos como JSON string)
                    $metadata = json_decode($payment->external_reference, true);

                    if (!$metadata && isset($payment->metadata)) {
                        // Tentar pegar do metadata objeto se existir
                        $metadata = (array) $payment->metadata;
                    }

                    $email = $metadata['user_email'] ?? null;
                    $cpf = $metadata['user_cpf'] ?? null;
                    $name = $metadata['user_name'] ?? null;
                    $phone = $metadata['user_phone'] ?? null;

                    if ($email && $cpf) {
                        $user = User::where('email', $email)->first();

                        if (!$user) {
                            $rawCpf = preg_replace('/[^0-9]/', '', $cpf);
                            $password = substr($rawCpf, 0, 6);

                            $newUser = User::create([
                                'name' => $name,
                                'email' => $email,
                                'cpf' => $rawCpf,
                                'phone' => $phone,
                                'password' => Hash::make($password),
                                'role' => 'student',
                                'active' => true,
                                'must_change_password' => true, // Forçar troca de senha no primeiro acesso
                            ]);

                            Log::info("Aluno criado via Webhook (Legacy SDK): $email");

                            // Enviar email de boas-vindas com credenciais
                            try {
                                $formattedCpf = substr($rawCpf, 0, 3) . '.' .
                                    substr($rawCpf, 3, 3) . '.' .
                                    substr($rawCpf, 6, 3) . '-' .
                                    substr($rawCpf, 9, 2);

                                \Mail::to($email)->send(new \App\Mail\WelcomeEmail(
                                    $name,
                                    $formattedCpf,
                                    $password,
                                    150.00
                                ));

                                Log::info("Email de boas-vindas enviado para: $email");
                            } catch (\Exception $e) {
                                Log::error("Erro ao enviar email: " . $e->getMessage());
                            }
                        } else {
                            if (!$user->active) {
                                $user->active = true;
                                $user->save();
                                Log::info("Aluno reativado: $email");
                            }
                        }
                    }
                }

            } catch (\Exception $e) {
                Log::error('Erro Webhook MP Legacy: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
