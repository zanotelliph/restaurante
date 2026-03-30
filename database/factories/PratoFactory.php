<?php

namespace Database\Factories;

use App\Models\Prato;
use App\Models\CategoriaPrato;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prato>
 */
class PratoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nomes = [
            'Feijoada Completa',
            'Moqueca de Peixe',
            'Picanha na Brasa',
            'Bacalhau à Brás',
            'Risoto de Cogumelos',
            'Lasanha Bolonhesa',
            'Salmão Grelhado',
            'Frango com Quiabo',
            'Arroz com Feijão',
            'Bife à Parmegiana',
        ];

        $descricoes = [
            'Prato tradicional brasileiro',
            'Deliciosa receita regional',
            'Preparado com ingredientes frescos',
            'Opção leve e saudável',
            'Clássico da culinária internacional',
        ];

        return [
            'nome' => fake()->randomElement($nomes),
            'descricao' => fake()->randomElement($descricoes),
            'preco' => fake()->randomFloat(2, 15, 80),
            'categoria_prato_id' => CategoriaPrato::inRandomOrder()->first()->id ?? 1,
            'disponivel' => true,
            'imagem' => null,
            'estoque' => fake()->numberBetween(0, 100),
        ];
    }
}