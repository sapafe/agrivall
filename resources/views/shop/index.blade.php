<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tienda - AgriVall</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/base.css', 'resources/css/shop.css'])
</head>

<body>
    @include('partials.header')

    <section class="shop-section">
        <div class="container section-container">
            <h2 class="section-title">Productos ecológicos</h2>

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

            @if($products->isEmpty())
            <p class="center-content empty-msg">No hay productos disponibles en este momento.</p>
            @endif
        </div>
    </section>

    <footer>
        <div class="container footer-container">
            <p>&copy; 2025 AgriVall. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>