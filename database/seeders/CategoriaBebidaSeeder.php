<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaBebidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nome' => 'Refrigerante', 'descricao' => 'Bebidas carbonatadas e refrescantes', 'ativo' => true],
            ['nome' => 'Suco', 'descricao' => 'Sucos naturais e industrializados', 'ativo' => true],
            ['nome' => 'Café', 'descricao' => 'Cafés quentes e gelados', 'ativo' => true],
            ['nome' => 'Chá', 'descricao' => 'Chás de diversos sabores', 'ativo' => true],
            ['nome' => 'Vinho', 'descricao' => 'Vinhos tintos, brancos e rosés', 'ativo' => true],
            ['nome' => 'Cerveja', 'descricao' => 'Cervejas artesanais e comerciais', 'ativo' => true],
            ['nome' => 'Coquetel', 'descricao' => 'Drinks e coquetéis especiais', 'ativo' => true],
            ['nome' => 'Água', 'descricao' => 'Águas minerais e com gás', 'ativo' => true],
        ];

        foreach ($categorias as $categoria) {
            \App\Models\CategoriaBebida::create($categoria);
        }
    }
}
