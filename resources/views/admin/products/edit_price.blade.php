@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-5 text-primary">Editar Precio de Producto</h1>

        <form action="{{ route('admin.products.update_price', $product->id_producto) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="unit_price">Precio Unitario</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    </div>
                    <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" value="{{ $product->unit_price }}" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Precio</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <style>
        .input-group-prepend .input-group-text {
            background-color: #ffffff;
            border-right: 0;
        }
        .input-group .form-control {
            border-left: 0;
        }
    </style>
@endsection
