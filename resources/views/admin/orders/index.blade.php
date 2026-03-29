@extends('layouts.admin')

@section('title', 'Gestión de Pedidos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Pedidos Recibidos</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID Pedido</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Pago</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th class="pe-4 text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="ps-4">
                            <span class="text-primary fw-bold">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="fw-bold">{{ $order->customer_name }}</div>
                            <small class="text-muted">{{ $order->customer_email }}</small>
                        </td>
                        <td><small class="text-uppercase fw-semibold">{{ $order->payment_method }}</small></td>
                        <td class="fw-bold">{{ number_format($order->total, 2) }} €</td>
                        <td>
                            @php
                                $statusClass = match($order->status) {
                                    'INICIADO' => 'bg-info-subtle text-info border border-info-subtle',
                                    'EN PROCESO' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                                    'REPARTO' => 'bg-primary-subtle text-primary border border-primary-subtle',
                                    'FINALIZADO' => 'bg-success-subtle text-success border border-success-subtle',
                                    default => 'bg-light text-dark border'
                                };
                            @endphp
                            <span class="badge {{ $statusClass }} rounded-pill px-3">{{ $order->status }}</span>
                        </td>
                        <td class="pe-4 text-end">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-eye me-1"></i>Detalles
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @if($orders->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-receipt d-block mb-2 fs-3"></i>
                            No hay pedidos registrados.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection