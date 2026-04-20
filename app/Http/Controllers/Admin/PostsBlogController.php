<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsBlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('type')->latest()->paginate(15);
        return view('admin.posts-blog.index', compact('posts'));
    }

    public function create()
    {
        $postTypes = PostType::orderBy('name')->get();
        return view('admin.posts-blog.create', compact('postTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_type_id' => 'required|exists:post_types,id',
            'title'        => 'required|string|max:255',
            'body'         => 'required|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->only(['post_type_id', 'title', 'body']);
        $data['published_at'] = now()->toDateString();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = 'storage/' . $path;
        }

        Post::create($data);

        return redirect()->route('admin.posts-blog.index')
            ->with('success', 'Noticia publicada correctamente.');
    }

    public function edit(Post $postsBlog)
    {
        $postTypes = PostType::orderBy('name')->get();
        return view('admin.posts-blog.edit', compact('postsBlog', 'postTypes'));
    }

    public function update(Request $request, Post $postsBlog)
    {
        $request->validate([
            'post_type_id' => 'required|exists:post_types,id',
            'title'        => 'required|string|max:255',
            'body'         => 'required|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->only(['post_type_id', 'title', 'body']);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($postsBlog->image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $postsBlog->image));
            }
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = 'storage/' . $path;
        }

        // Borrar imagen si se marcó el checkbox
        if ($request->boolean('remove_image') && $postsBlog->image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $postsBlog->image));
            $data['image'] = null;
        }

        $postsBlog->update($data);

        return redirect()->route('admin.posts-blog.index')
            ->with('success', 'Noticia actualizada correctamente.');
    }

    public function destroy(Post $postsBlog)
    {
        if ($postsBlog->image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $postsBlog->image));
        }

        $postsBlog->delete();

        return redirect()->route('admin.posts-blog.index')
            ->with('success', 'Noticia eliminada correctamente.');
    }
}
