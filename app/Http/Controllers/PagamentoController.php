<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Traits\DashboardData;
class PagamentoController extends Controller
{
    use DashboardData;

    public function index()
    {
        $pagamentos = Pagamento::all();

        return view('pagamentos.index', array_merge(['pagamentos' => $pagamentos], $this->getDashboardData()));
    }
    public function create()
    {
        return view('pagamento.form', $this->getDashboardData()); //retorna a view do formulário de pagamento, passando os dados do dashboard
    }
    public function store(Request $request) 
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'cartao' => 'required',
        ]);

        Pagamento::create($request->all());

        return redirect('pagamento');
    }
    public function edit($id)
    {
        $pagamento = Pagamento::find($id);
        return view('pagamento.form', compact('pagamento'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'cartao' => 'required',
        ]);

        Pagamento::find($id)->update($request->all());

        return redirect('pagamento');
    }
    public function destroy($id)
    {
        Pagamento::destroy($id);
        return redirect('pagamento');
    }
}