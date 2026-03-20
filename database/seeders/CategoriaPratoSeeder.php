<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaPratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nome' => 'Entrada', 'descricao' => 'Pratos leves para iniciar a refeição', 'ativo' => true],
            ['nome' => 'Prato Principal', 'descricao' => 'Pratos principais da refeição', 'ativo' => true],
            ['nome' => 'Acompanhamento', 'descricao' => 'Acompanhamentos para os pratos principais', 'ativo' => true],
            ['nome' => 'Sobremesa', 'descricao' => 'Pratos doces para finalizar a refeição', 'ativo' => true],
            ['nome' => 'Salada', 'descricao' => 'Saladas frescas e leves', 'ativo' => true],
        ];

        foreach ($categorias as $categoria) {
            \App\Models\CategoriaPrato::create($categoria);
        }
    }
}
