@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">PRODUCTOS</h1>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <form action="{{ route('products.search') }}" method="GET" class="form-inline my-2 my-lg-0">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Buscar Por Nombre" aria-label="Buscar" name="search">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="submit" id="searchButton">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 9.344a5.5 5.5 0 1 0-1.397 1.397l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM10.5 7.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                @foreach ($products as $product)
                    <div class="col-md-12 mb-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-header custom-header text-white">
                                <h5 class="card-title">{{ $product->name }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <strong>Código Técnico:</strong> {{ $product->technical_code }}<br>
                                    <strong>Unidad:</strong> {{ $product->unit }}<br>
                                    <strong>Precio Unitario:</strong> ${{ $product->unit_price }}<br>
                                    <strong>Descripción:</strong> {{ $product->description }}<br>
                                    <a href="{{ route('products.show', $product->id_producto) }}" class="btn btn-primary" style="background-color: #5389C7;">Ver más</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                {{ $products->links() }}
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
        .card-header.custom-header {
            background-color: #272525;
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
    </style>
@endsection
