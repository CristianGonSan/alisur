@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-5">Clientes Registrados</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Ubicación</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>
                            <a href="{{ $client->location }}" title="Ver ubicación en Google Maps" target="_blank">
                                {{ $client->location }}
                            </a>
                        </td>
                        <td>{{ $client->email }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                      onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>
                                    </button>
                                </form>
                                <a href="{{ route('quotes.create', $client->id) }}" class="btn btn-primary btn-sm ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-chat-right-quote-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353zM7.194 4.766q.13.188.227.401c.428.948.393 2.377-.942 3.706a.446.446 0 0 1-.612.01.405.405 0 0 1-.011-.59c.419-.416.672-.831.809-1.22-.269.165-.588.26-.93.26C4.775 7.333 4 6.587 4 5.667S4.776 4 5.734 4c.271 0 .528.06.756.166l.008.004c.169.07.327.182.469.324q.128.125.227.272M11 7.073c-.269.165-.588.26-.93.26-.958 0-1.735-.746-1.735-1.666S9.112 4 10.069 4c.271 0 .528.06.756.166l.008.004c.17.07.327.182.469.324q.128.125.227.272.131.188.228.401c.428.948.392 2.377-.942 3.706a.446.446 0 0 1-.613.01.405.405 0 0 1-.011-.59c.42-.416.672-.831.81-1.22z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <style>
        .thead-dark {
            background-color: #343a40;
            color: white;
        }

        .btn-group .btn {
            margin-right: 5px;
        }
    </style>
@endsection
