@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 justify-content-center">

            @if( Auth::user()->is_admin)
                @include('layouts.cards.text-card', [
                'route' => route('users.index'),
                'header' => 'Usuarios',
                'title' => 'Gestión de Usuarios',
                'text' => 'Gestione a los usuarios para que puedan acceder.'
                ])
                @include('layouts.cards.text-card', [
                   'route' => route('products.index'),
                   'header' => 'Productos',
                   'title' => 'Gestión de Productos',
                   'text' => 'Gestione una vista hacia los productos.'
                   ])
                @include('layouts.cards.text-card', [
                  'route' => route('admin.products.index'),
                  'header' => 'Interno_Productos',
                  'title' => 'Gestión de Productos',
                  'text' => 'Gestione una vista hacia los productos.'
                  ])
                @include('layouts.cards.text-card', [
                     'route' => route('admin.quotes.index'),
                     'header' => 'Cotizaciones',
                     'title' => 'Cotizaciones',
                     'text' => 'Gestione una vista hacia las cotizaciones.'
                 ])

            @endif


        </div>
    </div>
@endsection
