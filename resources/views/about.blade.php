<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sobre Nosotros - AgriVall</title>

  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('css/base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link rel="stylesheet" href="{{ asset('css/casella.css') }}">
</head>

<body>
  @include('partials.header')

  <main class="container section-container">
    <h1 class="section-title">Sobre Nosotros</h1>

    <section class="about-detail">
      <div class="about-text">
        <p><strong>AgriVall</strong> nació como un sueño familiar en el corazón del valle. Nuestra pasión por la agricultura ecológica nos llevó a cultivar productos frescos, respetando los ciclos de la naturaleza y recuperando el sabor auténtico de la huerta.</p>
        <p>Creemos en una alimentación consciente y en el respeto al medio ambiente. Cada producto que sale de nuestra tierra lleva consigo el cuidado y la dedicación de quienes amamos lo que hacemos.</p>
        
        <h2 class="section-title margin-top-2">La Historia de La Casilla</h2>
        <p><strong>La Casilla</strong> es el complemento perfecto a nuestra actividad agrícola. Se trata de un antiguo refugio de piedra y madera que hemos restaurado con mimo para ofrecer un espacio de paz y desconexión.</p>
        <p>Un lugar donde el tiempo se detiene, rodeado de naturaleza y con el sonido del río de fondo. Queremos compartir con nuestros visitantes la experiencia de vivir en armonía con el entorno rural.</p>
      </div>

      <div class="casella-gallery margin-top-2">
        <img src="{{ asset('images/casella/fachada.png') }}" alt="Fachada La Casilla">
        <img src="{{ asset('images/casella/terrasa.png') }}" alt="Terraza La Casilla">
        <img src="{{ asset('images/casella/cuina.png') }}" alt="Cocina La Casilla">
        <img src="{{ asset('images/casella/habitacio1.png') }}" alt="Habitación La Casilla">
        <img src="{{ asset('images/casella/menjador.png') }}" alt="Comedor La Casilla">
        <img src="{{ asset('images/casella/riu.png') }}" alt="Entorno La Casilla">
      </div>

      <div class="center-content margin-top-2">
        <p class="intro-text">¿Te gustaría vivir la experiencia?</p>
        <a href="{{ route('casella.create') }}" class="btn-primary">Ir a Reserva de la Casilla</a>
      </div>
    </section>
  </main>

  @include('partials.footer')
</body>

</html>
