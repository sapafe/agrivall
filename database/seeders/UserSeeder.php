<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario principal (admin)
        User::updateOrCreate(
            ['email' => 'admin@agrivall.test'],
            [
                'name' => 'AgriVall Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_admin' => true,
            ]
        );

        // Usuario de prueba (no admin)
        User::updateOrCreate(
            ['email' => 'usuario@agrivall.test'],
            [
                'name' => 'Usuario Test',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_admin' => false,
            ]
        );
    }
}
