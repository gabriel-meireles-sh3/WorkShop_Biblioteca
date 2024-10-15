<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'categorias';

    protected $primaryKey = 'id';

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const DELETED_AT = 'excluido_em';

    protected $fillable = [
        'nome',
    ];

    protected $hidden = [
        'criado_em',
        'atualizado_em',
        'excluido_em',
    ];

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'autor_livro', 'livro_id', 'categoria_id');
    }
}
