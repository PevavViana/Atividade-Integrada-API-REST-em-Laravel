<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'media_notas',
        'categoria_id',
    ];

    # Relacionamentos
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }
}
