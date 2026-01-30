<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriVall - Productos Ecológicos y La Casilla</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mistake+Note&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('estil.css') }}">
</head>
<body>
    <!-- HEADER / NAV -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <img src="{{ asset('logo.png') }}" alt="AgriVall Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#productos">Productos</a></li>
                    <li><a href="#reserva">La Casilla</a></li>
                    <li><a href="#blog">Blog</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- LANDING / HERO -->
    <section id="inicio" class="hero">
        <div class="container hero-container">
            <h1>Bienvenido a AgriVall</h1>
            <p>Productos ecológicos frescos y la experiencia de La Casilla</p>
            <a href="#productos" class="btn-primary">Ver Productos</a>
        </div>
    </section>

    <!-- SECCIÓN PRODUCTOS -->
    <section id="productos">
        <div class="container section-container">
            <h2 class="section-title">Nuestros Productos</h2>
            <div class="productos-grid">
                <div class="producto-card">
                    <img src="{{ asset('producto1.jpg') }}" alt="Producto 1">
                    <h3>Producto 1</h3>
                    <p>Descripción breve del producto ecológico.</p>
                    <p class="precio">€10.00</p>
                    <button class="btn-secondary">Añadir al carrito</button>
                </div>
                <div class="producto-card">
                    <img src="{{ asset('producto2.jpg') }}" alt="Producto 2">
                    <h3>Producto 2</h3>
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
