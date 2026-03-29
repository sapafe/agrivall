<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }} - AgriVall</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/base.css', 'resources/css/blog.css'])
</head>
<body>

@include('partials.header')


<main class="container section-container post-detail">
    <h1 class="section-title">{{ $post->title }}</h1>

    <p class="post-date">
        {{ $post->published_at->format('d/m/Y') }}
    </p>

    @if ($post->image)
        <img
            src="{{ asset($post->image) }}"
            alt="{{ $post->title }}"
        >
    @endif

    <div class="post-content">
        {{ $post->body }}
    </div>
</main>

</body>
</html>
