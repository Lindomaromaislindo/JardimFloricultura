<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategoriaSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(FlorSeeder::class);
        $this->call(PedidoSeeder::class);
        $this->call(CatalogoSeeder::class);
    }
}
