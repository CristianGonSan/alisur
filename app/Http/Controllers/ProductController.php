<?php

namespace App\Http\Controllers;

use App\Models\PriceHistory;
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
        $priceHistory = $product->priceHistory()->orderBy('created_at')->get();

        $chartData = [
            'dates' => $priceHistory->pluck('created_at')->map(function($date) {
                return $date->format('Y-m-d');
            }),
            'prices' => $priceHistory->pluck('unit_price')
        ];

        return view('products.show', compact('product', 'chartData'));
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


//Metodos de el controlador de Historial de precio
    public function showPriceHistory($id)
    {
        $product = Product::findOrFail($id);
        $priceHistory = $product->priceHistory()->orderBy('created_at')->get();

        return view('admin.products.price_history', compact('product', 'priceHistory'));
    }

    public function editPrice($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.edit_price', compact('product'));
    }

    public function updatePrice(Request $request, $id)
    {
        $request->validate([
            'unit_price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $oldPrice = $product->unit_price;
        $newPrice = $request->unit_price;

        // Guardar el historial de precios solo si el precio ha cambiado
        if ($oldPrice != $newPrice) {
            PriceHistory::create([
                'product_id' => $product->id_producto,
                'unit_price' => $newPrice,
            ]);

            $product->unit_price = $newPrice;
            $product->save();
        }

        return redirect()->route('admin.products.index')->with('success', 'Precio actualizado con éxito');
    }


    public function destroyPriceHistory($id)
    {
        $priceHistory = PriceHistory::findOrFail($id);
        $priceHistory->delete();

        return redirect()->back()->with('success', 'Registro de precio eliminado con éxito.');
    }
}

