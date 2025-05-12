<?php

namespace Database\Factories;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    public function definition(): array
    {
        return [
            'cliente_id' => \App\Models\Cliente::factory(),
            'flor_id' => \App\Models\Flor::factory(),
            'forma_pagamento' => $this->faker->randomElement(['Cartão de Crédito', 'Boleto', 'Pix']),
            'endereco_entrega' => $this->faker->address,
            'status' => $this->faker->randomElement(['Pendente', 'Pago', 'Cancelado']),
        ];
    }
}
