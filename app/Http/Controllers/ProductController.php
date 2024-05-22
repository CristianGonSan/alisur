<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('name', 'LIKE', '%' . $search . '%')->paginate(10);
        $products->appends(['search' => $search]);
        return view('products.index', compact('products'));

    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'technical_code' => 'required|unique:products',
            'unit' => 'required',
            'unit_price' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $products)
    {
        return view('products.index', compact('products'));
    }

    public function update(Request $request, Product $products)
    {
        $request->validate([
            'name' => 'required',
            'technical_code' => 'required|unique:products,technical_code,' . $products->id_producto,
            'unit' => 'required',
            'unit_price' => 'required|numeric',
        ]);

        $products->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $products)
    {
        $products->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
