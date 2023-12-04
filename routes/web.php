<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Livewire\BrandCtg;
use App\Livewire\Cart;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Livewire\GestionProduct;
use App\Livewire\ProviderCtg;

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

//catalogos
Route::get('/marcas',BrandCtg::class)->name('brands');;
Route::get('/provedores',ProviderCtg::class)->name('providers');;





//categorias
Route::get('category', [CategoryController::class,'index'])->name('category');
Route::get('category/create', [CategoryController::class,'create'])->name('category.create');
Route::post('category/save', [CategoryController::class,'save'])->name('category.save');
Route::get('category/edit/{category?}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('category/update/', [CategoryController::class, 'update'])->name('category.update');
Route::get('category/detele/{category?}', [CategoryController::class, 'delete'])->name('category.delete');




Livewire::setScriptRoute(function ($handle) {
    return Route::get('/livewire-curso/livewire6-carrito/public/livewire/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire-curso/livewire6-carrito/public/livewire/update', $handle);
});



//
