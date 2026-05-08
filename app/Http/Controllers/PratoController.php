<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use Illuminate\Http\Request;
use App\Charts\PratosCategoria;
use Barryvdh\DomPDF\Facade\Pdf;

class PratoController extends Controller
{
    public function index()
    {
        $pratos = Prato::all();

        return view('pratos.index', array_merge([
            'pratos' => $pratos
        ], $this->getDashboardData()));
    }

    public function create()
    {
        return view('pratos.form', $this->getDashboardData());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'preco' => 'required',
            'descricao' => 'nullable',
            'estoque' => 'required',
            'categoria_prato_id' => 'required'
        ]);

        Prato::create($request->all());

        return redirect('pratos');
    }

    public function edit($id)
    {
        $prato = Prato::find($id);

        return view('pratos.form', compact('prato'));
    }

    public function update(Request $request, $id)
    {
        Prato::find($id)->update($request->all());

        return redirect('pratos');
    }

    public function destroy($id)
    {
        Prato::destroy($id);

        return redirect('pratos');
    }

    public function search(Request $request)
    {
        $pratos = Prato::where('nome', 'like', '%' . $request->valor . '%')->get();

        return view('pratos.index', compact('pratos'));
    }

    public function chart(PratosCategoria $chart)
    {
        return view('pratos.PratosChart', [
            'chart' => $chart->build()
        ]);
    }

    protected function getDashboardData()
    {
        return [
            'clientesCount' => \App\Models\Cliente::count(),
            'pedidosCount' => \App\Models\Pedido::count(),
            'reservasCount' => \App\Models\Reserva::count(),
            'pagamentosCount' => \App\Models\Pagamento::count(),
            'estoqueCount' =>
                \App\Models\Prato::where('estoque', '>', 0)->count()
                + \App\Models\Bebida::where('estoque', '>', 0)->count(),
        ];
    }
}