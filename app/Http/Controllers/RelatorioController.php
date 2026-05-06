<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    // Relatório 1: Listagem de Pedidos em PDF
    public function relatorioPedidos()
    {
        $pedidos = Pedido::with(['cliente', 'itens.prato', 'pagamento'])
            ->orderByDesc('created_at')
            ->get();

        // Estatísticas
        $totalPedidos = $pedidos->count();
        $totalVendas = $pedidos->sum('total');
        $mediaVendas = $totalVendas / $totalPedidos;

        $pdf = Pdf::loadView('relatorios.pedidos-pdf', compact('pedidos', 'totalPedidos', 'totalVendas', 'mediaVendas'));
        
        return $pdf->download('relatorio_pedidos_' . date('d-m-Y') . '.pdf');
    }

    // Relatório 2: Listagem de Clientes em PDF
    public function relatorioClientes()
    {
        $clientes = Cliente::with('pedidos')
            ->withCount('pedidos')
            ->withCount('reservas')
            ->orderBy('nome')
            ->get();

        // Adicionar total gasto por cliente
        $clientes = $clientes->map(function ($cliente) {
            $cliente->total_gasto = DB::table('pedidos')
                ->where('cliente_id', $cliente->id)
                ->sum('total');
            return $cliente;
        });

        $totalClientes = $clientes->count();
        $totalGasto = $clientes->sum('total_gasto');
        $mediaGasto = $totalClientes > 0 ? $totalGasto / $totalClientes : 0;

        $pdf = Pdf::loadView('relatorios.clientes-pdf', compact('clientes', 'totalClientes', 'totalGasto', 'mediaGasto'));
        
        return $pdf->download('relatorio_clientes_' . date('d-m-Y') . '.pdf');
    }

    // Visualizar relatório de pedidos (HTML)
    public function viewRelatorioPedidos()
    {
        $pedidos = Pedido::with(['cliente', 'itens.prato', 'pagamento'])
            ->orderByDesc('created_at')
            ->get();

        $totalPedidos = $pedidos->count();
        $totalVendas = $pedidos->sum('total');
        $mediaVendas = $totalVendas / $totalPedidos;

        return view('relatorios.pedidos', compact('pedidos', 'totalPedidos', 'totalVendas', 'mediaVendas'));
    }

    // Visualizar relatório de clientes (HTML)
    public function viewRelatorioClientes()
    {
        $clientes = Cliente::with('pedidos')
            ->withCount('pedidos')
            ->withCount('reservas')
            ->orderBy('nome')
            ->get();

        $clientes = $clientes->map(function ($cliente) {
            $cliente->total_gasto = DB::table('pedidos')
                ->where('cliente_id', $cliente->id)
                ->sum('total');
            return $cliente;
        });

        $totalClientes = $clientes->count();
        $totalGasto = $clientes->sum('total_gasto');
        $mediaGasto = $totalClientes > 0 ? $totalGasto / $totalClientes : 0;

        return view('relatorios.clientes', compact('clientes', 'totalClientes', 'totalGasto', 'mediaGasto'));
    }
}
