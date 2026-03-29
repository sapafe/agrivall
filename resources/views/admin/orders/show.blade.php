@extends('layouts.admin')

@section('title', 'Detalle de Pedido #' . $order->id)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-link text-decoration-none p-0 text-secondary">
        <i class="fa-solid fa-arrow-left me-2"></i>Volver a la lista de pedidos
    </a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="h5 mb-0">Pedido <span class="text-primary">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span></h2>
            <small class="text-muted">Realizado el {{ $order->created_at->format('d/m/Y H:i') }}</small>
        </div>
        
        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-flex gap-2">
            @csrf
            @method('PUT')
            <select name="status" id="status" class="form-select form-select-sm w-auto">
                <option value="INICIADO" {{ $order->status == 'INICIADO' ? 'selected' : '' }}>INICIADO</option>
                <option value="EN PROCESO" {{ $order->status == 'EN PROCESO' ? 'selected' : '' }}>EN PROCESO</option>
                <option value="REPARTO" {{ $order->status == 'REPARTO' ? 'selected' : '' }}>REPARTO</option>
                <option value="FINALIZADO" {{ $order->status == 'FINALIZADO' ? 'selected' : '' }}>FINALIZADO</option>
            </select>
            <button type="submit" class="btn btn-sm btn-primary">Actualizar Estado</button>
        </form>
    </div>
    
    <div class="card-body p-4">
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="p-3 border rounded bg-light-subtle h-100">
                    <h3 class="h6 text-uppercase fw-bold text-muted border-bottom pb-2 mb-3">
                        <i class="fa-solid fa-user me-2"></i>Datos del Cliente
                    </h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><strong>Nombre:</strong> {{ $order->customer_name }}</li>
                        <li class="mb-2"><strong>Email:</strong> <a href="mailto:{{ $order->customer_email }}" class="text-decoration-none">{{ $order->customer_email }}</a></li>
                        <li><strong>Teléfono:</strong> {{ $order->customer_phone }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 border rounded bg-light-subtle h-100">
                    <h3 class="h6 text-uppercase fw-bold text-muted border-bottom pb-2 mb-3">
                        <i class="fa-solid fa-truck me-2"></i>Envío y Pago
                    </h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><strong>Dirección:</strong> {{ $order->shipping_address }}</li>
                        <li><strong>Método de pago:</strong> <span class="badge bg-secondary-subtle text-secondary-emphasis">{{ $order->payment_method }}</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <h3 class="h6 text-uppercase fw-bold text-muted border-bottom pb-2 mb-3">Artículos del Pedido</h3>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Producto</th>
                        <th class="text-center">Formato</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-end">Precio Unit.</th>
                        <th class="text-end pe-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold">{{ $item->product ? $item->product->name : 'Producto eliminado' }}</div>
                            @if($item->product)
                                <small class="text-muted">{{ $item->product->variety }}</small>
                            @endif
                        </td>
                        <td class="text-center"><span class="badge bg-light text-dark border">{{ $item->format }}</span></td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-end">{{ number_format($item->unit_price, 2) }} €</td>
                        <td class="text-end pe-3 fw-bold">{{ number_format($item->quantity * $item->unit_price, 2) }} €</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="4" class="text-end fw-bold py-3 fs-5">TOTAL:</td>
                        <td class="text-end pe-3 fw-bold text-primary py-3 fs-5">{{ number_format($order->total, 2) }} €</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection