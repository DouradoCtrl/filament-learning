<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <style>
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                max-width: 100% !important;
            }
            .content-padding {
                padding: 30px 20px 20px 20px !important;
            }
            .button-wrapper {
                padding: 0 20px 30px 20px !important;
            }
            .footer-padding {
                padding: 20px !important;
            }
        }
    </style>
</head>
<body style="margin:0;padding:0;background-color:#000000;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;-webkit-font-smoothing:antialiased;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#000000;padding:40px 0;">
        <tr>
            <td align="center" style="padding:0 15px;">
                <table class="email-container" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;background-color:#0a0a0a;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,0.8);padding:0;overflow:hidden;border:1px solid #262626;margin:0 auto;">
                    <tr>
                        <td align="center" style="background-color:#0a0a0a;padding:40px 0 20px 0;border-bottom:1px solid #262626;">
                            <img src="{{ config('app.url') }}/images/logo.svg" alt="Logo" width="120" style="display:block;margin:0 auto;">
                        </td>
                    </tr>
                    <tr>
                        <td class="content-padding" style="padding:40px 48px 20px 48px;">
                            <h2 style="font-size:24px;color:#ffffff;font-weight:700;margin:0 0 16px 0;text-align:center;">Olá, {{ $userName }}</h2>
                            <div style="font-size:16px;color:#d9d9d9;line-height:1.6;margin:0 0 32px 0;text-align:center;">{!! $userMessage !!}</div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" class="button-wrapper" style="padding:0 48px 40px 48px;">
                            <!--[if mso]>
                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ config('app.url') }}" style="height:48px;v-text-anchor:middle;width:220px;" arcsize="15%" stroke="f" fillcolor="#ffffff">
                                <w:anchorlock/>
                                <center style="color:#000000;font-family:sans-serif;font-size:16px;font-weight:bold;">Acessar plataforma</center>
                            </v:roundrect>
                            <![endif]-->
                            <!--[if !mso]> <!-->
                            <a href="{{ config('app.url') }}" style="display:inline-block;background-color:#ffffff;color:#000000;font-weight:600;padding:14px 32px;border-radius:8px;text-decoration:none;font-size:16px;box-shadow:0 4px 10px rgba(255,255,255,0.1);">Acessar plataforma</a>
                            <!--<![endif]-->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" class="footer-padding" style="font-size:14px;color:#737373;padding:24px 48px;border-top:1px solid #262626;background-color:#000000;">
                            Obrigado,<br><strong style="color:#a3a3a3;">{{ config('app.name') }}</strong>
                        </td>
                    </tr>
                </table>
                <table class="email-container" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin-top:20px;margin:0 auto;">
                    <tr>
                        <td align="center" style="font-size:12px;color:#525252;line-height:1.5;padding:0 20px;">
                            Este é um e-mail automático, por favor não responda.<br>
                            &copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>