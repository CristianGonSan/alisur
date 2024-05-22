<!-- resources/views/admin/products/index.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1>Productos</h1>
    <a href="{{ route('admin.products.index') }}">Crear Nuevo Producto</a>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Código Técnico</th>
            <th>Unidad</th>
            <th>Precio Unitario</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->technical_code }}</td>
                <td>{{ $product->unit }}</td>
                <td>{{ $product->unit_price }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}">Editar</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
