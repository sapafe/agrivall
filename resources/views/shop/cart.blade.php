<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Carrito - AgriVall</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <script src="{{ asset('js/cart.js') }}" defer></script>
</head>

<body>
    @include('partials.header')

    <section class="shop-section min-height-80">
        <div class="container section-container">
            <h2 class="section-title">Tu Carrito</h2>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div id="cart-content" @if(empty($cart)) class="hidden" @endif>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th class="hide-mobile">Formato</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cart-body">
                        @foreach($cart as $id => $details)
                        <tr data-id="{{ $id }}">
                            <td>
                                <div class="cart-item-info">
                                    @if(isset($details['image']) && $details['image'])
                                    <img src="{{ asset($details['image']) }}" alt="" class="cart-item-img">
                                    @endif
                                    <strong>{{ $details['name'] }}</strong>
                                </div>
                            </td>
                            <td class="hide-mobile">{{ $details['format'] }}</td>
                            <td>{{ number_format($details['price'], 2) }} €</td>
                            <td>
                                <div class="qty-control">
                                    <button type="button" class="btn-minus">-</button>
                                    <input type="number" min="1" class="input-qty" value="{{ $details['quantity'] }}">
                                    <button type="button" class="btn-plus">+</button>
                                </div>
                            </td>
                            <td class="cell-amount">{{ number_format($details['price'] * $details['quantity'], 2) }} €</td>
                            <td class="cell-actions">
                                <button type="button" class="btn-remove" title="Eliminar">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="promo-container">
                    <form id="promo-form" class="promo-inline-form">
                        <input type="text" id="promo-code" placeholder="Código promocional">
                        <button type="submit" class="btn-secondary">Aplicar</button>
                        <span id="promo-msg"></span>
                    </form>
                </div>

                <div class="totals-container">
                    <div class="totals-row">
                        <span>Subtotal:</span>
                        <strong id="subtotal">0,00 €</strong>
                    </div>
                    <div class="totals-row">
                        <span>IVA (21%):</span>
                        <strong id="iva">0,00 €</strong>
                    </div>
                    <div class="totals-row">
                        <span>Descuento:</span>
                        <strong id="discount">0,00 €</strong>
                    </div>
                    <div class="total-final">
                        Total: <span id="total-final">0,00 €</span>
                    </div>

                    <div class="cart-actions-bottom">
                        <a href="{{ route('shop.index') }}" class="btn-secondary">Seguir comprando</a>
                        <a href="{{ route('shop.checkout') }}" class="btn-primary">Ir al Checkout</a>
                    </div>
                </div>
            </div>

            <div id="empty-cart-msg" @if(!empty($cart)) class="hidden" @endif class="empty-cart-container">
                <i class="fa-solid fa-cart-shopping empty-cart-icon"></i>
                <p class="empty-cart-text">Tu carrito está vacío.</p>
                <a href="{{ route('shop.index') }}" class="btn-primary">Volver a la tienda</a>
            </div>

        </div>
    </section>

    <footer>
        <div class="container footer-container">
            <p>&copy; 2025 AgriVall. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        window.Agrivall = {
            baseUrl: "{{ asset('/') }}"
        };
        // Ensure SEED is a simple array of objects with numerical IDs
        const SEED = @json(collect($cart)->map(fn($item, $id) => array_merge($item, ['id' => (int)$id]))->values());
        console.log("SEED data initialized from Blade:", SEED);
    </script>
</body>

</html>

</html>