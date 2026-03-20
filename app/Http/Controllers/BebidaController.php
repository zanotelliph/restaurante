<?php

namespace App\Http\Controllers;

use App\Models\Bebida;
use App\Models\CategoriaBebida;
use Illuminate\Http\Request;

class BebidaController extends Controller
{
    public function index(Request $request)
    {
        $query = Bebida::with('categoriaBebida');

        // Busca por nome, descrição ou categoria
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nome', 'LIKE', "%{$search}%")
                  ->orWhere('descricao', 'LIKE', "%{$search}%")
                  ->orWhereHas('categoriaBebida', function($categoriaQuery) use ($search) {
                      $categoriaQuery->where('nome', 'LIKE', "%{$search}%");
                  });
            });
        }

        $bebidas = $query->paginate(12);
        return view('bebida.list', compact('bebidas'));
    }

    public function create()
    {
        $categoriasBebidas = CategoriaBebida::where('ativo', true)->get();
        return view('bebida.form', compact('categoriasBebidas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'categoria_bebida_id' => 'required|exists:categorias_bebidas,id',
            'disponivel' => 'boolean',
            'estoque' => 'required|integer|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = time() . '_bebida_' . uniqid() . '.' . $imagem->getClientOriginalExtension();
            $imagem->move(public_path('uploads/bebidas'), $nomeImagem);
            $data['imagem'] = 'uploads/bebidas/' . $nomeImagem;
        }

        Bebida::create($data);

        return redirect()->route('bebida.index')->with('success', 'Bebida criada com sucesso!');
    }

    public function edit($id)
    {
        $bebida = Bebida::findOrFail($id);
        $categoriasBebidas = CategoriaBebida::where('ativo', true)->get();
        return view('bebida.form', compact('bebida', 'categoriasBebidas'));
    }

    public function update(Request $request, $id)
    {
        $bebida = Bebida::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'categoria_bebida_id' => 'required|exists:categorias_bebidas,id',
            'disponivel' => 'boolean',
            'estoque' => 'required|integer|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagem')) {
            if ($bebida->imagem && file_exists(public_path($bebida->imagem))) {
                unlink(public_path($bebida->imagem));
            }
            $imagem = $request->file('imagem');
            $nomeImagem = time() . '_bebida_' . uniqid() . '.' . $imagem->getClientOriginalExtension();
            $imagem->move(public_path('uploads/bebidas'), $nomeImagem);
            $data['imagem'] = 'uploads/bebidas/' . $nomeImagem;
        }

        $bebida->update($data);

        return redirect()->route('bebida.index')->with('success', 'Bebida atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $bebida = Bebida::findOrFail($id);
        
        if ($bebida->imagem && file_exists(public_path($bebida->imagem))) {
            unlink(public_path($bebida->imagem));
        }
        
        $bebida->delete();

        return redirect()->route('bebida.index')->with('success', 'Bebida deletada com sucesso!');
    }
}
