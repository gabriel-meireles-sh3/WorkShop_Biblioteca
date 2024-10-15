<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livro extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'livros';

    protected $primaryKey = 'id';

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const DELETED_AT = 'excluido_em';

    protected $fillable = [
        'titulo',
        'anoPublicacao',
        'descricao',
        'comentario_id',
    ];

    protected $hidden = [
        'criado_em',
        'atualizado_em',
        'excluido_em',
    ];

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'autor_livro_pivot', 'livro_id', 'autor_id');
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_livro_pivot', 'livro_id', 'categoria_id');
    }

    public function comentario()
    {
        return $this->hasOne(Comentario::class, 'comentario_id');
    }

}
