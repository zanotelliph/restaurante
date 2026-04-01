<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PedidoItem extends Model
{
    use HasFactory;

    protected $table = 'pedido_itens';

    protected $fillable = [
        'pedido_id',
        'prato_id',
        'bebida_id',
        'quantidade',
        'preco_unitario'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function prato()
    {
        return $this->belongsTo(Prato::class);
    }

    public function bebida()
    {
        return $this->belongsTo(Bebida::class);
    }
}
