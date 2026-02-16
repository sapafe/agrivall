<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>La Casella - AgriVall</title>
  <link rel="stylesheet" href="{{ asset('estil.css') }}?v={{ filemtime(public_path('estil.css')) }}">
</head>
<body>

@include('partials.header')


<main class="container section-container" style="max-width: 1000px;">
  <h1 class="section-title">La Casella</h1>

  @if(session('ok'))
    <div style="background:#e8ffe8; border:1px solid #b6f2b6; padding:12px 14px; border-radius:10px; margin-bottom: 1rem;">
      {{ session('ok') }}
    </div>
  @endif

  <section style="margin-bottom: 2.5rem;">
    <p style="text-align:center; max-width: 720px; margin: 0 auto 1.5rem;">
      Un espacio para desconectar, respirar naturaleza y disfrutar de productos de temporada.
      Reserva una semana y te contactaremos para confirmar disponibilidad.
    </p>

    <div class="casella-gallery">
      <img src="{{ asset('images/casella/fachada.jpg') }}" alt="Fachada La Casella">
      <img src="{{ asset('images/casella/cuina.jpg') }}" alt="Interior La Casella">
      <img src="{{ asset('images/casella/habitacio1.jpg') }}" alt="Interior La Casella">
      <img src="{{ asset('images/casella/habitacio2.jpg') }}" alt="Interior La Casella">
      <img src="{{ asset('images/casella/habitacio3.jpg') }}" alt="Interior La Casella">
      <img src="{{ asset('images/casella/menjador.jpg') }}" alt="Interior La Casella">
      <img src="{{ asset('images/casella/riu.jpg') }}" alt="Entorno La Casella">
    </div>
    <p style="opacity:.8; text-align:center; margin-top:.75rem;"></p>
  </section>

  <section class="casella-reserva">
    <h2 style="margin-bottom: 1rem; text-align:center;">Reserva</h2>

    @if(!auth()->check())
      <p style="text-align:center; margin-bottom:1rem;">
        Para reservar necesitas iniciar sesión.
        <a href="{{ route('login') }}">Ir a login</a>
      </p>
    @endif

    <form action="{{ route('casella.store') }}" method="POST" class="reserva-form">
      @csrf

      <label for="week_id">Semana</label>
      <select id="week_id" name="week_id" required>
        <option value="">Elige una semana</option>
        @foreach($weeks as $week)
          <option value="{{ $week->id }}">
            {{ $week->year }} - Semana {{ $week->week_number }} ({{ $week->descriptor }}) · €{{ number_format($week->price, 2) }}
          </option>
        @endforeach
      </select>

      <label for="name">Nombre</label>
      <input type="text" id="name" name="name" required value="{{ old('name') }}">

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required value="{{ old('email') }}">

      <label for="message">Mensaje</label>
      <textarea id="message" name="message" rows="4">{{ old('message') }}</textarea>

      <button type="submit" class="btn-primary">Enviar reserva</button>
    </form>

    @if($errors->any())
      <div style="margin-top:1rem; background:#ffecec; border:1px solid #ffb8b8; padding:12px 14px; border-radius:10px;">
        <ul style="margin-left: 1rem;">
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </section>
</main>

</body>
</html>
