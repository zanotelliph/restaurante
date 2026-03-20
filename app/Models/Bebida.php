<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bebida extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'categoria_bebida_id',
        'disponivel',
        'imagem',
        'estoque',
    ];

    protected $table = 'bebidas';
    protected $casts = [
        'disponivel' => 'boolean',
    ];

    public function pedidoItens()
    {
        return $this->hasMany(PedidoItem::class);
    }

    public function categoriaBebida()
    {
        return $this->belongsTo(CategoriaBebida::class, 'categoria_bebida_id');
    }
}
