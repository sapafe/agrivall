<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog — AgriVall</title>
    <meta name="description" content="Últimas noticias de AgriVall: cultivo, ecología y cursos de agricultura.">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
</head>
<body>

@include('partials.header')

<main class="container section-container">
    <h1 class="section-title">Blog de Noticias</h1>

    {{-- Filtro por categoría --}}
    <div class="blog-filter">
        <form method="GET" action="{{ route('posts.index') }}" class="blog-filter-form">
            <label for="blog-category-select" class="blog-filter-label">
                <i class="fa-solid fa-filter"></i> Categoría
            </label>
            <select id="blog-category-select" name="type" class="blog-filter-select"
                    onchange="this.form.submit()">
                <option value="" {{ !$typeId ? 'selected' : '' }}>Todas las categorías</option>
                @foreach($postTypes as $type)
                    <option value="{{ $type->id }}" {{ $typeId == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- Grid de tarjetas --}}
    @if($posts->isEmpty())
    <div class="blog-empty">
        <i class="fa-solid fa-newspaper"></i>
        <p>No hay posts en esta categoría.</p>
    </div>
    @else
    <div class="blog-grid">
        @foreach ($posts as $post)
        <article class="blog-card">
            {{-- Imagen o fallback profesional --}}
            <img src="{{ $post->image && file_exists(public_path($post->image)) ? asset($post->image) : asset('img/blog-default.png') }}" 
                 alt="{{ $post->title }}" class="blog-card__img">

            {{-- Tipo --}}
            @if($post->type)
            <span class="blog-card__badge">{{ $post->type->name }}</span>
            @endif

            <div class="blog-card__body">
                <h3>{{ $post->title }}</h3>

                <p class="post-date">
                    <i class="fa-regular fa-calendar me-1"></i>
                    {{ $post->published_at->format('d/m/Y') }}
                </p>

                <p>{{ \Illuminate\Support\Str::limit($post->body, 140) }}</p>

                <a href="{{ route('posts.show', $post) }}" class="btn-secondary blog-card__btn">
                    Leer más <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </article>
        @endforeach
    </div>

    <div class="blog-pagination">
        {{ $posts->links('partials.pagination-agrivall') }}
    </div>
    @endif
</main>

</body>
</html>
