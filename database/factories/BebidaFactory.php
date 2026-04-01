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
        $bebidasBrasileiras = [
            // Cervejas Brasileiras
            ['nome' => 'Cerveja Brahma', 'descricao' => 'Cerveja clássica e refrescante'],
            ['nome' => 'Cerveja Skol', 'descricao' => 'Cerveja gelada e leve'],
            ['nome' => 'Cerveja Itaipava', 'descricao' => 'Cerveja artesanal brasileira'],
            ['nome' => 'Cerveja Antártica', 'descricao' => 'Cerveja com sabor único'],
            
            // Refrigerantes Brasileiros
            ['nome' => 'Guaraná Antártica', 'descricao' => 'Refrigerante com sabor único do Brasil'],
            ['nome' => 'Guaraná Jesus', 'descricao' => 'Guaraná tradicional e delicioso'],
            ['nome' => 'Refrigerante Cola', 'descricao' => 'Clássico refrigerante gelado'],
            ['nome' => 'Refrigerante Fanta', 'descricao' => 'Refrigerante colorido e doce'],
            
            // Sucos Naturais Brasileiros
            ['nome' => 'Suco de Laranja Fresco', 'descricao' => 'Suco natural espremido na hora'],
            ['nome' => 'Suco de Maracujá', 'descricao' => 'Suculento suco tropical'],
            ['nome' => 'Suco de Abacaxi', 'descricao' => 'Suco tropical refrescante'],
            ['nome' => 'Suco de Melancia', 'descricao' => 'Suco doce e hidratante'],
            ['nome' => 'Suco de Goiaba', 'descricao' => 'Suco rosa naturalmente doce'],
            
            // Bebidas Quentes
            ['nome' => 'Café Coado', 'descricao' => 'Café coado fresquinho'],
            ['nome' => 'Café Expresso', 'descricao' => 'Café forte e encorpado'],
            ['nome' => 'Café com Leite', 'descricao' => 'Combinação clássica do café da manhã'],
            ['nome' => 'Chá de Camomila', 'descricao' => 'Chá morno e relaxante'],
            ['nome' => 'Chá Verde', 'descricao' => 'Chá antioxidante e saudável'],
            
            // Bebidas Alcoólicas Brasileiras
            ['nome' => 'Caipirinha de Limão', 'descricao' => 'Coquetel clássico com cana'],
            ['nome' => 'Caipirinha de Morango', 'descricao' => 'Caipirinha frutada e doce'],
            ['nome' => 'Caipivoka', 'descricao' => 'Coquetel com vodka e frutas'],
            ['nome' => 'Batida de Coco', 'descricao' => 'Bebida doce com leite de coco'],
            ['nome' => 'Vinho Tinto Brasileiro', 'descricao' => 'Vinho fino de qualidade premium'],
            
            // Água e Bebidas Refrescantes
            ['nome' => 'Água Mineral', 'descricao' => 'Água pura e mineral gelada'],
            ['nome' => 'Água com Limão', 'descricao' => 'Água refrescante com limão fresco'],
            ['nome' => 'Água de Coco Natural', 'descricao' => 'Água de coco direto do fruto'],
            ['nome' => 'Refrigerante Água Tônica', 'descricao' => 'Bebida refrescante com quinina'],
        ];

        $bebida = fake()->randomElement($bebidasBrasileiras);

        return [
            'nome' => $bebida['nome'],
            'descricao' => $bebida['descricao'],
            'preco' => fake()->randomFloat(2, 2, 25),
            'categoria_bebida_id' => CategoriaBebida::inRandomOrder()->first()->id ?? 1,
            'imagem' => null,
            'estoque' => fake()->numberBetween(0, 100),
        ];
    }
}