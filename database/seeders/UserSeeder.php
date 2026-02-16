<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario principal (para ti)
        User::updateOrCreate(
            ['email' => 'admin@agrivall.test'],
            [
                'name' => 'AgriVall Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

    }
}
