@extends('layouts.admin')

@section('title', 'Añadir Producto')

@section('content')
<div
    style="max-width: 600px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px;">Añadir Producto</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="reserva-form">
        @csrf

        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <label for="variety">Variedad:</label>
        <input type="text" id="variety" name="variety" value="{{ old('variety') }}" required>

        <label for="format">Formato:</label>
        <select id="format" name="format" required
            style="width:100%; padding:10px; border:1px solid #ddd; margin-top:5px; margin-bottom:15px; border-radius: 4px; font-family: inherit;">
            <option value="2Kg" {{ old('format')=='2Kg' ? 'selected' : '' }}>2Kg</option>
            <option value="5Kg" {{ old('format')=='5Kg' ? 'selected' : '' }}>5Kg</option>
        </select>

        <label for="price">Precio (€):</label>
        <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}" required>

        <label for="image">Imagen:</label>
        <input type="file" id="image" name="image" accept="image/*"
            style="margin-top:5px; margin-bottom: 15px; display: block;">

        <label style="display:flex; align-items:center; gap: 10px; margin-bottom: 20px;">
            <input type="checkbox" name="available" value="1" {{ old('available', true) ? 'checked' : '' }}
                style="width:auto; margin:0;">
            Disponible
        </label>

        <button type="submit" class="btn-primary">Guardar Producto</button>
        <a href="{{ route('admin.products.index') }}" class="btn-secondary"
            style="margin-left: 10px; display: inline-block;">Cancelar</a>
    </form>
</div>
@endsection