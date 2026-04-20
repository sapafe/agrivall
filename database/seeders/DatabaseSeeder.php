<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Sembrar la base de datos de la aplicación.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PostTypeSeeder::class,
            PostSeeder::class,
            ProductSeeder::class,
            WeekSeeder::class,
        ]);
    }
}