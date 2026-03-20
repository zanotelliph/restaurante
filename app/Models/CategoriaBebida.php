<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriaBebida extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'ativo',
    ];

    protected $table = 'categorias_bebidas';
    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function bebidas()
    {
        return $this->hasMany(Bebida::class, 'categoria_bebida_id');
    }
}
