@extends('layouts.admin')

@section('title', 'Detalle de Pedido #' . $order->id)

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.orders.index') }}" style="text-decoration: none; color: #2c3e50;"><i
            class="fa-solid fa-arrow-left"></i> Volver a pedidos</a>
</div>

<div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 20px;">
        <div>
            <h2 style="margin: 0; margin-bottom: 5px;">Pedido #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h2>
            <span class="text-muted">Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</span>
        </div>

        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST"
            style="display: flex; gap: 10px; align-items: center;">
            @csrf
            @method('PUT')
            <label for="status" style="margin:0;">Estado:</label>
            <select name="status" id="status" style="padding: 8px; border-radius: 4px; border: 1px solid #ddd;">
                <option value="INICIADO" {{ $order->status == 'INICIADO' ? 'selected' : '' }}>INICIADO</option>
                <option value="EN PROCESO" {{ $order->status == 'EN PROCESO' ? 'selected' : '' }}>EN PROCESO</option>
                <option value="REPARTO" {{ $order->status == 'REPARTO' ? 'selected' : '' }}>REPARTO</option>
                <option value="FINALIZADO" {{ $order->status == 'FINALIZADO' ? 'selected' : '' }}>FINALIZADO</option>
            </select>
            <button type="submit" class="btn-primary" style="padding: 8px 15px;">Actualizar</button>
        </form>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
        <div style="background: #f8f9fa; padding: 15px; border-radius: 4px;">
            <h3 style="margin-top: 0; font-size: 16px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">Datos del
                Cliente</h3>
            <p><strong>Nombre:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Teléfono:</strong> {{ $order->customer_phone }}</p>
        </div>
        <div style="background: #f8f9fa; padding: 15px; border-radius: 4px;">
            <h3 style="margin-top: 0; font-size: 16px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">Datos de
                Envío y Pago</h3>
            <p><strong>Dirección:</strong><br>{{ $order->shipping_address }}</p>
            <p><strong>Método de pago:</strong> {{ $order->payment_method }}</p>
        </div>
    </div>

    <h3
        style="margin-top: 0; font-size: 18px; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
        Artículos del Pedido</h3>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Formato</th>
                <th>Cantidad</th>
                <th>Precio Unit.</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product ? $item->product->name : 'Producto eliminado' }} {{ $item->product ?
                    $item->product->variety : '' }}</td>
                <td>{{ $item->format }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price, 2) }} €</td>
                <td>{{ number_format($item->quantity * $item->unit_price, 2) }} €</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right; font-weight: bold; padding: 15px;">Total:</td>
                <td style="font-weight: bold; font-size: 18px; padding: 15px;">{{ number_format($order->total, 2) }} €
                </td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection