<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriaPrato extends Model
{
    use HasFactory;

    protected $table = 'categorias_pratos';

    protected $fillable = [
        'nome',
        'ativo'
    ];

    public function pratos()
    {
        return $this->hasMany(Prato::class, 'categoria_prato_id');
    }
}
