@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1>Productos</h1>
    <a href="{{ route('admin.products.create') }}" class="btn-primary">Añadir Producto</a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Variedad</th>
            <th>Formato</th>
            <th>Precio</th>
            <th>Disponible</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>
                @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                @else
                <span style="color: #999;">Sin imagen</span>
                @endif
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->variety }}</td>
            <td>{{ $product->format }}</td>
            <td>{{ number_format($product->price, 2) }} €</td>
            <td>{{ $product->available ? 'Sí' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn-secondary"
                    style="padding: 5px 10px; font-size: 14px;">Editar</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                    style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-primary"
                        style="background: #e74c3c; padding: 5px 10px; font-size: 14px;"
                        onclick="return confirm('¿Borrar producto?')">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
        @if($products->isEmpty())
        <tr>
            <td colspan="8" style="text-align: center; padding: 20px;">No hay productos registrados.</td>
        </tr>
        @endif
    </tbody>
</table>
@endsection