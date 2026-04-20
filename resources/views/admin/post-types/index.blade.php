@extends('layouts.admin')

@section('title', 'Tipos de Post')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2"><i class="fa-solid fa-tags me-2 text-success"></i>Tipos de Post</h1>
    <a href="{{ route('admin.post-types.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i>Nuevo Tipo
    </a>
</div>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width:60px">ID</th>
                        <th>Nombre</th>
                        <th class="text-center" style="width:130px">Noticias</th>
                        <th class="pe-4 text-end" style="width:120px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($postTypes as $postType)
                    <tr>
                        <td class="ps-4 text-muted">{{ $postType->id }}</td>
                        <td>
                            <strong>{{ $postType->name }}</strong>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                                {{ $postType->posts_count }}
                            </span>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.post-types.edit', $postType) }}"
                                   class="btn btn-outline-secondary" title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.post-types.destroy', $postType) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Eliminar"
                                            onclick="return confirm('¿Eliminar el tipo «{{ $postType->name }}»?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-tags d-block mb-2 fs-3"></i>
                            No hay tipos de post registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
