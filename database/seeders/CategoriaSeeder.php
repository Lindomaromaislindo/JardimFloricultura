<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            ['nome' => 'Buquês de Rosas', 'descricao' => 'Buque de rosas'],
            ['nome' => 'Flores para casamento', 'descricao' => 'flores para cerimonia de casamento'],
            ['nome' => 'Plantas ornamentais', 'descricao' => 'vasos para colocar fora e dentro de casa'],
            ['nome' => 'Cestas de presente', 'descricao' => 'cestas decoradas com flores'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
