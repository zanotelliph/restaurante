<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use App\Traits\DashboardData;

class PratoController extends Controller
{
    use DashboardData;

    public function index()
    {
        $pratos = Prato::all();

        return view('pratos.index', array_merge(['pratos' => $pratos], $this->getDashboardData()));
    }
       public function create()
    {
        return view('prato.form', $this->getDashboardData());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
        ]);

        prato::create($request->all());

        return redirect('prato');
    }

    public function edit($id)
    {
        $prato = prato::find($id);
        return view('prato.form', compact('prato'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
        ]);

        prato::find($id)->update($request->all());

        return redirect('prato');
    }

    public function destroy($id)
    {
        prato::destroy($id);
        return redirect('prato');
    }

    public function search(Request $request)
    {
        $pratos = prato::where('nome', 'like', '%' . $request->valor . '%')->get();

        return view('pratos.index', compact('pratos'));
    }

}