@extends('layouts.admin')

@section('title', 'Gestión de Pedidos')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1>Pedidos Recibidos</h1>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID Pedido</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Método de Pago</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
            <td>
                {{ $order->customer_name }}<br>
                <small style="color:#666;">{{ $order->customer_email }}</small>
            </td>
            <td>{{ $order->payment_method }}</td>
            <td>{{ number_format($order->total, 2) }} €</td>
            <td>
                <span style="padding: 4px 8px; border-radius: 4px; font-size: 14px; 
                            @if($order->status == 'INICIADO') background: #cce5ff; color: #004085;
                            @elseif($order->status == 'EN PROCESO') background: #fff3cd; color: #856404;
                            @elseif($order->status == 'REPARTO') background: #d4edda; color: #155724;
                            @elseif($order->status == 'FINALIZADO') background: #e2e3e5; color: #383d41;
                            @else background: #f8f9fa; color: #333; @endif
                        ">
                    {{ $order->status }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.orders.show', $order) }}" class="btn-primary"
                    style="padding: 5px 10px; font-size: 14px; text-decoration: none;">Ver Detalles</a>
            </td>
        </tr>
        @endforeach
        @if($orders->isEmpty())
        <tr>
            <td colspan="7" style="text-align: center; padding: 20px;">No hay pedidos registrados.</td>
        </tr>
        @endif
    </tbody>
</table>
@endsection