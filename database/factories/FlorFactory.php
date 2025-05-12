<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word,
            'descricao' => $this->faker->sentence,
            'preco' => $this->faker->randomFloat(2, 10, 100),
            'categoria_id' => Categoria::inRandomOrder()->first()->id ?? Categoria::factory(),
        ];
    }
}

