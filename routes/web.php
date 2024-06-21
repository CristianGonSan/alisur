<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\QuoteController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\ClientController;



// Rutas para realizar las cotizaciones:
Route::get('admin/quotes', [QuoteController::class, 'index'])->name('admin.quotes.index');
Route::get('admin/quotes/create', [QuoteController::class, 'create'])->name('admin.quotes.create');
Route::get('/quotes/create/{client}', [QuoteController::class, 'create'])->name('quotes.create');
Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');

Route::get('admin/quotes/{quote}/edit', [QuoteController::class, 'edit'])->name('admin.quotes.edit');
Route::put('admin/quotes/{quote}', [QuoteController::class, 'update'])->name('admin.quotes.update');
Route::delete('admin/quotes/{quote}', [QuoteController::class, 'destroy'])->name('admin.quotes.destroy');


// Rutas patra que se logeen los  cliente:
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');


// web.php (rutas)

Route::get('admin/products/{id}/price_history', [ProductController::class, 'showPriceHistory'])->name('admin.products.price_history');
Route::get('admin/products/{id}/edit_price', [ProductController::class, 'editPrice'])->name('admin.products.edit_price');
Route::patch('admin/products/{id}/update_price', [ProductController::class, 'updatePrice'])->name('admin.products.update_price');
Route::get('products/{id}/price-history', [ProductController::class, 'showPriceHistory'])->name('products.price_history');
Route::get('products/{id}/edit-price', [ProductController::class, 'editPrice'])->name('products.edit_price');
Route::patch('products/{id}/update-price', [ProductController::class, 'updatePrice'])->name('products.update_price');
Route::delete('products/price-history/{history}', [ProductController::class, 'destroyPriceHistory'])->name('admin.products.price_history.destroy');

// Rutas de los productos para el cliente:
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{id}/show', [ProductController::class, 'show'])->name('products.show');


/// Rutas de los productos para el administrador:
Route::get('/admin/products/index', [AdminProductController::class, 'index'])->name('admin.products.index');
Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products/store', [AdminProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{id}/update', [AdminProductController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{id}/destroy', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

// Rutas de Autenticación generadas por Auth::routes();
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/users/create', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('users.create');
        Route::post('/users/store', 'App\Http\Controllers\Auth\RegisterController@store')->name('users.store');

    });
});
