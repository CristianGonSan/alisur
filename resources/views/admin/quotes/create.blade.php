@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Crear Cotización para {{ $client->name }}</h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif

        <form action="{{ route('quotes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <input type="hidden" name="products" id="products-input" value="">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
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
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-md-12 mb-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-header custom-header text-white" style="background-color: #007bff;">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                    </div>
                                    <div class="card-body" style="background-color: #e3f2fd;">
                                        <p class="card-text">
                                            <strong>Código Técnico:</strong> {{ $product->technical_code }}<br>
                                            <strong>Unidad:</strong> {{ $product->unit }}<br>
                                            <strong>Precio Unitario:</strong> ${{ $product->unit_price }}<br>
                                            <strong>Descripción:</strong> {{ $product->description }}<br>
                                            <button type="button" class="btn btn-primary add-to-quote" data-id="{{ $product->id_producto }}" data-name="{{ $product->name }}" data-price="{{ $product->unit_price }}" style="background-color: #007bff; border-color: #007bff;">Añadir a Cotización</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>

            <div class="mt-4">
                <h2>Productos Seleccionados</h2>
                <ul id="selected-products" class="list-group">
                    <!-- Productos añadidos se mostrarán aquí -->
                </ul>
            </div>

            <button type="submit" class="btn btn-success mt-4">Generar Cotización</button>
        </form>

        <a href="{{ route('clients.index') }}" class="btn btn-secondary mt-3">Volver</a>
    </div>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
        }
        .card-header.custom-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body {
            font-size: 1.1em;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectedProducts = [];
            const productsInput = document.getElementById('products-input');
            const selectedProductsList = document.getElementById('selected-products');

            document.querySelectorAll('.add-to-quote').forEach(button => {
                button.addEventListener('click', function () {
                    const productId = this.getAttribute('data-id');
                    const productName = this.getAttribute('data-name');
                    const productPrice = this.getAttribute('data-price');

                    const product = {
                        id: productId,
                        name: productName,
                        price: productPrice
                    };

                    selectedProducts.push(product);
                    updateSelectedProductsList();
                });
            });

            function updateSelectedProductsList() {
                selectedProductsList.innerHTML = '';
                selectedProducts.forEach(product => {
                    const listItem = document.createElement('li');
                    listItem.classList.add('list-group-item');
                    listItem.textContent = `${product.name} - $${product.price}`;
                    selectedProductsList.appendChild(listItem);
                });

                productsInput.value = JSON.stringify(selectedProducts);
            }
        });
    </script>
@endsection
