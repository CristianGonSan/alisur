<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\QuoteController;
use App\Models\Client;
use App\Models\Quote;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class QuoteControllerTest extends TestCase
{
    public function create($clientId)
    {
        $client = Client::findOrFail($clientId);
        return view('quotes.create', compact('client'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'description' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $quote = new Quote();
        $quote->client_id = $request->client_id;
        $quote->description = $request->description;
        $quote->amount = $request->amount;
        $quote->save();

        return redirect()->route('clients.index')->with('success', 'Cotización creada con éxito.');
    }
}
