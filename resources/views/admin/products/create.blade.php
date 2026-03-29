@extends('layouts.admin')

@section('title', 'Añadir Producto')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h2 class="card-title h5 mb-0">Añadir Nuevo Producto</h2>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required placeholder="Ej: Manzanas Fuji">
                    </div>

                    <div class="mb-3">
                        <label for="variety" class="form-label">Variedad</label>
                        <input type="text" class="form-control" id="variety" name="variety" value="{{ old('variety') }}" required placeholder="Ej: Fuji / Golden">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="format" class="form-label">Formato</label>
                            <select class="form-select" id="format" name="format" required>
                                <option value="" disabled {{ old('format') ? '' : 'selected' }}>Seleccionar...</option>
                                <option value="2Kg" {{ old('format')=='2Kg' ? 'selected' : '' }}>2Kg</option>
                                <option value="5Kg" {{ old('format')=='5Kg' ? 'selected' : '' }}>5Kg</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Precio (€)</label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required placeholder="0.00">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="form-text">Tamaño recomendado: 800x800px.</div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="available" name="available" value="1" {{ old('available', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="available">Producto disponible para la venta</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-light border">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Guardar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection