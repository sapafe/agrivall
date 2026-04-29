<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="author" content="Saraí Palop">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AgriVall - Productos Ecológicos y La Casilla</title>

  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('css/base.css?v=1.1') }}">
  <link rel="stylesheet" href="{{ asset('css/home.css?v=1.1') }}">
  <link rel="stylesheet" href="{{ asset('css/shop.css?v=1.1') }}">
  <link rel="stylesheet" href="{{ asset('css/blog.css?v=1.1') }}">
</head>

<body>
  @include('partials.header')


  <!-- LANDING -->
  <section id="inicio" class="hero section-cream">
    <div class="container hero-container">
      <h1 class="hero-title">Bienvenido a AgriVall</h1>
      <p>Productos ecológicos frescos y La Casilla</p>
    </div>
  </section>

  <!-- SECCIÓN PRODUCTOS -->
  <section id="productos" class="section-sage">
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
  <section id="reserva" class="reserva-section section-cream">
    <div class="container section-container">
      <h2 class="section-title">Reserva de la casilla</h2>
      <img src="{{ asset('images/casella/fachada.png') }}" alt="AgriVall fachada">

      <div class="center-content margin-top-2">
        <p class="intro-text">Reserva tu estancia en La Casilla seleccionando la semana que prefieras en nuestro
          calendario actualizado.</p>
        <a href="{{ route('casella.create') }}" class="btn-primary">Seleccionar semana</a>
      </div>
    </div>
  </section>

  <!-- SECCIÓN BLOG -->
  <section id="blog" class="section-sage">
    <div class="container section-container">
      <h2 class="section-title">Blog de Noticias</h2>

      <div class="blog-grid">
        @foreach($posts as $post)
          <div class="blog-card">
            {{-- Imagen o fallback corporativo --}}
            <img
              src="{{ !empty($post->image) && file_exists(public_path($post->image)) ? asset($post->image) : asset('img/blog-default.png') }}"
              alt="{{ $post->title }}" class="blog-card__img">

            {{-- Categoría --}}
            @if($post->type)
              <span class="blog-card__badge">{{ $post->type->name }}</span>
            @endif

            <div class="blog-card__body">
              <h3 class="blog-card__title">{{ $post->title }}</h3>

              <p class="post-date">
                <i class="fa-regular fa-calendar me-1"></i>
                {{ $post->published_at->format('d/m/Y') }}
              </p>

              <p>{{ Str::limit($post->body, 100) }}</p>
              <a href="{{ route('posts.show', $post->id) }}" class="btn-secondary blog-card__btn">Leer más</a>
            </div>
          </div>
        @endforeach
      </div>
      <div class="center-content margin-top-2">
        <a href="{{ route('posts.index') }}" class="btn-primary">Ver todas las Noticias</a>
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