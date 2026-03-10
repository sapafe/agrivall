<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tienda - AgriVall</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('estil.css') }}">
</head>

<body>
    @include('partials.header')

    <section style="padding: 120px 0 60px 0; background-color: #f9f9f9;">
        <div class="container section-container">
            <h2 class="section-title">Productos ecológicos</h2>

            @if(session('success'))
            <div
                style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
                <a href="{{ route('shop.cart') }}" style="color: #0b2e13; font-weight: bold; margin-left:10px;">Ver
                    Carrito</a>
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
                        <div
                            style="height: 200px; background: #eee; display: flex; align-items: center; justify-content: center;">
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
            <p style="text-align: center; color: #777; font-size: 18px;">No hay productos disponibles en este momento.
            </p>
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