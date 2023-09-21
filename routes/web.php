<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Livewire\GestionProduct;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/productos',GestionProduct::class)->name('productos');
Route::get('/image/file/{filename}', [ImageController::class, 'getImage'])->name('image.file');

Livewire::setScriptRoute(function ($handle) {
    return Route::get('/livewire-curso/livewire6-carrito/public/livewire/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire-curso/livewire6-carrito/public/livewire/update', $handle);
});

//
