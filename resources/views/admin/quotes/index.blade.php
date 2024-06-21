<!-- archivo resources/views/admin/quotes/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Lista de Cotizaciones</h1>
                <a href="{{ route('clients.index') }}" class="btn btn-primary">Ver Clientes</a>
                <a href="{{ route('clients.create') }}" class="btn btn-primary ">Registrar Cliente</a>
            <a href="{{ route('admin.quotes.create', ['clientId' => 1]) }}" class="btn btn-primary">Crear Nueva Cotización</a>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Productos</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quotes as $quote)
                        <tr>
                            <td>{{ $quote->id }}</td>
                            <td>{{ $quote->client->name }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach($quote->quoteProducts as $quoteProduct)
                                        <li>{{ $quoteProduct->product->name }}: ${{ number_format($quoteProduct->price, 2) }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Acciones">
                                    <a href="{{ route('admin.quotes.edit', $quote->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('admin.quotes.destroy', $quote->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

