<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Prato;
use App\Models\CategoriaPrato;
use App\Models\PedidoItem;
use Illuminate\Support\Facades\DB;

class GraficoController extends Controller
{
    // Gráfico 1: Quantidade de pedidos por cliente (Gráfico de Barras)
    public function graficoClientePedidos()
    {
        $data = DB::table('pedidos')
            ->join('clientes', 'pedidos.cliente_id', '=', 'clientes.id')
            ->select(
                'clientes.nome',
                DB::raw('COUNT(pedidos.id) as quantidade')
            )
            ->groupBy('clientes.id', 'clientes.nome')
            ->orderByDesc('quantidade')
            ->limit(10)
            ->get();

        $labels = $data->pluck('nome')->toArray();
        $valores = $data->pluck('quantidade')->toArray();

        return view('graficos.clientes-pedidos', compact('labels', 'valores'));
    }

    // Gráfico 2: Distribuição de pratos por categoria (Gráfico de Pizza/Donut)
    public function graficoPratosPorCategoria()
    {
        $data = DB::table('pratos')
            ->join('categorias_pratos', 'pratos.categoria_prato_id', '=', 'categorias_pratos.id')
            ->select(
                'categorias_pratos.nome as categoria',
                DB::raw('COUNT(pratos.id) as quantidade')
            )
            ->groupBy('categorias_pratos.id', 'categorias_pratos.nome')
            ->get();

        $labels = $data->pluck('categoria')->toArray();
        $valores = $data->pluck('quantidade')->toArray();

        // Cores para o gráfico de pizza
        $cores = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(199, 199, 199, 0.7)',
            'rgba(83, 102, 255, 0.7)',
        ];

        return view('graficos.pratos-categoria', compact('labels', 'valores', 'cores'));
    }
}
