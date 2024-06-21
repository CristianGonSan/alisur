<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'location' => 'required',
            'email' => 'required|email|unique:clients',
        ]);

        // Creación del cliente
        Client::create($request->all());

        // Redirección a la lista de clientes con mensaje de éxito
        return redirect()->route('clients.create')
            ->with('success', 'Cliente registrado correctamente.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado con éxito.');
    }
}
