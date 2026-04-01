<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriaBebida extends Model
{
    use HasFactory;

    protected $table = 'categorias_bebidas';

    protected $fillable = [
        'nome',
        'ativo'
    ];

    public function bebidas()
    {
        return $this->hasMany(Bebida::class, 'categoria_bebida_id');
    }
}
