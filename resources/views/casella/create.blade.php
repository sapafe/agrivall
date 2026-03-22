<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>La Casilla - AgriVall</title>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mistake+Note&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('estil.css') }}?v={{ filemtime(public_path('estil.css')) }}">
</head>

<body>

  @include('partials.header')


  <main class="container section-container" style="max-width: 1000px;">
    <h1 class="section-title">La Casilla</h1>

    @if(session('ok'))
    <div
      style="background:#e8ffe8; border:1px solid #b6f2b6; padding:12px 14px; border-radius:10px; margin-bottom: 1rem;">
      {{ session('ok') }}
    </div>
    @endif

    <section style="margin-bottom: 2.5rem;">
      <p style="text-align:center; max-width: 720px; margin: 0 auto 1.5rem;">
        Un espacio para desconectar, respirar naturaleza y disfrutar de productos de temporada.
        Reserva una semana y te contactaremos para confirmar disponibilidad.
      </p>

      <div class="casella-gallery">
        <img src="{{ asset('images/casella/fachada.jpg') }}" alt="Fachada La Casilla">
        <img src="{{ asset('images/casella/cuina.jpg') }}" alt="Interior La Casilla">
        <img src="{{ asset('images/casella/habitacio1.jpg') }}" alt="Interior La Casilla">
        <img src="{{ asset('images/casella/habitacio2.jpg') }}" alt="Interior La Casilla">
        <img src="{{ asset('images/casella/habitacio3.jpg') }}" alt="Interior La Casilla">
        <img src="{{ asset('images/casella/menjador.jpg') }}" alt="Interior La Casilla">
        <img src="{{ asset('images/casella/riu.jpg') }}" alt="Entorno La Casilla">
      </div>
      <p style="opacity:.8; text-align:center; margin-top:.75rem;"></p>
    </section>

    <section class="casella-reserva">
      <h2 style="margin-bottom: 2rem; text-align:center;">Calendario de Disponibilidad</h2>

      @php
        $monthNames = [
          1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
          5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
          9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        $firstMonth = $weeks->keys()->first();
      @endphp

      <!-- Navegación por meses -->
      <div class="month-tabs">
        @foreach($weeks as $ymKey => $monthWeeks)
          @php
            [$year, $mNum] = explode('-', $ymKey);
            $mNum = (int)$mNum;
          @endphp
          <button type="button" 
                  class="month-tab @if($ymKey == $firstMonth) active @endif" 
                  onclick="showMonth('{{ $ymKey }}', this)">
            {{ $monthNames[$mNum] }} @if($weeks->count() > 12) <small>{{ $year }}</small> @endif
          </button>
        @endforeach
      </div>

      <div class="calendar-container">
        @foreach($weeks as $ymKey => $monthWeeks)
        <div id="month-{{ $ymKey }}" class="month-container @if($ymKey == $firstMonth) active @endif">
          <div class="weeks-grid">
            @foreach($monthWeeks as $week)
            <div class="week-card @if($week->status !== 'LIBRE') disabled @endif" 
                 onclick="selectWeek('{{ $week->id }}', this)" 
                 data-id="{{ $week->id }}">
              <div class="week-num">Semana {{ $week->week_number }}</div>
              <div class="week-desc">{{ $week->descriptor }}</div>
              <div class="week-price">€{{ number_format($week->price, 2) }}</div>
              <div class="week-status status-{{ strtolower(str_replace(' ', '-', $week->status)) }}">
                {{ $week->status }}
              </div>
            </div>
            @endforeach
          </div>
        </div>
        @endforeach
      </div>

      <h2 style="margin-bottom: 1rem; text-align:center;">Solicitar Reserva</h2>
      
      <form action="{{ route('casella.store') }}" method="POST" class="reserva-form" id="reservaForm">
        @csrf

        <input type="hidden" id="week_id" name="week_id" required>

        <div id="selected-week-info" style="text-align:center; padding: 10px; background: #f0f7f0; border-radius: 8px; margin-bottom: 1rem; display: none;">
          Has seleccionado: <strong id="week-display-name"></strong>
        </div>

        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" required value="{{ old('name', auth()->user()->name ?? '') }}">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required value="{{ old('email', auth()->user()->email ?? '') }}">

        <label for="message">Observaciones / Comentarios</label>
        <textarea id="message" name="message" rows="4">{{ old('message') }}</textarea>

        <button type="submit" class="btn-primary" id="btn-submit" disabled>Enviar reserva</button>
      </form>

      <script>
        function selectWeek(id, element) {
          if (element.classList.contains('disabled')) return;

          // Desmarcar anteriores
          document.querySelectorAll('.week-card').forEach(el => el.classList.remove('selected'));
          
          // Marcar actual
          element.classList.add('selected');
          
          // Actualizar input y display
          document.getElementById('week_id').value = id;
          document.getElementById('week-display-name').textContent = element.querySelector('.week-desc').textContent + " (S" + element.querySelector('.week-num').textContent.split(' ')[1] + ")";
          document.getElementById('selected-week-info').style.display = 'block';
          
          // Habilitar botón
          document.getElementById('btn-submit').disabled = false;
        }

        function showMonth(monthNum, btn) {
          // Ocultar todos los contenedores
          document.querySelectorAll('.month-container').forEach(c => c.classList.remove('active'));
          // Mostrar el seleccionado
          document.getElementById('month-' + monthNum).classList.add('active');
          // Actualizar botones
          document.querySelectorAll('.month-tab').forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
        }
      </script>

      @if($errors->any())
      <div
        style="margin-top:1rem; background:#ffecec; border:1px solid #ffb8b8; padding:12px 14px; border-radius:10px;">
        <ul style="margin-left: 1rem;">
          @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    </section>
  </main>

  @include('partials.footer')

</body>

</html>