@extends('layouts.admin')

@section('title', 'Editar Semana - Admin')

@section('content')
<div class="admin-header" style="margin-bottom: 20px;">
    <h1>Editar Semana {{ $week->week_number }} ({{ $week->year }})</h1>
    <p>{{ $week->descriptor }}</p>
</div>

<div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 500px;">
    <form action="{{ route('admin.weeks.update', $week) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="price" style="display: block; margin-bottom: 5px; font-weight: bold;">Precio (€)</label>
            <input type="number" name="price" id="price" value="{{ old('price', $week->price) }}" step="0.01" min="0" 
                style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="status" style="display: block; margin-bottom: 5px; font-weight: bold;">Estado</label>
            <select name="status" id="status" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
                <option value="LIBRE" {{ $week->status == 'LIBRE' ? 'selected' : '' }}>LIBRE</option>
                <option value="PRE-RESERVA" {{ $week->status == 'PRE-RESERVA' ? 'selected' : '' }}>PRE-RESERVA</option>
                <option value="RESERVADO" {{ $week->status == 'RESERVADO' ? 'selected' : '' }}>RESERVADO</option>
                <option value="NO DISPONIBLE" {{ $week->status == 'NO DISPONIBLE' ? 'selected' : '' }}>NO DISPONIBLE</option>
            </select>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="background: #2c3e50; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold;">
                Actualizar Semana
            </button>
            <a href="{{ route('admin.weeks.index') }}" style="background: #e2e3e5; color: #383d41; text-decoration: none; padding: 10px 20px; border-radius: 4px; font-weight: bold;">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
