@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-5 text-primary">Editar Producto</h1>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Detalles del Producto</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.update', $product->id_producto) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-4">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="technical_code" class="form-label">Código Técnico:</label>
                        <input type="text" class="form-control" id="technical_code" name="technical_code" value="{{ $product->technical_code }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="unit" class="form-label">Unidad:</label>
                        <input type="text" class="form-control" id="unit" name="unit" value="{{ $product->unit }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="description" class="form-label">Descripción:</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="technical_sheet" class="form-label">Ficha Técnica:</label>
                        <input type="url" class="form-control" id="technical_sheet" name="technical_sheet" value="{{ $product->technical_sheet }}">
                        @if ($product->technical_sheet)
                            <small class="form-text text-muted">
                                <a href="{{ $product->technical_sheet }}" target="_blank">Ver Ficha Técnica Actual</a>
                            </small>
                        @endif
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">Actualizar Producto</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-lg">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .form-label {
            font-weight: bold;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
@endsection
