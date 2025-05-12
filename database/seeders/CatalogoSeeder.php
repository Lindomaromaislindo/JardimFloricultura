<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Catalogo;

class CatalogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Catalogo::factory()->count(10)->create();
    }
}
