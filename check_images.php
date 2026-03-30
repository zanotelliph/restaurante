<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Prato;
use App\Models\Bebida;

echo "Pratos com imagens:\n";
foreach (Prato::whereNotNull('imagem')->get() as $p) {
    echo "ID: {$p->id} - Nome: {$p->nome}\n";
    echo "  Imagem: {$p->imagem}\n";
    echo "  Arquivo existe em storage/app/public? " . (file_exists(storage_path('app/public/' . $p->imagem)) ? 'SIM' : 'NÃO') . "\n";
    echo "  Arquivo existe em public? " . (file_exists(public_path('storage/' . $p->imagem)) ? 'SIM' : 'NÃO') . "\n";
    echo "  Asset URL: " . asset('storage/' . $p->imagem) . "\n\n";
}

echo "\n\nBebidas com imagens:\n";
foreach (Bebida::whereNotNull('imagem')->get() as $b) {
    echo "ID: {$b->id} - Nome: {$b->nome}\n";
    echo "  Imagem: {$b->imagem}\n";
    echo "  Arquivo existe em storage/app/public? " . (file_exists(storage_path('app/public/' . $b->imagem)) ? 'SIM' : 'NÃO') . "\n";
    echo "  Arquivo existe em public? " . (file_exists(public_path('storage/' . $b->imagem)) ? 'SIM' : 'NÃO') . "\n";
    echo "  Asset URL: " . asset('storage/' . $b->imagem) . "\n\n";
}