<?php

namespace Database\Factories;

use App\Models\Catalogo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatalogoFactory extends Factory
{
    protected $model = Catalogo::class;

    public function definition(): array
    {
        
        $sufixo = strtoupper($this->faker->bothify('??##'));

        return [
            'flor_id'      => \App\Models\Flor::factory(),
            'categoria_id' => \App\Models\Categoria::factory(),
            'data_inicio'  => $this->faker->date('Y-m-d', 'now'),
            'data_fim'     => $this->faker->date('Y-m-d', '+6 months'),
            'codigo'       => $this->faker->unique()->numerify('FLOR - ####'),
        ];
    }
}