@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <h1 class="text-center mb-4">Detalles del Producto</h1>
        <div class="card shadow-lg border-0">
            <div class="card-header custom-header text-white">
                <h2>{{ $product->name }}</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Código Técnico:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $product->technical_code }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Unidad:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $product->unit }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Precio Unitario:</strong>
                    </div>
                    <div class="col-md-8">
                        ${{ $product->unit_price }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Ficha Técnica:</strong>
                    </div>
                    <div class="col-md-8">
                        @if($product->technical_sheet)
                            <a href="{{ $product->technical_sheet }}" target="_blank">Ver Ficha Técnica</a>
                        @else
                            No disponible
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Descripción:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $product->description }}
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-8 offset-md-7 text-center">
                        <button class="btn btn-primary btn-lg custom-btn">Agregar al Carrito</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
        }
        .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body {
            font-size: 1.1em;
        }
        .row {
            display: flex;
            align-items: center;
        }
        .custom-header {
            background-color: #272525;
        }
        .custom-btn {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            padding: 2px 2px;
            font-size: 0.8em; /* Tamaño de la fuente */
            border-radius: 5px;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .custom-btn:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
@endsection
