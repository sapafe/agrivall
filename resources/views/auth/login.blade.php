<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - AgriVall</title>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mistake+Note&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('estil.css') }}?v={{ filemtime(public_path('estil.css')) }}">
</head>

<body>

  @include('partials.header')

  <main class="container section-container" style="max-width:520px;">
    <h1 class="section-title">Login</h1>

    <form method="POST" action="{{ route('login.attempt') }}">
      @csrf

      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required>

      <label for="password">Contraseña</label>
      <input id="password" type="password" name="password" required>

      <label style="display:flex; gap:.5rem; align-items:center;">
        <input type="checkbox" name="remember" value="1" style="width:auto;">
        Recuérdame
      </label>

      <button class="btn-primary" type="submit">Entrar</button>

      @if($errors->any())
      <div
        style="margin-top:1rem; background:#ffecec; border:1px solid #ffb8b8; padding:12px 14px; border-radius:10px;">
        {{ $errors->first() }}
      </div>
      @endif
    </form>
  </main>

  @include('partials.footer')

</body>

</html>