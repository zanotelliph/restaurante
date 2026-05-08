<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Charts\ClientesPedidos;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Barryvdh\DomPDF\Facade\Pdf;


class ClienteController extends Controller
{

    public function index(Request $request)
    {
        $query = Cliente::query();

      
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nome', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('cpf', 'LIKE', "%{$search}%");
            });
        }

        $clientes = $query->paginate(12);
        return view('cliente.index', array_merge(compact('clientes'), $this->getDashboardData()));
    }

    public function create()
    {
        return view('cliente.form', $this->getDashboardData());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes',
            'telefone' => 'nullable|string',
            'cpf' => 'required|unique:clientes|string',
            'endereco' => 'nullable|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = time() . '_cliente_' . uniqid() . '.' . $imagem->getClientOriginalExtension();//gera nome unico
            $imagem->move(public_path('uploads/clientes'), $nomeImagem);
            $data['imagem'] = 'uploads/clientes/' . $nomeImagem;
        }

        Cliente::create($data);

        return redirect()->route('cliente.index')->with('success', 'Cliente criado com sucesso!');
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('cliente.form', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $id,
            'telefone' => 'nullable|string',
            'cpf' => 'required|unique:clientes,cpf,' . $id,
            'endereco' => 'nullable|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagem')) {
            if ($cliente->imagem && file_exists(public_path($cliente->imagem))) {
                unlink(public_path($cliente->imagem));
            }
            $imagem = $request->file('imagem');
            $nomeImagem = time() . '_cliente_' . uniqid() . '.' . $imagem->getClientOriginalExtension();
            $imagem->move(public_path('uploads/clientes'), $nomeImagem);
            $data['imagem'] = 'uploads/clientes/' . $nomeImagem;
        }

        $cliente->update($data);

        return redirect()->route('cliente.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        
        if ($cliente->imagem && file_exists(public_path($cliente->imagem))) {
            unlink(public_path($cliente->imagem));
        }
        
        $cliente->delete();

        return redirect()->route('cliente.index')->with('success', 'Cliente deletado com sucesso!');
    }
    
    public function chart(ClientesPedidos $chart)
{
    return view('clientes.chart', [
        'chart' => $chart->build()
    ]);
}
    public function report()
{
    $clientes = \App\Models\Cliente::orderBy('id')->get();

    $data = [
        'titulo' => 'Relatório de Clientes',
        'clientes' => $clientes,
    ];

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('cliente.report', $data);

    return $pdf->download('relatorio_clientes.pdf');
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
