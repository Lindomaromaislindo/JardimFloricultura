<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FlorController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CatalogoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pedidos',             [PedidoController::class, 'index'])->name('pedidos.index');
Route::get('/pedidos/create',      [PedidoController::class, 'create'])->name('pedidos.create');
Route::post('/pedidos/store',      [PedidoController::class, 'store'])->name('pedidos.store');
Route::delete('/pedidos/{id}',     [PedidoController::class, 'destroy'])->name('pedidos.destroy');
Route::get('/pedidos/edit/{id}',   [PedidoController::class, 'edit'])->name('pedidos.edit');
Route::put('/pedidos/update/{id}', [PedidoController::class, 'update'])->name('pedidos.update');
Route::post('/pedidos/search',     [PedidoController::class, 'search'])->name('pedidos.search');

Route::get('/clientes',               [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create',        [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes/store',        [ClienteController::class, 'store'])->name('clientes.store');
Route::delete('/clientes/{id}',       [ClienteController::class, 'destroy'])->name('clientes.destroy');
Route::get('/clientes/edit/{id}',     [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/update/{id}',   [ClienteController::class, 'update'])->name('clientes.update');
Route::post('/clientes/search',       [ClienteController::class, 'search'])->name('clientes.search');

Route::get('/categorias',               [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create',        [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/categorias/store',        [CategoriaController::class, 'store'])->name('categorias.store');
Route::delete('/categorias/{id}',       [CategoriaController::class, 'destroy'])->name('categorias.destroy');
Route::get('/categorias/edit/{id}',     [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/update/{id}',   [CategoriaController::class, 'update'])->name('categorias.update');
Route::post('/categorias/search',       [CategoriaController::class, 'search'])->name('categorias.search');

Route::get('/flores',               [FlorController::class, 'index'])->name('flores.index');
Route::get('/flores/create',        [FlorController::class, 'create'])->name('flores.create');
Route::post('/flores/store',        [FlorController::class, 'store'])->name('flores.store');
Route::delete('/flores/{id}',       [FlorController::class, 'destroy'])->name('flores.destroy');
Route::get('/flores/edit/{id}',     [FlorController::class, 'edit'])->name('flores.edit');
Route::put('/flores/update/{id}',   [FlorController::class, 'update'])->name('flores.update');
Route::post('/flores/search',       [FlorController::class, 'search'])->name('flores.search');

Route::get('/flores/{flor}/catalogos',                 [CatalogoController::class, 'index'])->name('flores.catalogos.index');
Route::get('/flores/{flor}/catalogos/create',          [CatalogoController::class, 'create'])->name('flores.catalogos.create');
Route::post('/flores/{flor}/catalogos/store',          [CatalogoController::class, 'store'])->name('flores.catalogos.store');
Route::get('/flores/{flor}/catalogos/{catalogo}/edit', [CatalogoController::class, 'edit'])->name('flores.catalogos.edit');
Route::put('/flores/{flor}/catalogos/{catalogo}',      [CatalogoController::class, 'update'])->name('flores.catalogos.update');
Route::delete('/flores/{flor}/catalogos/{catalogo}',   [CatalogoController::class, 'destroy'])->name('flores.catalogos.destroy');
Route::post('/flores/{flor}/catalogos/search',         [CatalogoController::class, 'search'])->name('flores.catalogos.search');
Route::get('/flores/relatorio/pdf', [FlorController::class, 'report'])->name('flores.report');

