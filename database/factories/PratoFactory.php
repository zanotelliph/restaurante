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
        $pratosBrasileiros = [
            // Clássicos Cariocas e do Sudeste
            ['nome' => 'Feijoada Completa', 'descricao' => 'Clássico prato brasileiro com feijão, carnes e especiarias'],
            ['nome' => 'Moqueca de Peixe', 'descricao' => 'Peixe fresco em caldo de leite de coco e tomate'],
            ['nome' => 'Acarajé', 'descricao' => 'Bolinha de massa de feijão frita recheada com camarão'],
            ['nome' => 'Tacacá', 'descricao' => 'Sopa de mandioca com camarão e tucupi'],
            
            // Mineiro
            ['nome' => 'Brás de Frango', 'descricao' => 'Batata palha com frango desfiado e molho cremoso'],
            ['nome' => 'Frango com Quiabo', 'descricao' => 'Frango tenro em molho com quiabo macio'],
            
            // Nordeste
            ['nome' => 'Vatapá', 'descricao' => 'Caldo de peixe com farinha de mandioca e amendoim'],
            ['nome' => 'Pirarucu à Delícia', 'descricao' => 'Peixe amazônico grelhado com molho de tucupi'],
            ['nome' => 'Bife Acebolado', 'descricao' => 'Bisteca suculenta com cebola caramelizada'],
            ['nome' => 'Sarapatel', 'descricao' => 'Miúdos de porco em molho especiado'],
            
            // Sul
            ['nome' => 'Picanha na Brasa', 'descricao' => 'Carne de primeira qualidade grelhada na chama'],
            ['nome' => 'Churrasco Gaúcho', 'descricao' => 'Seleção de carnes vermelhas grelhadas'],
            ['nome' => 'Barreado', 'descricao' => 'Carne de panela em caldo concentrado'],
            
            // Internacionais também populares no Brasil
            ['nome' => 'Bacalhau à Brás', 'descricao' => 'Clássico português com batata palha'],
            ['nome' => 'Bife à Parmegiana', 'descricao' => 'Bife macio com queijo derretido e molho'],
            ['nome' => 'Risoto de Cogumelos', 'descricao' => 'Arroz cremoso com cogumelos frescos'],
            ['nome' => 'Salmão Grelhado', 'descricao' => 'Peixe nobre com limão siciliano'],
            ['nome' => 'Lasanha Bolonhesa', 'descricao' => 'Massa fresca com molho caseiro'],
            
            // Acompanhamentos básicos
            ['nome' => 'Arroz com Feijão', 'descricao' => 'O clássico acompanhamento brasileiro'],
            ['nome' => 'Bolinho de Chuva', 'descricao' => 'Acompanhamento crocante e macio'],
        ];

        $prato = fake()->randomElement($pratosBrasileiros);

        return [
            'nome' => $prato['nome'],
            'descricao' => $prato['descricao'],
            'preco' => fake()->randomFloat(2, 15, 80),
            'categoria_prato_id' => CategoriaPrato::inRandomOrder()->first()->id ?? 1,
            'imagem' => null,
            'estoque' => fake()->numberBetween(0, 100),
        ];
    }
}