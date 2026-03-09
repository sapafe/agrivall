<header class="site-header">
  <div class="container header-container">

    {{-- Menú esquerra --}}
    <nav class="nav-desktop">
      <ul>
        <li><a href="/">Inici</a></li>
        <li><a href="{{ route('shop.index') }}">Tienda</a></li>
        <li><a href="{{ route('posts.index') }}">Blog</a></li>
        <li><a href="{{ route('casella.create') }}">La Casella</a></li>
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
        <span class="badge"
          style="background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; position: absolute; top: -5px; right: -10px;">{{
          session()->has('cart') ? collect(session('cart'))->sum('quantity') : 0 }}</span>
      </a>

      {{-- Login / Logout --}}
      @auth
      <form method="POST" action="{{ route('logout') }}">
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
      <button class="hamburger" aria-label="Menú">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </div>
</header>