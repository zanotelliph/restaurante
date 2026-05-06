<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Cliente;
use App\Models\Prato;
use App\Models\Bebida;


class PedidoController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Pedido::with('cliente', 'itens.prato', 'itens.bebida');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('cliente', function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $pedidos = $query->get();

        return view('pedidos.index', array_merge(['pedidos' => $pedidos, 'search' => $request->search], $this->getDashboardData()));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $pratos = Prato::where('estoque', '>', 0)->get();
        $bebidas = Bebida::where('estoque', '>', 0)->get();
        return view('pedidos.form', array_merge(compact('clientes', 'pratos', 'bebidas'), $this->getDashboardData()));
    }

    public function show($id)
    {
        $pedido = Pedido::with('itens.prato', 'itens.bebida')->find($id);
        return view('pedidos.show', compact('pedido'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'itens' => 'required|array|min:1',
            'itens.*.tipo' => 'required|in:prato,bebida',
            'itens.*.id' => 'required|integer',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens.*.preco' => 'required|numeric|min:0',
        ]);

        $pedido = Pedido::create([
            'cliente_id' => $request->cliente_id,
            'status' => 'pendente',
            'observacoes' => $request->observacoes,
        ]);

        $totalPedido = 0;
        foreach ($request->itens as $item) {
            $preco = $item['preco'] * $item['quantidade'];
            $totalPedido += $preco;

            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'prato_id' => $item['tipo'] === 'prato' ? $item['id'] : null,
                'bebida_id' => $item['tipo'] === 'bebida' ? $item['id'] : null,
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco'],
            ]);
        }

        $pedido->update(['total' => $totalPedido]);

        return redirect()->route('pedido.index')->with('success', 'Pedido criado com sucesso!');
    }

    public function edit($id)
    {
        $pedido = Pedido::with('itens')->find($id);
        $clientes = Cliente::all();
        $pratos = Prato::where('estoque', '>', 0)->get();
        $bebidas = Bebida::where('estoque', '>', 0)->get();
        return view('pedidos.form', array_merge(compact('pedido', 'clientes', 'pratos', 'bebidas'), $this->getDashboardData()));
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::find($id);

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'status' => 'required|in:pendente,confirmado,entregue,cancelado',
            'observacoes' => 'nullable|string',
        ]);

        $pedido->update($request->only('cliente_id', 'status', 'observacoes'));

        return redirect()->route('pedido.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedido->itens()->delete();
        $pedido->delete();
        return redirect()->route('pedido.index')->with('success', 'Pedido deletado com sucesso!');
    }

    public function search(Request $request)
    {
        $pedidos = Pedido::whereHas('cliente', function($query) use ($request) {
            $query->where('nome', 'like', '%' . $request->valor . '%');
        })->with('cliente', 'itens.prato', 'itens.bebida')->get();

        return view('pedidos.index', compact('pedidos'));
    }

    protected function getDashboardData()
    {
        return [
            'clientesCount' => \App\Models\Cliente::count(),
            'pedidosCount' => \App\Models\Pedido::count(),
            'reservasCount' => \App\Models\Reserva::count(),
            'pagamentosCount' => \App\Models\Pagamento::count(),
            'estoqueCount' => \App\Models\Prato::where('estoque', '>', 0)->count() + \App\Models\Bebida::where('estoque', '>', 0)->count(),
        ];
    }
}