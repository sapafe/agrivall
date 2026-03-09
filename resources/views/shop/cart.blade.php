<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carrito - AgriVall</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('estil.css') }}">
    <style>
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .cart-table th,
        .cart-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .cart-table th {
            background: #f8f9fa;
        }
    </style>
</head>

<body>
    @include('partials.header')

    <section style="padding: 120px 0 60px 0; background-color: #f9f9f9; min-height: 80vh;">
        <div class="container section-container">
            <h2 class="section-title">Tu Carrito</h2>

            @if(session('success'))
            <div
                style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
            @endif

            @if(empty($cart))
            <div style="text-align: center; padding: 50px 0;">
                <i class="fa-solid fa-cart-shopping" style="font-size: 50px; color: #ccc; margin-bottom: 20px;"></i>
                <p style="font-size: 18px; color: #666;">Tu carrito está vacío.</p>
                <a href="{{ route('shop.index') }}" class="btn-primary"
                    style="margin-top:20px; display:inline-block;">Volver a la tienda</a>
            </div>
            @else
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Formato</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $details)
                    <tr>
                        <td>
                            <div style="display:flex; align-items:center; gap:15px;">
                                @if(isset($details['image']) && $details['image'])
                                <img src="{{ asset($details['image']) }}" alt=""
                                    style="width:60px; height:60px; object-fit:cover; border-radius:4px;">
                                @endif
                                <strong>{{ $details['name'] }}</strong>
                            </div>
                        </td>
                        <td>{{ $details['format'] }}</td>
                        <td>{{ number_format($details['price'], 2) }} €</td>
                        <td>
                            <form action="{{ route('shop.cart.update') }}" method="POST"
                                style="display:flex; gap:10px;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1"
                                    style="width: 60px; padding: 5px; border:1px solid #ddd; border-radius:4px;">
                                <button type="submit"
                                    style="background:none; border:none; color:#3498db; cursor:pointer;"
                                    title="Actualizar"><i class="fa-solid fa-arrows-rotate"></i></button>
                            </form>
                        </td>
                        <td>{{ number_format($details['price'] * $details['quantity'], 2) }} €</td>
                        <td style="text-align: right;">
                            <form action="{{ route('shop.cart.remove') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit"
                                    style="background:none; border:none; color:#e74c3c; cursor:pointer;"
                                    title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div
                style="background: white; padding: 20px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); text-align: right;">
                <h3 style="margin-bottom: 20px;">Total: {{ number_format($total, 2) }} €</h3>
                <div style="display:flex; justify-content: flex-end; gap: 15px;">
                    <a href="{{ route('shop.index') }}" class="btn-secondary" style="text-decoration: none;">Seguir
                        comprando</a>
                    <a href="{{ route('shop.checkout') }}" class="btn-primary" style="text-decoration: none;">Ir al
                        Checkout</a>
                </div>
            </div>
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