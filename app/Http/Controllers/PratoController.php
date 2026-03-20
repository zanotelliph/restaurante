<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use App\Models\CategoriaPrato;
use Illuminate\Http\Request;

class PratoController extends Controller
{
    public function index(Request $request)
    {
        $query = Prato::with('categoriaPrato');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nome', 'LIKE', "%{$search}%")
                  ->orWhere('descricao', 'LIKE', "%{$search}%")
                  ->orWhereHas('categoriaPrato', function($categoriaQuery) use ($search) {
                      $categoriaQuery->where('nome', 'LIKE', "%{$search}%");
                  });
            });
        }

        $pratos = $query->paginate(12);
        return view('prato.list', compact('pratos'));
    }

    public function create()
    {
        $categoriasPratos = CategoriaPrato::where('ativo', true)->get();
        return view('prato.form', compact('categoriasPratos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'categoria_prato_id' => 'required|exists:categorias_pratos,id',
            'estoque' => 'required|integer|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = time() . '_prato_' . uniqid() . '.' . $imagem->getClientOriginalExtension();
            $imagem->move(public_path('uploads/pratos'), $nomeImagem);
            $data['imagem'] = 'uploads/pratos/' . $nomeImagem;
        }

        Prato::create($data);

        return redirect()->route('prato.index')->with('success', 'Prato criado com sucesso!');
    }

    public function edit($id)
    {
        $prato = Prato::findOrFail($id);
        $categoriasPratos = CategoriaPrato::where('ativo', true)->get();
        return view('prato.form', compact('prato', 'categoriasPratos'));
    }

    public function update(Request $request, $id)
    {
        $prato = Prato::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'categoria_prato_id' => 'required|exists:categorias_pratos,id',
            'estoque' => 'required|integer|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagem')) {
            if ($prato->imagem && file_exists(public_path($prato->imagem))) {
                unlink(public_path($prato->imagem));
            }
            $imagem = $request->file('imagem');
            $nomeImagem = time() . '_prato_' . uniqid() . '.' . $imagem->getClientOriginalExtension();
            $imagem->move(public_path('uploads/pratos'), $nomeImagem);
            $data['imagem'] = 'uploads/pratos/' . $nomeImagem;
        }

        $prato->update($data);

        return redirect()->route('prato.index')->with('success', 'Prato atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $prato = Prato::findOrFail($id);
        
        if ($prato->imagem && file_exists(public_path($prato->imagem))) {
            unlink(public_path($prato->imagem));
        }
        
        $prato->delete();

        return redirect()->route('prato.index')->with('success', 'Prato deletado com sucesso!');
    }
}
