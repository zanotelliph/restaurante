<?php

namespace Database\Factories;

use App\Models\Bebida;
use App\Models\CategoriaBebida;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bebida>
 */
class BebidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nomes = [
            'Coca-Cola',
            'Suco de Laranja',
            'Café Expresso',
            'Chá Verde',
            'Vinho Tinto',
            'Cerveja Brahma',
            'Caipirinha',
            'Água Mineral',
            'Refrigerante Guaraná',
            'Suco de Uva',
        ];

        $descricoes = [
            'Bebida refrescante',
            'Opção clássica',
            'Preparada na hora',
            'Importada',
            'Produzida artesanalmente',
        ];

        return [
            'nome' => fake()->randomElement($nomes),
            'descricao' => fake()->randomElement($descricoes),
            'preco' => fake()->randomFloat(2, 2, 20),
            'categoria_bebida_id' => CategoriaBebida::inRandomOrder()->first()->id ?? 1,
            'disponivel' => true,
            'imagem' => null,
            'estoque' => fake()->numberBetween(0, 100),
        ];
    }
}