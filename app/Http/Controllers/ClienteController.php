<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::query();

        // Busca por nome, email ou CPF
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nome', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('cpf', 'LIKE', "%{$search}%");
            });
        }

        $clientes = $query->paginate(12);
        return view('cliente.list', compact('clientes'));
    }

    public function create()
    {
        return view('cliente.form');
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
            $nomeImagem = time() . '_cliente_' . uniqid() . '.' . $imagem->getClientOriginalExtension();
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
}
