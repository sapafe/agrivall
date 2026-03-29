<header class="site-header">
  <input type="checkbox" id="menu-toggle" class="menu-toggle">
  <div class="container header-container">

    {{-- Menú esquerra --}}
    <nav class="nav-desktop">
      <ul>
        <li><a href="/">Inicio</a></li>
        <li><a href="{{ route('shop.index') }}">Tienda</a></li>
        <li><a href="{{ route('posts.index') }}">Blog</a></li>
        <li><a href="{{ route('casella.create') }}">La Casilla</a></li>
      </ul>
    </nav>

    {{-- Logo centre --}}
    <div class="logo">
      <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="AgriVall">
      </a>
    </div>

    {{-- Accions dreta --}}
    <div class="header-actions">

      {{-- Carrito --}}
      <a href="{{ route('shop.cart') }}" class="icon-btn" aria-label="Carrito">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="badge cart-badge">{{
          session()->has('cart') ? collect(session('cart'))->sum('quantity') : 0 }}</span>
      </a>

      {{-- Login / Logout --}}
      @auth
      <a href="{{ route('admin.orders.index') }}" class="icon-btn admin-gauge-btn" aria-label="Panel Admin">
        <i class="fa-solid fa-gauge"></i>
      </a>
      <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button class="icon-btn" type="submit" aria-label="Cerrar sesión">
          <i class="fa-solid fa-right-from-bracket"></i>
        </button>
      </form>
      @else
      <a class="icon-btn" href="{{ route('login') }}" aria-label="Login">
        <i class="fa-regular fa-user"></i>
      </a>
      @endauth

      {{-- Idioma (placeholder) --}}
      <div class="lang">
        <button class="icon-btn" aria-label="Idioma">
          <i class="fa-solid fa-globe"></i>
        </button>
        <div class="lang-menu">
          <a href="#">Català</a>
          <a href="#">Castellano</a>
        </div>
      </div>

      {{-- Hamburguesa (mòbil) --}}
      <label for="menu-toggle" class="hamburger" aria-label="Menú">
        <i class="fa-solid fa-bars"></i>
      </label>
    </div>
  </div>

  {{-- Menú mòbil --}}
  <nav class="nav-mobile">
    <ul>
      <li><a href="/">Inicio</a></li>
      <li><a href="{{ route('shop.index') }}">Tienda</a></li>
      <li><a href="{{ route('posts.index') }}">Blog</a></li>
      <li><a href="{{ route('casella.create') }}">La Casilla</a></li>
    </ul>
  </nav>
</header>