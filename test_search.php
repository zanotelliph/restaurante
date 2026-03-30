<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Prato;
use App\Models\Bebida;

// Testar busca
$search = 'Feijoada';

echo "Buscando por: '$search'\n\n";

$pratos = Prato::where('nome', 'LIKE', "%{$search}%")->get();
$bebidas = Bebida::where('nome', 'LIKE', "%{$search}%")->get();

echo "Pratos encontrados: " . $pratos->count() . "\n";
foreach ($pratos as $prato) {
    echo "- {$prato->nome}\n";
}

echo "\nBebidas encontradas: " . $bebidas->count() . "\n";
foreach ($bebidas as $bebida) {
    echo "- {$bebida->nome}\n";
}