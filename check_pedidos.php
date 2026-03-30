<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Pedido;

echo "Pedidos:\n";
foreach (Pedido::with('cliente', 'itens.prato', 'itens.bebida')->get() as $pedido) {
    echo "- Pedido #{$pedido->id} - Cliente: {$pedido->cliente->nome} - Total: R$ {$pedido->total} - Status: {$pedido->status}\n";
    foreach ($pedido->itens as $item) {
        $nome = $item->prato ? $item->prato->nome : $item->bebida->nome;
        echo "  - {$nome} x{$item->quantidade} (R$ {$item->preco_unitario})\n";
    }
    echo "\n";
}