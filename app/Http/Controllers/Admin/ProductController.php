<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'variety' => 'required|string|max:255',
            'format' => 'required|in:2Kg,5Kg',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'available' => 'boolean'
        ]);

        $data = $request->except('image');
        $data['available'] = $request->has('available');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('productos', 'public');
            $data['image'] = 'storage/' . $imagePath;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'variety' => 'required|string|max:255',
            'format' => 'required|in:2Kg,5Kg',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'available' => 'boolean'
        ]);

        $data = $request->except('image');
        $data['available'] = $request->has('available');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $product->image));
            }
            $imagePath = $request->file('image')->store('productos', 'public');
            $data['image'] = 'storage/' . $imagePath;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $product->image));
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado.');
    }
}