<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo '=== USUÁRIOS ===' . PHP_EOL;
foreach(App\Models\User::all() as $u) {
    echo $u->name . ' (' . $u->email . ')' . PHP_EOL;
}

echo PHP_EOL . '=== CATEGORIAS PRATOS ===' . PHP_EOL;
foreach(App\Models\CategoriaPrato::all() as $c) {
    echo $c->nome . ' - ' . $c->descricao . PHP_EOL;
}

echo PHP_EOL . '=== CATEGORIAS BEBIDAS ===' . PHP_EOL;
foreach(App\Models\CategoriaBebida::all() as $c) {
    echo $c->nome . ' - ' . $c->descricao . PHP_EOL;
}

echo PHP_EOL . '=== PRATOS ===' . PHP_EOL;
foreach(App\Models\Prato::all() as $p) {
    echo $p->nome . ' (' . $p->categoriaPrato->nome . ') - R$ ' . $p->preco . PHP_EOL;
}

echo PHP_EOL . '=== BEBIDAS ===' . PHP_EOL;
foreach(App\Models\Bebida::all() as $b) {
    echo $b->nome . ' (' . $b->categoriaBebida->nome . ') - R$ ' . $b->preco . PHP_EOL;
}