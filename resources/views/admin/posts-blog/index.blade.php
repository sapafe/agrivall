@extends('layouts.admin')

@section('title', 'Gestión de Posts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2"><i class="fa-solid fa-newspaper me-2 text-success"></i>Posts del Blog</h1>
    <a href="{{ route('admin.posts-blog.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i>Nuevo Post
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width:60px">ID</th>
                        <th style="width:70px">Imagen</th>
                        <th>Título</th>
                        <th style="width:130px">Tipo</th>
                        <th style="width:130px">Publicado</th>
                        <th class="pe-4 text-end" style="width:120px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td class="ps-4 text-muted">{{ $post->id }}</td>
                        <td>
                            @if($post->image)
                                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}"
                                     class="rounded" style="width:45px;height:45px;object-fit:cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted"
                                     style="width:45px;height:45px;">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $post->title }}</strong>
                            <div class="text-muted small text-truncate" style="max-width:300px;">
                                {{ \Illuminate\Support\Str::limit($post->body, 80) }}
                            </div>
                        </td>
                        <td>
                            @if($post->type)
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    {{ $post->type->name }}
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td class="text-muted small">
                            {{ $post->published_at->format('d/m/Y') }}
                        </td>
                        <td class="pe-4 text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('posts.show', $post) }}" target="_blank"
                                   class="btn btn-outline-info" title="Ver en el front">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.posts-blog.edit', $post) }}"
                                   class="btn btn-outline-secondary" title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.posts-blog.destroy', $post) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Eliminar"
                                            onclick="return confirm('¿Eliminar el post «{{ addslashes($post->title) }}»?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-newspaper d-block mb-2 fs-3"></i>
                            No hay posts publicados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($posts->hasPages())
    <div class="card-footer bg-white d-flex justify-content-center py-3">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection
