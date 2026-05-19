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
              <p style="margin:0; font-size:13px; color:#9c9a93; letter-spacing:.1em; text-transform:uppercase;">Portfolio</p>
              <h1 style="margin:6px 0 0; font-size:20px; font-weight:600; color:#fafaf9;">Nuevo mensaje de contacto</h1>
            </td>
          </tr>

          <!-- Cuerpo -->
          <tr>
            <td style="padding:32px 36px;">

              <!-- Nombre -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                <tr>
                  <td style="padding:14px 16px; background:#f5f4f2; border-radius:8px;">
                    <p style="margin:0 0 4px; font-size:11px; font-weight:500; color:#9c9a93; letter-spacing:.06em; text-transform:uppercase;">Nombre</p>
                    <p style="margin:0; font-size:14px; color:#1a1a18;">{{ $data['name'] }}</p>
                  </td>
                </tr>
              </table>

              <!-- Email -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                <tr>
                  <td style="padding:14px 16px; background:#f5f4f2; border-radius:8px;">
                    <p style="margin:0 0 4px; font-size:11px; font-weight:500; color:#9c9a93; letter-spacing:.06em; text-transform:uppercase;">Email</p>
                    <a href="mailto:{{ $data['email'] }}" style="margin:0; font-size:14px; color:#1a1a18; text-decoration:none;">{{ $data['email'] }}</a>
                  </td>
                </tr>
              </table>

              <!-- Asunto -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                <tr>
                  <td style="padding:14px 16px; background:#f5f4f2; border-radius:8px;">
                    <p style="margin:0 0 4px; font-size:11px; font-weight:500; color:#9c9a93; letter-spacing:.06em; text-transform:uppercase;">Asunto</p>
                    <p style="margin:0; font-size:14px; color:#1a1a18;">{{ $data['subject'] }}</p>
                  </td>
                </tr>
              </table>

              <!-- Mensaje -->
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
                Este mensaje fue enviado desde el formulario de contacto de tu portfolio.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>