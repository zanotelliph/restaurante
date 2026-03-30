<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\EstoqueController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'clientesCount' => \App\Models\Cliente::count(),
        'pedidosCount' => \App\Models\Pedido::count(),
        'estoqueCount' => \App\Models\Prato::where('estoque', '>', 0)->count() + \App\Models\Bebida::where('estoque', '>', 0)->count(),
    ]);
})->name('dashboard');

Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

Route::get('/pedido', [PedidoController::class, 'index'])->name('pedido.index');
Route::get('/pedido/create', [PedidoController::class, 'create'])->name('pedido.create');
Route::post('/pedido', [PedidoController::class, 'store'])->name('pedido.store');
Route::get('/pedido/{id}', [PedidoController::class, 'show'])->name('pedido.show');
Route::get('/pedido/edit/{id}', [PedidoController::class, 'edit'])->name('pedido.edit');
Route::put('/pedido/{id}', [PedidoController::class, 'update'])->name('pedido.update');
Route::delete('/pedido/{id}', [PedidoController::class, 'destroy'])->name('pedido.destroy');

Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');
Route::put('/estoque', [EstoqueController::class, 'updateEstoque'])->name('estoque.update');
Route::post('/estoque', [EstoqueController::class, 'store'])->name('estoque.store');
Route::delete('/estoque/{tipo}/{id}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');
