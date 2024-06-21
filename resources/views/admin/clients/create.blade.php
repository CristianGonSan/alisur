@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center font-weight-bold">
                        Registrar Nuevo Cliente
                    </div>

                    <div class="card-body bg-light">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('clients.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="font-weight-bold">Teléfono</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label for="location" class="font-weight-bold">Ubicación (URL)</label>
                                <input type="text" class="form-control" id="location" name="location" required>
                            </div>

                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg">Registrar Cliente</button>
                                <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary btn-lg">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 10px;
        }
        .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .btn {
            margin-top: 10px;
        }
    </style>
@endsection
