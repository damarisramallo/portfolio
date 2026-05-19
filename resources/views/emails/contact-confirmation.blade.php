<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0; padding:0; background:#f5f4f2; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" style="padding: 40px 20px;">
    <tr>
      <td align="center">
        <table width="560" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:12px; border:1px solid #ece9e4; overflow:hidden;">

          <!-- Header -->
          <tr>
            <td style="background:#1a1a18; padding:28px 36px;">
              <h1 style="margin:6px 0 0; font-size:20px; font-weight:600; color:#fafaf9;">¡Gracias por escribirme!</h1>
            </td>
          </tr>

          <!-- Cuerpo -->
          <tr>
            <td style="padding:32px 36px;">
              <p style="margin:0 0 16px; font-size:15px; color:#1a1a18; line-height:1.7;">
                Hola <strong>{{ $data['name'] }}</strong>,
              </p>
              <p style="margin:0 0 16px; font-size:14px; color:#78766f; line-height:1.7;">
                Recibí tu mensaje y te respondo a la brevedad. Mientras tanto, acá te dejo un resumen de lo que me enviaste:
              </p>

              <!-- Resumen -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                <tr>
                  <td style="padding:14px 16px; background:#f5f4f2; border-radius:8px;">
                    <p style="margin:0 0 4px; font-size:11px; font-weight:500; color:#9c9a93; letter-spacing:.06em; text-transform:uppercase;">Asunto</p>
                    <p style="margin:0; font-size:14px; color:#1a1a18;">{{ $data['subject'] }}</p>
                  </td>
                </tr>
              </table>

              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="padding:14px 16px; background:#f5f4f2; border-radius:8px;">
                    <p style="margin:0 0 8px; font-size:11px; font-weight:500; color:#9c9a93; letter-spacing:.06em; text-transform:uppercase;">Mensaje</p>
                    <p style="margin:0; font-size:14px; color:#1a1a18; line-height:1.7;">{{ $data['message'] }}</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding:20px 36px; border-top:1px solid #ece9e4;">
              <p style="margin:0; font-size:12px; color:#9c9a93; text-align:center;">
                Este es un mensaje automático, por favor no respondas a este email.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>