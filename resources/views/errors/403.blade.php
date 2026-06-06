<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acceso denegado</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      background: #fafaf9;
      color: #1a1a18;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }

    .container {
      text-align: center;
      max-width: 480px;
    }

    .code {
      font-size: 7rem;
      font-weight: 700;
      color: #ece9e4;
      line-height: 1;
      margin-bottom: 1.5rem;
      letter-spacing: -.04em;
    }

    .title {
      font-size: 1.5rem;
      font-weight: 600;
      color: #1a1a18;
      margin-bottom: 12px;
    }

    .description {
      font-size: 0.95rem;
      color: #78766f;
      line-height: 1.7;
      margin-bottom: 2rem;
    }

    .btn {
      display: inline-block;
      padding: 11px 28px;
      background: #1a1a18;
      color: #fafaf9;
      font-size: 13px;
      font-weight: 500;
      border-radius: 8px;
      text-decoration: none;
      transition: background .18s;
    }

    .btn:hover { background: #333330; }
  </style>
</head>
<body>
  <div class="container">
    <p class="code">403</p>
    <h1 class="title">Acceso denegado</h1>
    <p class="description">
      No tenés permisos para acceder a esta página.
    </p>
    <a href="/" class="btn">Volver al inicio</a>
  </div>
</body>
</html>