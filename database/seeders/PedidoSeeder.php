<?php

namespace Database\Seeders;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Prato;
use App\Models\Bebida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pedido::factory(10)->create()->each(function ($pedido) {
            $itens = fake()->numberBetween(1, 5);
            $total = 0;

            for ($i = 0; $i < $itens; $i++) {
                $isPrato = fake()->boolean();
                $quantidade = fake()->numberBetween(1, 3);

                if ($isPrato) {
                    $item = Prato::inRandomOrder()->first();
                    $precoUnitario = $item->preco;
                    PedidoItem::create([
                        'pedido_id' => $pedido->id,
                        'prato_id' => $item->id,
                        'quantidade' => $quantidade,
                        'preco_unitario' => $precoUnitario,
                    ]);
                } else {
                    $item = Bebida::inRandomOrder()->first();
                    $precoUnitario = $item->preco;
                    PedidoItem::create([
                        'pedido_id' => $pedido->id,
                        'bebida_id' => $item->id,
                        'quantidade' => $quantidade,
                        'preco_unitario' => $precoUnitario,
                    ]);
                }

                $total += $precoUnitario * $quantidade;
            }

            $pedido->update(['total' => $total]);
        });
    }
}