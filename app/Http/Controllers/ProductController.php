<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return Inertia::render('products/Index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        return Inertia::render('products/Create', []);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'description' => 'nullable|string'
        ]);

        Product::create($data);

        return redirect()->route('products.index')
            ->with('message', 'Product created succesfully!');
    }

    public function edit(Product $product)
    {
        return Inertia::render('products/Edit', [
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'description' => 'nullable|string'
        ]);

        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('products.index')
            ->with('message', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('message', 'Product deleted successfully!');
    }
}
