@extends('layouts.admin')

@section('title', 'Editar Semana - Admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h2 class="card-title h5 mb-0">Editar Semana {{ $week->week_number }} ({{ $week->year }})</h2>
                <small class="text-muted">{{ $week->descriptor }}</small>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.weeks.update', $week) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="price" class="form-label fw-bold">Precio (€)</label>
                        <div class="input-group">
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $week->price) }}" step="0.01" min="0" required>
                            <span class="input-group-text">€</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label fw-bold">Estado de Disponibilidad</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="LIBRE" {{ $week->status == 'LIBRE' ? 'selected' : '' }}>LIBRE</option>
                            <option value="PRE-RESERVA" {{ $week->status == 'PRE-RESERVA' ? 'selected' : '' }}>PRE-RESERVA</option>
                            <option value="RESERVADO" {{ $week->status == 'RESERVADO' ? 'selected' : '' }}>RESERVADO</option>
                            <option value="NO DISPONIBLE" {{ $week->status == 'NO DISPONIBLE' ? 'selected' : '' }}>NO DISPONIBLE</option>
                        </select>
                        <div class="form-text">Actualiza el estado para bloquear o liberar la semana en el calendario.</div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.weeks.index') }}" class="btn btn-light border">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Actualizar Semana
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
