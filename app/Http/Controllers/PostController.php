<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    // Listado de posts
    public function index()
    {
        $posts = Post::orderByDesc('published_at')->paginate(6);

        return view('posts.index', compact('posts'));
    }

    // Post individual
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
