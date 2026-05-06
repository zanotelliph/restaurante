<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'valor',
        'metodo',
        'status',
        'pago_em',
        'observacoes',
    ];

    protected $casts = [
        'pago_em' => 'datetime',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
