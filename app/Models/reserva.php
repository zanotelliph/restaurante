<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'data_reserva',
        'hora_reserva',
        'pessoas',
        'status',
        'observacoes',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}