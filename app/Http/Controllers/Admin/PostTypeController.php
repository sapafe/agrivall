<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostType;
use Illuminate\Http\Request;

class PostTypeController extends Controller
{
    public function index()
    {
        $postTypes = PostType::withCount('posts')->orderBy('name')->get();
        return view('admin.post-types.index', compact('postTypes'));
    }

    public function create()
    {
        return view('admin.post-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:post_types,name',
        ]);

        PostType::create(['name' => $request->name]);

        return redirect()->route('admin.post-types.index')
            ->with('success', 'Tipo de post creado correctamente.');
    }

    public function edit(PostType $postType)
    {
        return view('admin.post-types.edit', compact('postType'));
    }

    public function update(Request $request, PostType $postType)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:post_types,name,' . $postType->id,
        ]);

        $postType->update(['name' => $request->name]);

        return redirect()->route('admin.post-types.index')
            ->with('success', 'Tipo de post actualizado correctamente.');
    }

    public function destroy(PostType $postType)
    {
        if ($postType->posts()->exists()) {
            return redirect()->route('admin.post-types.index')
                ->with('error', 'No se puede eliminar un tipo que tiene posts asociados.');
        }

        $postType->delete();

        return redirect()->route('admin.post-types.index')
            ->with('success', 'Tipo de post eliminado.');
    }
}
