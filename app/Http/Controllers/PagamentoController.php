<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PagamentoController extends Controller
{

    public function index(Request $request)
    {
        $query = Pagamento::with('pedido.cliente');
        $search = $request->get('search', '');

        if (!empty($search)) {
            $query->whereHas('pedido.cliente', function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $pagamentos = $query->orderBy('created_at', 'desc')->get();

        return view('pagamentos.index', array_merge(compact('pagamentos', 'search'), $this->getDashboardData()));
    }

    public function create()
    {
        $pedidos = Pedido::doesntHave('pagamento')->with('cliente')->get();
        return view('pagamentos.form', array_merge(compact('pedidos'), $this->getDashboardData()));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id|unique:pagamentos,pedido_id',
            'valor' => 'required|numeric|min:0',
            'metodo' => ['required', Rule::in(['dinheiro', 'cartao', 'pix', 'boleto'])],
            'status' => ['required', Rule::in(['pendente', 'aprovado', 'recusado'])],
            'pago_em' => 'nullable|date',
            'observacoes' => 'nullable|string',
        ]);

        $data = $request->only(['pedido_id', 'valor', 'metodo', 'status', 'pago_em', 'observacoes']);

        if ($data['status'] === 'aprovado' && empty($data['pago_em'])) {
            $data['pago_em'] = now();
        }

        Pagamento::create($data);

        return redirect()->route('pagamento.index')->with('success', 'Pagamento cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $pagamento = Pagamento::with('pedido.cliente')->findOrFail($id);
        return view('pagamentos.form', array_merge(compact('pagamento'), $this->getDashboardData()));
    }

    public function update(Request $request, $id)
    {
        $pagamento = Pagamento::findOrFail($id);

        $request->validate([
            'valor' => 'required|numeric|min:0',
            'metodo' => ['required', Rule::in(['dinheiro', 'cartao', 'pix', 'boleto'])],
            'status' => ['required', Rule::in(['pendente', 'aprovado', 'recusado'])],
            'pago_em' => 'nullable|date',
            'observacoes' => 'nullable|string',
        ]);

        $data = $request->only(['valor', 'metodo', 'status', 'pago_em', 'observacoes']);

        if ($data['status'] === 'aprovado' && empty($data['pago_em'])) {
            $data['pago_em'] = now();
        }

        $pagamento->update($data);

        return redirect()->route('pagamento.index')->with('success', 'Pagamento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $pagamento = Pagamento::findOrFail($id);
        $pagamento->delete();

        return redirect()->route('pagamento.index')->with('success', 'Pagamento deletado com sucesso!');
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

