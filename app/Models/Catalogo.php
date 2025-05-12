<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    use HasFactory;

    protected $table = 'catalogos';

    protected $fillable = [
        'flor_id',
        'categoria_id',
        'data_inicio',
        'data_fim',
        'codigo',
    ];
    protected $casts = [
        'flor_id'      => 'integer',
        'categoria_id' => 'integer',
        'data_inicio'  => 'date',
        'data_fim'     => 'date',
    ];

    public function flor() {
        return $this->belongsTo(Flor::class);
    }
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
}
