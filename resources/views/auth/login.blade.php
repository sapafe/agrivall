<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - AgriVall</title>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mistake+Note&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('css/base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/casella.css') }}">
</head>

<body>

  @include('partials.header')

    <main class="container section-container auth-main">
        <h1 class="section-title">Login</h1>

        <form method="POST" action="{{ route('login.attempt') }}" class="reserva-form">
            @csrf

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>

            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required>

            <div class="checkbox-group">
                <input type="checkbox" name="remember" id="remember" value="1">
                <label for="remember">Recuérdame</label>
            </div>

            <button class="btn-primary full-width" type="submit">Entrar</button>

            @if($errors->any())
            <div class="alert alert-danger margin-top-1">
                {{ $errors->first() }}
            </div>
            @endif
        </form>
    </main>

  @include('partials.footer')

</body>

</html>