<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Pedido;
use App\Models\CategoriaBebida;

class Bebida extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco',
        'descricao',
        'estoque',
        'imagem',
        'categoria_bebida_id'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function categoriaBebida()
    {
        return $this->belongsTo(CategoriaBebida::class, 'categoria_bebida_id');
    }
}
