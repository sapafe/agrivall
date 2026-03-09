<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout - AgriVall</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('estil.css') }}">
</head>

<body>
    @include('partials.header')

    <section style="padding: 120px 0 60px 0; background-color: #f9f9f9; min-height: 80vh;">
        <div class="container section-container">
            <h2 class="section-title">Finalizar Compra</h2>

            @if($errors->any())
            <div
                style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session('error'))
            <div
                style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
            @endif

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">

                <!-- CHECKOUT FORM -->
                <div
                    style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <h3 style="margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom:10px;">Datos de Envío
                    </h3>

                    <form action="{{ route('shop.processCheckout') }}" method="POST" class="reserva-form"
                        style="margin:0; padding:0; background:none; box-shadow:none;">
                        @csrf

                        <div style="display:flex; gap: 20px;">
                            <div style="flex:1;">
                                <label for="customer_name">Nombre completo <span style="color:red;">*</span></label>
                                <input type="text" id="customer_name" name="customer_name"
                                    value="{{ old('customer_name') }}" required
                                    style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ccc; border-radius:4px;">
                            </div>
                            <div style="flex:1;">
                                <label for="customer_phone">Teléfono <span style="color:red;">*</span></label>
                                <input type="text" id="customer_phone" name="customer_phone"
                                    value="{{ old('customer_phone') }}" required
                                    style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ccc; border-radius:4px;">
                            </div>
                        </div>

                        <label for="customer_email">Email <span style="color:red;">*</span></label>
                        <input type="email" id="customer_email" name="customer_email"
                            value="{{ old('customer_email') }}" required
                            style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ccc; border-radius:4px;">

                        <label for="shipping_address">Dirección completa de envío <span
                                style="color:red;">*</span></label>
                        <textarea id="shipping_address" name="shipping_address" rows="3" required
                            style="width:100%; padding:12px; margin-bottom:25px; border:1px solid #ccc; border-radius:4px; font-family:inherit;">{{ old('shipping_address') }}</textarea>

                        <h3 style="margin-bottom: 15px; border-bottom: 2px solid #eee; padding-bottom:10px;">Método de
                            Pago</h3>
                        <p style="color:#666; font-size:14px; margin-bottom:15px;">Selecciona el método de pago. Tras
                            confirmar el pedido, te enviaremos las instrucciones por email para realizar el abono de
                            <strong>{{ number_format($total, 2) }} €</strong>.</p>

                        <div style="display:flex; gap: 20px; margin-bottom: 30px;">
                            <label
                                style="border:1px solid #ddd; padding:15px; border-radius:4px; flex:1; cursor:pointer; display:flex; align-items:center;">
                                <input type="radio" name="payment_method" value="Transferencia" required {{
                                    old('payment_method')=='Transferencia' ? 'checked' : '' }}
                                    style="margin-right:10px;">
                                <strong>Transferencia Bancaria</strong>
                            </label>

                            <label
                                style="border:1px solid #ddd; padding:15px; border-radius:4px; flex:1; cursor:pointer; display:flex; align-items:center;">
                                <input type="radio" name="payment_method" value="Bizum" required {{
                                    old('payment_method')=='Bizum' ? 'checked' : '' }} style="margin-right:10px;">
                                <strong>Bizum</strong>
                            </label>
                        </div>

                        <button type="submit" class="btn-primary"
                            style="width:100%; font-size:18px; padding:15px;">Confirmar Pedido ({{ number_format($total,
                            2) }} €)</button>
                    </form>
                </div>

                <!-- ORDER SUMMARY SIDEBAR -->
                <div>
                    <div
                        style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); position: sticky; top: 100px;">
                        <h3 style="margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom:10px;">Resumen del
                            Pedido</h3>

                        <div style="margin-bottom: 20px;">
                            @foreach($cart as $details)
                            <div
                                style="display:flex; justify-content:space-between; margin-bottom:10px; font-size:14px; border-bottom:1px dashed #eee; padding-bottom:10px;">
                                <span>{{ $details['quantity'] }}x {{ $details['name'] }} ({{ $details['format']
                                    }})</span>
                                <strong>{{ number_format($details['price'] * $details['quantity'], 2) }} €</strong>
                            </div>
                            @endforeach
                        </div>

                        <div style="display:flex; justify-content:space-between; font-size:20px; font-weight:bold;">
                            <span>Total a pagar:</span>
                            <span>{{ number_format($total, 2) }} €</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <footer>
        <div class="container footer-container">
            <p>&copy; 2025 AgriVall. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>