<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostType;

class PostController extends Controller
{
    // Listado de posts con filtro opcional por tipo
    public function index()
    {
        $postTypes = PostType::orderBy('name')->get();
        $typeId    = request('type');

        $posts = Post::with('type')
            ->when($typeId, fn ($q) => $q->where('post_type_id', $typeId))
            ->orderByDesc('published_at')
            ->paginate(6)
            ->withQueryString();

        return view('posts.index', compact('posts', 'postTypes', 'typeId'));
    }

    // Post individual
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
