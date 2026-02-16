<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Noticias',
            'Recetas',
            'Temporada',
            'La Casilla',
            'Consejos',
        ];

        foreach ($types as $name) {
            DB::table('post_types')->updateOrInsert(
                ['name' => $name],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}

