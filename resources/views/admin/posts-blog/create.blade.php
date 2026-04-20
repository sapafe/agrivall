@extends('layouts.admin')

@section('title', 'Nuevo Post')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h2 class="card-title h5 mb-0">
                    <i class="fa-solid fa-plus me-2 text-primary"></i>Nuevo Post
                </h2>
                <a href="{{ route('admin.posts-blog.index') }}" class="btn btn-sm btn-light border">
                    <i class="fa-solid fa-arrow-left me-1"></i>Volver
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.posts-blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Tipo de Post --}}
                    <div class="mb-3">
                        <label for="post_type_id" class="form-label">Tipo de Post <span class="text-danger">*</span></label>
                        <select class="form-select @error('post_type_id') is-invalid @enderror"
                                id="post_type_id" name="post_type_id" required>
                            <option value="" disabled {{ old('post_type_id') ? '' : 'selected' }}>Seleccionar tipo…</option>
                            @foreach($postTypes as $type)
                                <option value="{{ $type->id }}" {{ old('post_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('post_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Título --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Título <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title') }}"
                               required placeholder="Ej: Temporada de cosecha 2025" autofocus>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Cuerpo --}}
                    <div class="mb-3">
                        <label for="body" class="form-label">Cuerpo del post <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('body') is-invalid @enderror"
                                  id="body" name="body" rows="10"
                                  required placeholder="Escribe el contenido completo del post…">{{ old('body') }}</textarea>
                        @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Imagen (opcional) --}}
                    <div class="mb-4">
                        <label for="image" class="form-label">
                            Imagen <span class="text-muted fw-normal">(opcional)</span>
                        </label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                               id="image" name="image" accept="image/*">
                        <div class="form-text">
                            <i class="fa-solid fa-circle-info me-1"></i>
                            Si no se añade imagen, se mostrará una imagen de relleno en la página pública.
                            Formatos: JPG, PNG, WebP. Máx. 3 MB.
                        </div>
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Preview JS --}}
                        <div id="image-preview-wrap" class="mt-3 d-none">
                            <img id="image-preview" src="" alt="Preview"
                                 class="rounded border" style="max-height:200px;object-fit:cover;">
                        </div>
                    </div>

                    {{-- Fecha: info --}}
                    <div class="alert alert-light border mb-4 py-2 px-3 d-flex align-items-center gap-2">
                        <i class="fa-regular fa-calendar text-muted"></i>
                        <span class="small text-muted">
                            La fecha de publicación se asignará automáticamente al día de hoy:
                            <strong>{{ now()->format('d/m/Y') }}</strong>
                        </span>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.posts-blog.index') }}" class="btn btn-light border">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Publicar Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const wrap = document.getElementById('image-preview-wrap');
    const preview = document.getElementById('image-preview');
    const reader = new FileReader();
    reader.onload = e => {
        preview.src = e.target.result;
        wrap.classList.remove('d-none');
    };
    reader.readAsDataURL(file);
});
</script>
@endsection
