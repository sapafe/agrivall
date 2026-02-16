<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Blog - AgriVall</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('estil.css') }}?v={{ filemtime(public_path('estil.css')) }}">
</head>
<body>

@include('partials.header')


<main class="container section-container">
    <h1 class="section-title">Blog</h1>

    <div class="blog-grid">
        @foreach ($posts as $post)
            <article class="blog-card">
                @if ($post->image)
                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                @endif

                <h3>{{ $post->title }}</h3>

                <p style="opacity:.7; margin-bottom:.75rem;">
                    {{ $post->published_at->format('d/m/Y') }}
                </p>

                <p>
                    {{ \Illuminate\Support\Str::limit($post->body, 140) }}
                </p>

                <a href="{{ route('posts.show', $post) }}" class="btn-secondary">
                    Leer más
                </a>
            </article>
        @endforeach
    </div>

    <div style="margin-top:2rem;">
        {{ $posts->links() }}
    </div>
</main>

</body>
</html>
