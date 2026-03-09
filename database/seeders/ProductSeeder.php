<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Cerezas',
            'variety' => 'Burlat',
            'format' => '2Kg',
            'price' => 10.00,
            'image' => 'images/productos/cerezas.png',
            'available' => true,
        ]);

        Product::create([
            'name' => 'Cerezas',
            'variety' => 'Burlat',
            'format' => '5Kg',
            'price' => 22.00,
            'image' => 'images/productos/cerezas.png',
            'available' => true,
        ]);

        Product::create([
            'name' => 'Albaricoques',
            'variety' => 'Ecológico',
            'format' => '2Kg',
            'price' => 8.50,
            'image' => 'images/productos/albaricoques.png',
            'available' => true,
        ]);

        Product::create([
            'name' => 'Albaricoques',
            'variety' => 'Ecológico',
            'format' => '5Kg',
            'price' => 19.50,
            'image' => 'images/productos/albaricoques.png',
            'available' => true,
        ]);
    }
}