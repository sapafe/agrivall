<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AgriVall - Productos Ecológicos y La Casilla</title>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mistake+Note&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('estil.css') }}">
</head>
<body>

  <!-- HEADER / NAV -->
  <header class="site-header">

  <!-- Toggle menú móvil (solo CSS) -->
  <input type="checkbox" id="menu-toggle" class="menu-toggle">

  <div class="container header-container">

    <!-- Hamburguesa (label apunta al checkbox de arriba) -->
    <label for="menu-toggle" class="hamburger" aria-label="Abrir/cerrar menú">
      <i class="fa-solid fa-bars"></i>
    </label>

    <!-- IZQUIERDA: menú escritorio -->
    <nav class="nav-desktop" aria-label="Navegación principal">
      <ul>
        <li><a href="#inicio">Inicio</a></li>
        <li><a href="#productos">Productos</a></li>
        <li><a href="#reserva">La Casilla</a></li>
        <li><a href="#blog">Blog</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>
    </nav>

    <!-- CENTRO: logo -->
    <div class="logo">
      <a href="#inicio" aria-label="Ir al inicio">
        <img src="{{ asset('images/logo.png') }}" alt="AgriVall Logo">
      </a>
    </div>

    <!-- DERECHA: acciones -->
    <div class="header-actions">
      <a class="icon-btn" href="/carrito" aria-label="Carrito">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="badge" aria-label="Productos en carrito">0</span>
      </a>

      <a class="icon-btn" href="/login" aria-label="Iniciar sesión">
        <i class="fa-regular fa-user"></i>
      </a>

      <div class="lang">
        <button class="icon-btn" type="button" aria-label="Cambiar idioma">
          <i class="fa-solid fa-globe"></i>
        </button>
        <div class="lang-menu" role="menu" aria-label="Idiomas">
          <a href="?lang=es" role="menuitem">ES</a>
          <a href="?lang=ca" role="menuitem">CA</a>
          <a href="?lang=en" role="menuitem">EN</a>
        </div>
      </div>
    </div>

  </div>

  <!-- MENÚ MÓVIL -->
  <nav id="mobileMenu" class="nav-mobile" aria-label="Menú móvil">
    <ul>
      <li><a href="#inicio">Inicio</a></li>
      <li><a href="#productos">Productos</a></li>
      <li><a href="#reserva">La Casilla</a></li>
      <li><a href="#blog">Blog</a></li>
      <li><a href="#contacto">Contacto</a></li>

      <li class="mobile-actions">
        <a href="/carrito"><i class="fa-solid fa-cart-shopping"></i> Carrito</a>
        <a href="/login"><i class="fa-regular fa-user"></i> Login</a>

        <div class="mobile-lang">
          <span><i class="fa-solid fa-globe"></i> Idioma:</span>
          <a href="?lang=es">ES</a>
          <a href="?lang=ca">CA</a>
        </div>
      </li>
    </ul>
  </nav>

</header>


  <!-- LANDING / HERO -->
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
      <div class="productos-grid">
        <div class="producto-card">
          <img src="{{ asset('images/productos/cerezas.png') }}" alt="Cerezas">
          <h3>Cerezas</h3>
          <p>Descripción breve del producto ecológico.</p>
          <p class="precio">€10.00</p>
          <button class="btn-secondary">Añadir al carrito</button>
        </div>

        <div class="producto-card">
          <img src="{{ asset('images/productos/albaricoques.png') }}" alt="Albaricoques">
          <h3>Albaricoques</h3>
          <p>Descripción breve del producto ecológico.</p>
          <p class="precio">€15.00</p>
          <button class="btn-secondary">Añadir al carrito</button>
        </div>
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