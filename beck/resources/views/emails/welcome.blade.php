<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao PREPOM Navigator</title>
</head>

<body
    style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #f5f5f5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">

                    <!-- Header com gradiente navy -->
                    <tr>
                        <td
                            style="background: linear-gradient(135deg, #0a192f 0%, #1e3a5f 100%); padding: 40px 30px; text-align: center;">
                            <div
                                style="width: 60px; height: 60px; background-color: #d4af37; border-radius: 12px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                                <span style="font-size: 32px; color: #0a192f;">⚓</span>
                            </div>
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: bold;">Bem-vindo ao
                                PREPOM!</h1>
                            <p style="color: #d4af37; margin: 10px 0 0; font-size: 16px; font-weight: 600;">Seu acesso
                                foi liberado com sucesso</p>
                        </td>
                    </tr>

                    <!-- Conteúdo -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 0 0 20px;">
                                Olá <strong>{{ $userName }}</strong>,
                            </p>
                            <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 0 0 30px;">
                                Seu pagamento de <strong style="color: #10b981;">R$
                                    {{ number_format($amountPaid, 2, ',', '.') }}</strong> foi confirmado! 🎉
                            </p>

                            <!-- Card de Credenciais -->
                            <div
                                style="background: linear-gradient(135deg, #0a192f 0%, #1e3a5f 100%); border-radius: 12px; padding: 30px; margin: 0 0 30px;">
                                <h2
                                    style="color: #d4af37; margin: 0 0 20px; font-size: 18px; font-weight: bold; text-align: center;">
                                    🔑 Suas Credenciais de Acesso</h2>

                                <div
                                    style="background-color: rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 20px; margin-bottom: 15px;">
                                    <p
                                        style="color: #d4af37; margin: 0 0 5px; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                                        Login (CPF)</p>
                                    <p
                                        style="color: #ffffff; margin: 0; font-size: 20px; font-weight: bold; font-family: 'Courier New', monospace;">
                                        {{ $userCpf }}</p>
                                </div>

                                <div
                                    style="background-color: rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 20px;">
                                    <p
                                        style="color: #d4af37; margin: 0 0 5px; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                                        Senha Inicial</p>
                                    <p
                                        style="color: #ffffff; margin: 0; font-size: 20px; font-weight: bold; font-family: 'Courier New', monospace;">
                                        {{ $userPassword }}</p>
                                </div>

                                <div
                                    style="background-color: #d4af37; border-radius: 8px; padding: 15px; margin-top: 20px; text-align: center;">
                                    <p style="color: #0a192f; margin: 0; font-size: 13px; font-weight: bold;">⚠️ No
                                        primeiro acesso, você será solicitado a alterar sua senha</p>
                                </div>
                            </div>

                            <!-- Botão de Acesso -->
                            <div style="text-align: center; margin: 0 0 30px;">
                                <a href="https://platformx.com.br/login"
                                    style="display: inline-block; background: linear-gradient(135deg, #d4af37 0%, #b8941f 100%); color: #0a192f; text-decoration: none; padding: 16px 40px; border-radius: 8px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 6px rgba(212, 175, 55, 0.3);">
                                    Acessar Plataforma →
                                </a>
                            </div>

                            <!-- O que está incluído -->
                            <div
                                style="background-color: #f8f9fa; border-radius: 12px; padding: 25px; margin: 0 0 20px;">
                                <h3 style="color: #0a192f; margin: 0 0 15px; font-size: 16px; font-weight: bold;">📚 O
                                    que você tem acesso:</h3>
                                <ul style="margin: 0; padding: 0; list-style: none;">
                                    <li
                                        style="color: #333333; margin: 0 0 10px; padding-left: 25px; position: relative; font-size: 14px;">
                                        <span style="position: absolute; left: 0; color: #10b981;">✅</span>
                                        5 blocos completos de simulados
                                    </li>
                                    <li
                                        style="color: #333333; margin: 0 0 10px; padding-left: 25px; position: relative; font-size: 14px;">
                                        <span style="position: absolute; left: 0; color: #10b981;">✅</span>
                                        200 questões de Português e Matemática
                                    </li>
                                    <li
                                        style="color: #333333; margin: 0 0 10px; padding-left: 25px; position: relative; font-size: 14px;">
                                        <span style="position: absolute; left: 0; color: #10b981;">✅</span>
                                        Cronômetro de 3 horas (igual à prova real)
                                    </li>
                                    <li
                                        style="color: #333333; margin: 0; padding-left: 25px; position: relative; font-size: 14px;">
                                        <span style="position: absolute; left: 0; color: #10b981;">✅</span>
                                        Correção automática com gabarito comentado
                                    </li>
                                </ul>
                            </div>

                            <p style="color: #666666; font-size: 14px; line-height: 1.6; margin: 0;">
                                Bons estudos e boa sorte na sua jornada rumo à Marinha Mercante! ⚓
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background-color: #f8f9fa; padding: 30px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="color: #666666; font-size: 12px; margin: 0 0 10px;">
                                <strong>Equipe PREPOM Navigator</strong>
                            </p>
                            <p style="color: #999999; font-size: 11px; margin: 0;">
                                Este é um email automático. Por favor, não responda.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>