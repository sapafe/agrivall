@extends('layouts.admin')

@section('title', 'Nuevo Tipo de Post')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h2 class="card-title h5 mb-0">
                    <i class="fa-solid fa-plus me-2 text-primary"></i>Nuevo Tipo de Post
                </h2>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.post-types.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label">Nombre del tipo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}"
                               required placeholder="Ej: Cultivo, Ecología, Cursos…" autofocus>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.post-types.index') }}" class="btn btn-light border">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
