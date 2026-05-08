<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class ClientesPedidos
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $data = DB::table('pedidos')
            ->join('clientes', 'pedidos.cliente_id', '=', 'clientes.id') 
            ->select('clientes.nome', DB::raw('COUNT(pedidos.id) as quantidade'))
            ->groupBy('clientes.id', 'clientes.nome')
            ->orderByDesc('quantidade')
            ->get();

        $labels = [];
        $valores = [];

        foreach ($data as $item) {
            $labels[] = $item->nome;
            $valores[] = $item->quantidade;
        }

        return $this->chart->pieChart()
            ->setTitle('Pedidos por Cliente')
            ->addData($valores)
            ->setLabels($labels);
    }
}