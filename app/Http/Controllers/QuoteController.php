<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteProduct;
use Illuminate\Http\Request;

class QuoteController extends Controller


{
    public function index()
    {
        $quotes = Quote::with('client', 'quoteProducts.product')->get();
        return view('admin.quotes.index', compact('quotes'));
    }

    public function create($clientId)
    {
        $client = Client::findOrFail($clientId);
        $products = Product::all(); // Obtener todos los productos

        return view('admin.quotes.create', compact('client', 'products'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|json',
        ]);

        $quote = new Quote();
        $quote->client_id = $request->client_id;
        $quote->save();

        $products = json_decode($request->products, true);
        foreach ($products as $product) {
            $quoteProduct = new QuoteProduct();
            $quoteProduct->quote_id = $quote->id;
            $quoteProduct->product_id = $product['id'];
            $quoteProduct->price = $product['price'];
            $quoteProduct->save();
        }

        return redirect()->route('clients.index')->with('success', 'Cotización creada con éxito.');
    }
    // archivo QuoteController.php
    public function edit($id)
    {
        $quote = Quote::findOrFail($id);
        $clients = Client::all();
        $products = Product::all();

        return view('admin.quotes.edit', compact('quote', 'clients', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|json',
        ]);

        $quote = Quote::findOrFail($id);
        $quote->client_id = $request->client_id;
        $quote->save();

        QuoteProduct::where('quote_id', $quote->id)->delete();

        $products = json_decode($request->products, true);
        foreach ($products as $product) {
            $quoteProduct = new QuoteProduct();
            $quoteProduct->quote_id = $quote->id;
            $quoteProduct->product_id = $product['id'];
            $quoteProduct->price = $product['price'];
            $quoteProduct->save();
        }

        return redirect()->route('admin.quotes.index')->with('success', 'Cotización actualizada con éxito.');
    }

    public function destroy($id)
    {
        $quote = Quote::findOrFail($id);
        $quote->delete();

        return redirect()->route('admin.quotes.index')->with('success', 'Cotización eliminada con éxito.');
    }

}
