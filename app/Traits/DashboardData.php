<?php

namespace App\Traits;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Prato;
use App\Models\Bebida;

trait DashboardData
{
    protected function getDashboardData()
    {
        return [
            'clientesCount' => Cliente::count(),
            'pedidosCount' => Pedido::count(),
            'estoqueCount' => Prato::where('estoque', '>', 0)->count() + Bebida::where('estoque', '>', 0)->count(),
        ];
    }
}
