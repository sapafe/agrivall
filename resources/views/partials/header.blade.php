<header class="site-header">
  <input type="checkbox" id="menu-toggle" class="menu-toggle">
  <div class="container header-container">

    {{-- 1. Menú Hamburguesa (Izquierda) --}}
    <div class="header-left">
      <label for="menu-toggle" class="hamburger" aria-label="Menú">
        <span class="line"></span>
        <span class="line"></span>
      </label>
    </div>

    {{-- 2. Logo (Centro) --}}
    <div class="logo">
      <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="AgriVall">
      </a>
    </div>

    {{-- 3. Acciones (Derecha) --}}
    <div class="header-actions">

      {{-- Login / Logout --}}
      @auth
        @if(auth()->user()->is_admin)
          <a href="{{ route('admin.orders.index') }}" class="icon-btn admin-gauge-btn" aria-label="Panel Admin">
            <i class="fa-solid fa-gauge-high"></i>
          </a>
        @endif
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
          @csrf
          <button class="icon-btn" type="submit" aria-label="Cerrar sesión">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
          </button>
        </form>
      @else
        <a class="icon-btn" href="{{ route('login') }}" aria-label="Login">
          <i class="fa-regular fa-user"></i>
        </a>
      @endauth

      {{-- Carrito --}}
      <a href="{{ route('shop.cart') }}" class="icon-btn" aria-label="Carrito">
        <i class="fa-solid fa-bag-shopping"></i>
        <span class="badge cart-badge">{{
  session()->has('cart') ? collect(session('cart'))->sum('quantity') : 0 }}</span>
      </a>

      {{-- Idioma --}}
      <div class="lang">
        <button class="icon-btn" aria-label="Idioma">
          <i class="fa-solid fa-globe"></i>
        </button>
        <div class="lang-menu">
          <a href="#">Català</a>
          <a href="#">Castellano</a>
        </div>
      </div>
    </div>
  </div>

  {{-- Sidebar Menu --}}
  <nav class="nav-mobile">
    <div class="sidebar-header">
      <label for="menu-toggle" class="sidebar-close" aria-label="Cerrar Menú">
        <i class="fa-solid fa-xmark"></i>
      </label>
    </div>
    <ul>
      <li><a href="/">Inicio</a></li>
      <li><a href="{{ route('about') }}">Sobre nosotros</a></li>
      <li><a href="{{ route('shop.index') }}">Tienda</a></li>
      <li><a href="{{ route('posts.index') }}">Blog</a></li>
      <li><a href="{{ route('casella.create') }}">Reserva de la casilla</a></li>
    </ul>
  </nav>

  {{-- Overlay --}}
  <label for="menu-toggle" class="sidebar-overlay"></label>
</header>