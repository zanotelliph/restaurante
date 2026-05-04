<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Traits\DashboardData;
class ReservaController extends Controller
{
    use DashboardData;

    public function index()
    {
        $reservas = Reserva::all();

        return view('reservas.index', array_merge(['reservas' => $reservas], $this->getDashboardData()));
    }
    public function create()
    {
        return view('reserva.form', $this->getDashboardData());
    }
    public function store(Request $request) 
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
        ]);

        Reserva::create($request->all());

        return redirect('reserva');
    }
    public function edit($id)
    {
        $reserva = Reserva::find($id);
        return view('reserva.form', compact('reserva'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
        ]);

        Reserva::find($id)->update($request->all());

        return redirect('reserva');
    }
    public function destroy($id)
    {
        Reserva::destroy($id);
        return redirect('reserva');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $reservas = Reserva::where('nome', 'like', "%$query%")->get();

        return view('reservas.index', ['reservas' => $reservas]);
    }
}