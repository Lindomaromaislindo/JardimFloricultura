<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'flor_id',
        'forma_pagamento',
        'endereco_entrega',
        'status', 
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function flor()
    {
        return $this->belongsTo(Flor::class);
    }
}
