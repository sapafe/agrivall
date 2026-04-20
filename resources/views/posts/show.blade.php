<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} — AgriVall Blog</title>
    <meta name="description" content="{{ \Illuminate\Support\Str::limit($post->body, 160) }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
</head>
<body>

@include('partials.header')

<main class="container section-container post-detail">

    {{-- Volver --}}
    <a href="{{ route('posts.index') }}" class="post-back">
        <i class="fa-solid fa-arrow-left me-1"></i>Volver a Noticias
    </a>

    {{-- Badge de tipo --}}
    @if($post->type)
    <div class="post-detail__type">
        <span class="blog-card__badge">{{ $post->type->name }}</span>
    </div>
    @endif

    <h1 class="section-title" style="text-align:left;margin-top:1rem;">{{ $post->title }}</h1>

    <p class="post-date">
        <i class="fa-regular fa-calendar me-1"></i>
        Publicado el {{ $post->published_at->format('d \d\e F \d\e Y') }}
    </p>

    {{-- Imagen o fallback profesional --}}
    <img src="{{ $post->image && file_exists(public_path($post->image)) ? asset($post->image) : asset('img/blog-default.png') }}" 
         alt="{{ $post->title }}" class="post-detail__img">

    <div class="post-content">
        {{ $post->body }}
    </div>

    {{-- Pie de noticia --}}
    <div class="post-detail__footer">
        <a href="{{ route('posts.index') }}" class="btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>Volver al Blog
        </a>
    </div>

</main>

</body>
</html>
