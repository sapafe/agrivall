@extends('layouts.admin')

@section('title', 'Gestión de Semanas - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Gestión de Semanas</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Año / Semana</th>
                        <th>Descriptor</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th class="pe-4 text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($weeks as $week)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold">{{ $week->year }}</span> / 
                            <span class="text-muted">Semana {{ $week->week_number }}</span>
                        </td>
                        <td>{{ $week->descriptor }}</td>
                        <td class="fw-bold">{{ number_format($week->price, 2) }} €</td>
                        <td>
                            @php
                                $statusClass = match($week->status) {
                                    'LIBRE' => 'bg-success-subtle text-success border border-success-subtle',
                                    'PRE-RESERVA' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                                    'RESERVADO' => 'bg-danger-subtle text-danger border border-danger-subtle',
                                    default => 'bg-light text-dark border'
                                };
                            @endphp
                            <span class="badge {{ $statusClass }} rounded-pill px-3">{{ $week->status }}</span>
                        </td>
                        <td class="pe-4 text-end">
                            <a href="{{ route('admin.weeks.edit', $week) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen-to-square me-1"></i>Editar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
