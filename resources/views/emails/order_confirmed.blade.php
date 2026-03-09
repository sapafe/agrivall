<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 30px;
            background: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 0 0 8px 8px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: white;
        }

        .table th,
        .table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .table th {
            background: #f0f2f5;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
            color: #e43d40;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #888;
        }

        .info-box {
            background: white;
            padding: 15px;
            border-left: 4px solid #3498db;
            margin: 20px 0;
            border-radius: 0 4px 4px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body style="background-color: #f0f2f5; padding-top: 20px; padding-bottom: 20px;">
    <div class="container">
        <div class="header">
            <h1 style="margin:0; font-size: 24px;">¡Gracias por tu pedido!</h1>
            <p style="margin:5px 0 0 0; opacity:0.9;">AgriVall</p>
        </div>
        <div class="content">
            <p style="font-size: 16px;">Hola <strong>{{ $order->customer_name }}</strong>,</p>
            <p>Hemos recibido correctamente tu pedido <strong>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong>
                realizado el {{ $order->created_at->format('d/m/Y') }}.</p>

            <h3 style="border-bottom: 2px solid #eee; padding-bottom: 10px; color: #2c3e50;">Resumen de tu compra</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product ? $item->product->name : 'Producto' }} <small>({{ $item->format
                                }})</small></td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->unit_price, 2) }} €</td>
                        <td><strong>{{ number_format($item->quantity * $item->unit_price, 2) }} €</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                Total a pagar: {{ number_format($order->total, 2) }} €
            </div>

            <h3 style="border-bottom: 2px solid #eee; padding-bottom: 10px; color: #2c3e50; margin-top: 30px;">
                Instrucciones de Pago ({{ $order->payment_method }})</h3>

            <div class="info-box">
                @if($order->payment_method == 'Bizum')
                <p style="margin:0;">Realiza un Bizum de <strong>{{ number_format($order->total, 2) }} €</strong> al
                    número: <strong style="font-size:18px;">600 000 000</strong>.</p>
                @else
                <p style="margin:0;">Realiza una transferencia de <strong>{{ number_format($order->total, 2) }}
                        €</strong> a la cuenta: <strong style="font-size:16px;">ESXX 1234 5678 9012 3456</strong>.</p>
                @endif
                <p style="margin:10px 0 0 0; font-size: 14px; color:#555;"><strong>Importante:</strong> Indica tu nombre
                    completo y el número de pedido (#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}) en el concepto.
                </p>
            </div>

            <h3 style="border-bottom: 2px solid #eee; padding-bottom: 10px; color: #2c3e50;">Datos de Envío</h3>
            <div
                style="background:white; padding:15px; border-radius:4px; border:1px solid #eee; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <p style="margin:0; white-space: pre-line; line-height: 1.5;">{{ $order->shipping_address }}</p>
            </div>

            <p style="margin-top:30px; border-top: 1px solid #ddd; padding-top: 20px;">Una vez recibido el pago,
                procederemos a preparar y enviar tu pedido.</p>
            <p>Si tienes alguna duda con tu pedido, responde directamente a este correo electrónico.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} AgriVall. Todos los derechos reservados.</p>
            <p>Este es un correo automático, por favor no respondas si no es necesario.</p>
        </div>
    </div>
</body>

</html>