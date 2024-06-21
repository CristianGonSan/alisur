@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h1 class="text-center mb-5 text-primary">ADMINISTRACIÓN DE PRODUCTOS</h1>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Listado de Productos</h3>
                <a href="{{ route('admin.products.create') }}" class="btn btn-outline-light mb-3" title="Agregar Producto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path
                            d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm-.5-7.5a.5.5 0 0 1 .5.5V11h2.5a.5.5 0 0 1 0 1H8.5v2.5a.5.5 0 0 1-1 0V12H4.5a.5.5 0 0 1 0-1H7V8.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    Agregar Producto
                </a>
            </div>

            <div class="card-body">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">{{ $product->name }}</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Código Técnico:</strong> {{ $product->technical_code }}</p>
                                    <p><strong>Unidad:</strong> {{ $product->unit }}</p>
                                    <p><strong>Precio Unitario:</strong> ${{ $product->unit_price }}</p>
                                    <p><strong>Descripción:</strong> {{ $product->description }}</p>
                                    <p><strong>Ficha Técnica:</strong>
                                        @if ($product->technical_sheet)
                                            <a href="{{ $product->technical_sheet }}" target="_blank"
                                               class="btn btn-link">Ver Ficha Técnica</a>
                                        @else
                                            No disponible
                                        @endif
                                    </p>
                                </div>
                                <hr class="m-0"> <!-- Línea divisoria -->
                                <div class="card-footer bg-white border-top-0 d-flex justify-content-end">
                                    <a href="{{ route('admin.products.edit', $product->id_producto) }}"
                                       class="btn btn-primary btn-sm mr-2" title="Editar Producto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd"
                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.products.edit_price', $product->id_producto) }}"
                                       class="btn btn-warning btn-sm mr-2" title="Editar Precio">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                            <path
                                                d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.products.price_history', $product->id_producto) }}"
                                       class="btn btn-info btn-sm mr-2" title="Historial de Precios">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                            <path
                                                d="M8.515 3.05a5 5 0 1 0 0 9.9 5 5 0 0 0 0-9.9zM8 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1zm.5 7.5V5a.5.5 0 0 0-1 0v3.5H5a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5z"/>
                                            <path d="M8.515 8.5h-1v2.5h1V8.5z"/>
                                        </svg>

                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id_producto) }}"
                                          method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de eliminar este producto?')" title="Eliminar Producto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <style>
        .card {
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px; /* Espacio entre tarjetas */
        }

        .card-header {
            background-color: #343a40;
            color: white;
            padding: 10px 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            padding: 15px;
        }

        .card-footer {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-top: 0;
            padding: 10px 15px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .card-footer .btn {
            margin-right: 8px; /* Añadido margen derecho para separar los botones */
        }

        .btn svg {
            margin-bottom: 5px;
            margin-right: 5px;
        }

        .btn-link {
            color: #007bff;
            padding: 0;
            font-size: 0.875rem;
        }

        hr {
            margin-top: 0;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .col-lg-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>

@endsection
