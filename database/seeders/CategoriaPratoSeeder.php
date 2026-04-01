<?php

namespace Database\Seeders;

use App\Models\CategoriaPrato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaPratoSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nome' => 'Entrada', 'descricao' => 'Pratos para começar'],
            ['nome' => 'Prato Principal', 'descricao' => 'Pratos principais'],
            ['nome' => 'Acompanhamento', 'descricao' => 'Acompanhamentos'],
            ['nome' => 'Sobremesa', 'descricao' => 'Doces e sobremesas'],
            ['nome' => 'Especial do Dia', 'descricao' => 'Pratos especiais'],
        ];

        foreach ($categorias as $categoria) {
            CategoriaPrato::firstOrCreate(
                ['nome' => $categoria['nome']],
                ['descricao' => $categoria['descricao']]
            );
        }
    }
}
