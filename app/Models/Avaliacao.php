<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';
    protected $fillable = [
        'titulo',
        'descricao',
        'nota',
        'data',
        'usuario_id',
        'produto_id',
    ];

    # Relacionamentos
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
