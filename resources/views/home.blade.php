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

  @vite(['resources/css/base.css', 'resources/css/home.css', 'resources/css/shop.css', 'resources/css/blog.css'])
</head>

<body>
  @include('partials.header')


  <!-- LANDING -->
  <section id="inicio" class="hero">
    <div class="container hero-container">
      <h1>Bienvenido a AgriVall</h1>
      <p>Productos ecológicos frescos y La Casilla</p>
    </div>
  </section>

  <!-- SECCIÓN PRODUCTOS -->
  <section id="productos">
    <div class="container section-container">
      <h2 class="section-title">Nuestros Productos</h2>

      @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
        <a href="{{ route('shop.cart') }}" class="alert-link">Ver Carrito</a>
      </div>
      @endif

      <div class="productos-grid">
        @foreach($products as $product)
        <div class="producto-card">
          <div>
            @if($product->image)
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            @else
            <div class="no-image-placeholder">
              <span>Sin imagen</span>
            </div>
            @endif
            <h3 class="product-title">{{ $product->name }} <span class="product-variety">({{
                $product->variety }})</span></h3>
            <p class="product-format">Formato: {{ $product->format }}</p>
          </div>

          <div>
            <p class="precio">{{ number_format($product->price, 2) }} €</p>
            <form action="{{ route('shop.cart.add') }}" method="POST">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <button type="submit" class="btn-secondary full-width">Añadir al carrito</button>
            </form>
          </div>
        </div>
        @endforeach
      </div>
      <div class="center-content margin-top-2">
        <a href="{{ route('shop.index') }}" class="btn-primary">Ver todos los productos</a>
      </div>
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

  @include('partials.footer')

</body>

</html>