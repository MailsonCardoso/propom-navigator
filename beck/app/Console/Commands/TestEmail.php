<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testa o envio de email de boas-vindas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $this->info('Enviando email de teste para: ' . $email);

        try {
            Mail::to($email)->send(new WelcomeEmail(
                'João da Silva (TESTE)',
                '123.456.789-00',
                '123456',
                50.00
            ));

            $this->info('✅ Email enviado com sucesso!');
            $this->info('Verifique a caixa de entrada (e spam) de: ' . $email);

        } catch (\Exception $e) {
            $this->error('❌ Erro ao enviar email:');
            $this->error($e->getMessage());

            $this->newLine();
            $this->warn('Dicas de troubleshooting:');
            $this->line('1. Verifique se as configurações MAIL_* estão corretas no .env');
            $this->line('2. Rode: php artisan config:clear');
            $this->line('3. Verifique se a senha do email está correta');
            $this->line('4. Teste se o servidor SMTP está acessível: telnet mail.platformx.com.br 465');
        }
    }
}
