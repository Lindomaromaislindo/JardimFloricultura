<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flor extends Model
{
    use HasFactory;
    protected $table = 'flores';
    protected $fillable = ['nome', 'descricao', 'preco', 'categoria_id', 'imagem'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function catalogos()
    {
    return $this->hasMany(Catalogo::class);
    }
}
