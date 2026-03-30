<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::inRandomOrder()->first()->id ?? 1,
            'total' => 0, // Will be calculated later
            'status' => fake()->randomElement(['pendente', 'preparando', 'pronto', 'entregue']),
            'observacoes' => fake()->optional()->sentence(),
        ];
    }
}