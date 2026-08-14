<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'cpf',
    ];

    # Relacionamentos
    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }
}