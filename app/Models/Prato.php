<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'categoria_prato_id',
        'disponivel',
        'imagem',
        'estoque',
    ];

    protected $table = 'pratos';
    protected $casts = [
        'disponivel' => 'boolean',
    ];

    public function pedidoItens()
    {
        return $this->hasMany(PedidoItem::class);
    }

    public function categoriaPrato()
    {
        return $this->belongsTo(CategoriaPrato::class, 'categoria_prato_id');
    }
}
