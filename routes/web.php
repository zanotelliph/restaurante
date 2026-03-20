<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PratoController;
use App\Http\Controllers\BebidaController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard', [
        'clientesCount' => \App\Models\Cliente::count(),
        'pratosCount' => \App\Models\Prato::count(),
        'bebidasCount' => \App\Models\Bebida::count(),
    ]);
})->name('dashboard');

// Rotas de Clientes
Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

// Rotas de Pratos
Route::get('/prato', [PratoController::class, 'index'])->name('prato.index');
Route::get('/prato/create', [PratoController::class, 'create'])->name('prato.create');
Route::post('/prato', [PratoController::class, 'store'])->name('prato.store');
Route::get('/prato/edit/{id}', [PratoController::class, 'edit'])->name('prato.edit');
Route::put('/prato/{id}', [PratoController::class, 'update'])->name('prato.update');
Route::delete('/prato/{id}', [PratoController::class, 'destroy'])->name('prato.destroy');

// Rotas de Bebidas
Route::get('/bebida', [BebidaController::class, 'index'])->name('bebida.index');
Route::get('/bebida/create', [BebidaController::class, 'create'])->name('bebida.create');
Route::post('/bebida', [BebidaController::class, 'store'])->name('bebida.store');
Route::get('/bebida/edit/{id}', [BebidaController::class, 'edit'])->name('bebida.edit');
Route::put('/bebida/{id}', [BebidaController::class, 'update'])->name('bebida.update');
Route::delete('/bebida/{id}', [BebidaController::class, 'destroy'])->name('bebida.destroy');
