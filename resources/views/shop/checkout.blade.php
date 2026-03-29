<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout - AgriVall</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/base.css', 'resources/css/checkout.css'])
</head>

<body>
    @include('partials.header')

    <section class="shop-section min-height-80">
        <div class="container section-container">
            <h2 class="section-title">Finalizar Compra</h2>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="error-list">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <div class="checkout-grid">

                <!-- CHECKOUT FORM -->
                <div class="checkout-box">
                    <h3>Datos de Envío</h3>

                    <form action="{{ route('shop.processCheckout') }}" method="POST" class="checkout-form">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="customer_name">Nombre completo <span class="required-star">*</span></label>
                                <input type="text" id="customer_name" name="customer_name"
                                    value="{{ old('customer_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="customer_phone">Teléfono <span class="required-star">*</span></label>
                                <input type="text" id="customer_phone" name="customer_phone"
                                    value="{{ old('customer_phone') }}" required>
                            </div>
                        </div>

                        <label for="customer_email">Email <span class="required-star">*</span></label>
                        <input type="email" id="customer_email" name="customer_email"
                            value="{{ old('customer_email') }}" required>

                        <label for="shipping_address">Dirección completa de envío <span
                                class="required-star">*</span></label>
                        <textarea id="shipping_address" name="shipping_address" rows="3" required>{{ old('shipping_address') }}</textarea>

                        <h3>Método de Pago</h3>
                        <p class="payment-intro">Selecciona el método de pago. Tras
                            confirmar el pedido, te enviaremos las instrucciones por email para realizar el abono de
                            <strong>{{ number_format($total, 2) }} €</strong>.</p>

                        <div class="payment-methods">
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="Transferencia" required {{
                                    old('payment_method')=='Transferencia' ? 'checked' : '' }}>
                                <strong>Transferencia Bancaria</strong>
                            </label>

                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="Bizum" required {{
                                    old('payment_method')=='Bizum' ? 'checked' : '' }}>
                                <strong>Bizum</strong>
                            </label>
                        </div>

                        <button type="submit" class="btn-primary checkout-btn-submit">Confirmar Pedido ({{ number_format($total,
                            2) }} €)</button>
                    </form>
                </div>

                <!-- ORDER SUMMARY SIDEBAR -->
                <aside class="summary-sidebar">
                    <h3>Resumen del Pedido</h3>

                    <div class="summary-items-list">
                        @foreach($cart as $details)
                        <div class="summary-item">
                            <span>{{ $details['quantity'] }}x {{ $details['name'] }}</span>
                            <strong>{{ number_format($details['price'] * $details['quantity'], 2) }} €</strong>
                        </div>
                        @endforeach
                    </div>

                    <div class="summary-total">
                        <span>Total:</span>
                        <span>{{ number_format($total, 2) }} €</span>
                    </div>
                </aside>

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