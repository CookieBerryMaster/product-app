<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los productos con su categoría relacionada (eager loading)
        $products = Product::with('category')->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todas las categorías para el select
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Crear producto
        Product::create($request->only('name', 'price', 'description', 'category_id'));

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar producto con su categoría
        $product = Product::with('category')->findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only('name', 'price', 'description', 'category_id'));

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
