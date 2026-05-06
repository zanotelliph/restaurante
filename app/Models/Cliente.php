<?php

namespace App\Models;

use App\Models\Reserva;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cpf',
        'endereco',
        'imagem'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
