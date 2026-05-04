<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Reserva;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}