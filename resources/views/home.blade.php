<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="author" content="Saraí Palop">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AgriVall - Productos Ecológicos y La Casilla</title>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mistake+Note&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('estil.css') }}">
</head>

<body>
  @include('partials.header')


  <!-- LANDING -->
  <section id="inicio" class="hero">
    <div class="container hero-container">
      <h1>Bienvenido a AgriVall</h1>
      <p>Productos ecológicos frescos y La Casilla</p>
      <a href="#productos" class="btn-primary">Ver Productos</a>
    </div>
  </section>

  <!-- SECCIÓN PRODUCTOS -->
  <section id="productos">
    <div class="container section-container">
      <h2 class="section-title">Nuestros Productos</h2>

      @if(session('success'))
      <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
        {{ session('success') }}
        <a href="{{ route('shop.cart') }}" style="color: #0b2e13; font-weight: bold; margin-left:10px;">Ver Carrito</a>
      </div>
      @endif

      <div class="productos-grid">
        @foreach($products as $product)
        <div class="producto-card"
          style="display:flex; flex-direction:column; justify-content:space-between; height:100%;">
          <div>
            @if($product->image)
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            @else
            <div style="height: 200px; background: #eee; display: flex; align-items: center; justify-content: center;">
              <span>Sin imagen</span>
            </div>
            @endif
            <h3 style="margin-top: 15px;">{{ $product->name }} <span style="font-size:16px; color:#666;">({{
                $product->variety }})</span></h3>
            <p style="color:#555; font-size:14px; margin-bottom: 10px;">Formato: {{ $product->format }}</p>
          </div>

          <div>
            <p class="precio">{{ number_format($product->price, 2) }} €</p>
            <form action="{{ route('shop.cart.add') }}" method="POST">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <button type="submit" class="btn-secondary" style="width:100%;">Añadir al carrito</button>
            </form>
          </div>
        </div>
        @endforeach
      </div>
      @if($products->isEmpty())
      <p style="text-align: center; color: #777;">Los productos se cargarán aquí desde la tienda.</p>
      @endif
    </div>
  </section>

  <!-- SECCIÓN RESERVA -->
  <section id="reserva" class="reserva-section">
    <div class="container section-container">
      <h2 class="section-title">Reserva La Casilla</h2>
      <img src="{{ asset('images/casella/fachada.jpg') }}" alt="AgriVall fachada">

      <form action="#" class="reserva-form">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="4"></textarea>

        <button type="submit" class="btn-primary">Reservar</button>
      </form>
    </div>
  </section>

  <!-- SECCIÓN BLOG -->
  <section id="blog">
    <div class="container section-container">
      <h2 class="section-title">Blog</h2>

      <div class="blog-grid">
        <div class="blog-card">
          <img src="{{ asset('blog1.jpg') }}" alt="Entrada 1">
          <h3>Título de la Entrada 1</h3>
          <p>Resumen de la entrada del blog...</p>
          <a href="#" class="btn-secondary">Leer más</a>
        </div>

        <div class="blog-card">
          <img src="{{ asset('blog2.jpg') }}" alt="Entrada 2">
          <h3>Título de la Entrada 2</h3>
          <p>Resumen de la entrada del blog...</p>
          <a href="#" class="btn-secondary">Leer más</a>
        </div>
      </div>

      <form class="newsletter-form">
        <h3>Suscríbete a nuestro Blog</h3>
        <input type="email" placeholder="Tu email" required>
        <button type="submit" class="btn-primary">Suscribirse</button>
      </form>
    </div>
  </section>

  <!-- SECCIÓN CONTACTO -->
  <section id="contacto">
    <div class="container section-container">
      <h2 class="section-title">Contacto</h2>

      <form class="contact-form">
        <label for="nombre-contacto">Nombre:</label>
        <input type="text" id="nombre-contacto" name="nombre-contacto" required>

        <label for="email-contacto">Email:</label>
        <input type="email" id="email-contacto" name="email-contacto" required>

        <label for="mensaje-contacto">Mensaje:</label>
        <textarea id="mensaje-contacto" name="mensaje-contacto" rows="4"></textarea>

        <button type="submit" class="btn-primary">Enviar</button>
      </form>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="container footer-container">
      <p>&copy; 2025 AgriVall. Todos los derechos reservados.</p>
      <ul>
        <li><a href="#">Aviso Legal</a></li>
        <li><a href="#">Política de Privacidad</a></li>
        <li><a href="#">Política de Cancelación</a></li>
      </ul>
    </div>
  </footer>

</body>

</html>