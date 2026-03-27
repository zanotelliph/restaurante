<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedidos.index', ['pedidos' => $pedidos]);
    }

    public function create()
    {
        return view('pedido.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
        ]);

        Pedido::create($request->all());

        return redirect('pedido');
    }

    public function edit($id)
    {
        $pedido = Pedido::find($id);
        return view('pedido.form', compact('pedido'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
        ]);

        Pedido::find($id)->update($request->all());

        return redirect('pedido');
    }

    public function destroy($id)
    {
        Pedido::destroy($id);
        return redirect('pedido');
    }

    public function search(Request $request)
    {
        $pedidos = Pedido::where('nome', 'like', '%' . $request->valor . '%')->get();

        return view('pedidos.index', compact('pedidos'));
    }
}