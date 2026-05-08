<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use App\Models\Bebida;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search', '');

        $pratosQuery = Prato::with('categoriaPrato');
        $bebidasQuery = Bebida::with('categoriaBebida');

        if (!empty($search)) {
            $pratosQuery->where('nome', 'LIKE', "%{$search}%");
            $bebidasQuery->where('nome', 'LIKE', "%{$search}%");
        }

        $pratos = $pratosQuery->get();
        $bebidas = $bebidasQuery->get();
        $categoriasPratos = \App\Models\CategoriaPrato::where('ativo', true)->get();
        $categoriasBebidas = \App\Models\CategoriaBebida::where('ativo', true)->get();

        return view('estoque.index', array_merge(compact('pratos', 'bebidas', 'categoriasPratos', 'categoriasBebidas', 'search'), $this->getDashboardData()));
    }
    public function create()
{
    return view('estoque.form', $this->getDashboardData());
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:prato,bebida',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
            'categoria_id' => 'required|integer',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagemPath = null;
        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('uploads/produtos', 'public');
        }

        if ($validated['tipo'] === 'prato') {
            $request->validate(['categoria_id' => 'exists:categorias_pratos,id']);
            

            Prato::create([
                'nome' => $validated['nome'],
                'descricao' => $validated['descricao'] ?? null,
                'preco' => $validated['preco'],
                'categoria_prato_id' => $validated['categoria_id'],
                'disponivel' => true,
                'estoque' => $validated['estoque'],
                'imagem' => $imagemPath,
            ]);
        } else {
            $request->validate(['categoria_id' => 'exists:categorias_bebidas,id']);

            Bebida::create([
                'nome' => $validated['nome'],
                'descricao' => $validated['descricao'] ?? null,
                'preco' => $validated['preco'],
                'categoria_bebida_id' => $validated['categoria_id'],
                'disponivel' => true,
                'estoque' => $validated['estoque'],
                'imagem' => $imagemPath,
            ]);
        }

        return redirect()->route('estoque.index')->with('success', 'Produto adicionado com sucesso!');
        
    }

    public function updateEstoque(Request $request)
    {
        try {
            $validated = $request->validate([
                'itens' => 'nullable|array',
                'itens.*.tipo' => 'required_with:itens|in:prato,bebida',
                'itens.*.id' => 'required_with:itens|integer',
                'itens.*.estoque' => 'required_with:itens|integer|min:0',
            ]);

            if (!empty($validated['itens'])) {
                foreach ($validated['itens'] as $item) {
                    if ($item['tipo'] === 'prato') {
                        $prato = Prato::findOrFail($item['id']);
                        $prato->update(['estoque' => $item['estoque']]);
                    } elseif ($item['tipo'] === 'bebida') {
                        $bebida = Bebida::findOrFail($item['id']);
                        $bebida->update(['estoque' => $item['estoque']]);
                    }
                }
            }

            return redirect()->route('estoque.index')->with('success', 'Estoque atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('estoque.index')->with('error', 'Erro ao atualizar estoque: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $tipo, $id)
    {
        if ($tipo === 'prato') {
            $prato = Prato::findOrFail($id);

            // Deletar imagem se existir
            if ($prato->imagem && file_exists(storage_path('app/public/' . $prato->imagem))) {
                unlink(storage_path('app/public/' . $prato->imagem));
            }

            $prato->delete();
            $message = 'Prato deletado com sucesso!';
        } elseif ($tipo === 'bebida') {
            $bebida = Bebida::findOrFail($id);

            // Deletar imagem se existir
            if ($bebida->imagem && file_exists(storage_path('app/public/' . $bebida->imagem))) {
                unlink(storage_path('app/public/' . $bebida->imagem));
            }

            $bebida->delete();
            $message = 'Bebida deletada com sucesso!';
        } else {
            return redirect()->route('estoque.index')->with('error', 'Tipo inválido!');
        }

        return redirect()->route('estoque.index')->with('success', $message);
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