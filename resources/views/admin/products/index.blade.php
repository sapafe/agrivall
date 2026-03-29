@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Productos</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i>Añadir Producto
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Variedad</th>
                        <th>Formato</th>
                        <th>Precio</th>
                        <th>Disponible</th>
                        <th class="pe-4 text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="ps-4">{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                class="rounded" style="width: 45px; height: 45px; object-fit: cover;">
                            @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 45px; height: 45px;">
                                <i class="fa-solid fa-image"></i>
                            </div>
                            @endif
                        </td>
                        <td><strong>{{ $product->name }}</strong></td>
                        <td>{{ $product->variety }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $product->format }}</span></td>
                        <td>{{ number_format($product->price, 2) }} €</td>
                        <td>
                            @if($product->available)
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Disponible</span>
                            @else
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle">No disponible</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-secondary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Borrar producto?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($products->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-box-open d-block mb-2 fs-3"></i>
                            No hay productos registrados.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection