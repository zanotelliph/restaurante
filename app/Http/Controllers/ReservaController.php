<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Traits\DashboardData;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    use DashboardData;

    public function index(Request $request)
    {
        $query = Reserva::with('cliente');
        $search = $request->get('search', '');

        if (!empty($search)) {
            $query->whereHas('cliente', function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $reservas = $query->orderBy('data_reserva', 'desc')->get();

        return view('reservas.index', array_merge(compact('reservas', 'search'), $this->getDashboardData()));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('reservas.form', array_merge(compact('clientes'), $this->getDashboardData()));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'data_reserva' => 'required|date',
            'hora_reserva' => 'required',
            'pessoas' => 'required|integer|min:1',
            'status' => 'required|in:pendente,confirmada,cancelada',
            'observacoes' => 'nullable|string',
        ]);

        Reserva::create($request->only(['cliente_id', 'data_reserva', 'hora_reserva', 'pessoas', 'status', 'observacoes']));

        return redirect()->route('reserva.index')->with('success', 'Reserva criada com sucesso!');
    }

    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);
        $clientes = Cliente::all();
        return view('reservas.form', array_merge(compact('reserva', 'clientes'), $this->getDashboardData()));
    }

    public function update(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'data_reserva' => 'required|date',
            'hora_reserva' => 'required',
            'pessoas' => 'required|integer|min:1',
            'status' => 'required|in:pendente,confirmada,cancelada',
            'observacoes' => 'nullable|string',
        ]);

        $reserva->update($request->only(['cliente_id', 'data_reserva', 'hora_reserva', 'pessoas', 'status', 'observacoes']));

        return redirect()->route('reserva.index')->with('success', 'Reserva atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();

        return redirect()->route('reserva.index')->with('success', 'Reserva deletada com sucesso!');
    }
}
>>>>>>> 90b0195e7340943c7137209314d8c797d0a1f23d
