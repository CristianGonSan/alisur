@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-5 text-primary">Historial de Precios de {{ $product->name }}</h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($priceHistory as $history)
                <div class="col">
                    <div class="card h-100 shadow-sm" style="border-left: 5px solid #007bff;">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <i class="bi bi-calendar-event-fill"></i> Fecha
                            </h5>
                            <p class="card-text">{{ $history->created_at->timezone('America/Mexico_City')->format('d/m/Y H:i:s') }}</p>
                            <h5 class="card-title text-success">
                                <i class="bi bi-cash-coin"></i> Precio
                            </h5>
                            <p class="card-text">${{ number_format($history->unit_price, 2) }}</p>
                            <div class="text-center mt-4">
                                <form action="{{ route('admin.products.price_history.destroy', $history->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este registro de precio?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle-fill"></i> Volver
            </a>
        </div>
    </div>

    <style>
        .card {
            border-radius: 15px;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .btn {
            border-radius: 50px;
        }
        .card-title {
            font-weight: bold;
        }
        @media (max-width: 576px) {
            .row-cols-1 .col {
                margin-bottom: 1rem;
            }
        }
    </style>
@endsection
