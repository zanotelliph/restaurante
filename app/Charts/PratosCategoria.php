<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class PratosCategoria
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $data = DB::table('pratos')
            ->join('categorias_pratos', 'pratos.categoria_prato_id', '=', 'categorias_pratos.id')
            ->select(
                'categorias_pratos.nome as categoria',
                DB::raw('SUM(pratos.estoque) as quantidade')
            )
            ->groupBy('categorias_pratos.id', 'categorias_pratos.nome')
            ->get();

        $labels = [];
        $valores = [];

        foreach ($data as $item) {
            $labels[] = $item->categoria;
            $valores[] = $item->quantidade;
        }

        return $this->chart->pieChart()
            ->setTitle('Pratos por Categoria')
            ->addData($valores)
            ->setLabels($labels);
    }
}
