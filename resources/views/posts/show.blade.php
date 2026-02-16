<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }} - AgriVall</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('estil.css') }}?v={{ filemtime(public_path('estil.css')) }}">
</head>
<body>

@include('partials.header')


<main class="container section-container" style="max-width:900px;">
    <h1>{{ $post->title }}</h1>

    <p style="opacity:.7; margin-bottom:1.5rem;">
        {{ $post->published_at->format('d/m/Y') }}
    </p>

    @if ($post->image)
        <img
            src="{{ asset($post->image) }}"
            alt="{{ $post->title }}"
            style="width:100%; max-height:420px; object-fit:cover; border-radius:12px; margin-bottom:1.5rem;"
        >
    @endif

    <div style="white-space: pre-line; font-size:1.05rem;">
        {{ $post->body }}
    </div>
</main>

</body>
</html>
