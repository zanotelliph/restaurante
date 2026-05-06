<?php

namespace App\Traits;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Prato;
use App\Models\Bebida;
use App\Models\Reserva;
use App\Models\Pagamento;

trait DashboardData
{
    protected function getDashboardData()
    {
        return [
            'clientesCount' => Cliente::count(),
            'pedidosCount' => Pedido::count(),
            'reservasCount' => Reserva::count(),
            'pagamentosCount' => Pagamento::count(),
            'estoqueCount' => Prato::where('estoque', '>', 0)->count() + Bebida::where('estoque', '>', 0)->count(),
        ];
    }
}
