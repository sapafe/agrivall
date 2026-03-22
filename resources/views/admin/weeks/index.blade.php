@extends('layouts.admin')

@section('title', 'Gestión de Semanas - Admin')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1>Gestión de Semanas</h1>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>Año</th>
            <th>Semana</th>
            <th>Descriptor</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($weeks as $week)
        <tr>
            <td>{{ $week->year }}</td>
            <td>{{ $week->week_number }}</td>
            <td>{{ $week->descriptor }}</td>
            <td>€{{ number_format($week->price, 2) }}</td>
            <td>
                <span style="padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: bold; 
                    @if($week->status == 'LIBRE') background: #d4edda; color: #155724;
                    @elseif($week->status == 'PRE-RESERVA') background: #fff3cd; color: #856404;
                    @elseif($week->status == 'RESERVADO') background: #f8d7da; color: #721c24;
                    @else background: #e2e3e5; color: #383d41; @endif">
                    {{ $week->status }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.weeks.edit', $week) }}" class="btn-sm" style="color: #2c3e50;"><i class="fa-solid fa-edit"></i> Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
