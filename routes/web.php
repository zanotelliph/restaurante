<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PratoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return view('home');
});

Route::get('/pratos', [PratoController::class, 'index']);

Route::get('/clientes', [ClienteController::class, 'index']);

Route::resource('pedidos', PedidoController::class);