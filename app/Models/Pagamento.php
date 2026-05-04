<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  
class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'cartao',
    ];

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class);
    }
}