<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id_producto', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'technical_code' => 'required|unique:products',
            'unit' => 'required',
            'unit_price' => 'required|numeric',
        ]);

        Product::create($request->all());
        return redirect()->route('admin.products.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit($id_producto)
    {
        $product = Product::findOrFail($id_producto);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id_producto)
    {
        $product = Product::findOrFail($id_producto);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
