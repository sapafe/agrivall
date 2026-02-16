<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        
        $typeIds = DB::table('post_types')->pluck('id')->all();
        if (count($typeIds) === 0) {
            $this->call(PostTypeSeeder::class);
            $typeIds = DB::table('post_types')->pluck('id')->all();
        }

        $titles = [
            'Comienza la temporada de cerezas en AgriVall',
            'Cómo elegimos la fruta en su punto',
            'Albaricoques ecológicos: sabor y tradición',
            'Plan perfecto: fin de semana en La Casilla',
            'Ideas rápidas para aprovechar fruta madura',
            '5 consejos para conservar fruta fresca más tiempo',
            'Del campo a tu mesa: nuestro proceso',
            'Novedades de la huerta esta semana',
        ];

        $bodies = [
            "En AgriVall cuidamos cada detalle para que la fruta llegue fresca y sabrosa. Esta semana empezamos a recolectar y seleccionar a mano, priorizando el punto óptimo de maduración.\n\nTe contamos cómo trabajamos y cómo puedes disfrutarla en casa.",
            "La clave está en el momento de recogida. Recolectamos temprano para mantener la fruta firme y aromática. Luego hacemos una selección por calibre y calidad.\n\nSi quieres, puedes reservar tu caja semanal y recogerla en el punto acordado.",
            "Los albaricoques son una fruta delicada y muy aromática. Recomendamos guardarlos a temperatura ambiente si aún están firmes, y pasarlos a nevera cuando estén a punto.\n\nEn recetas, combinan genial con yogur, ensaladas y mermeladas caseras.",
            "La Casilla es un rincón para desconectar: naturaleza, calma y buen producto local. Si estás pensando en venir, aquí van ideas de rutas y planes sencillos.\n\nConsulta disponibilidad por semanas y reserva con antelación.",
            "Si tienes fruta madura, aprovéchala: compota rápida, batidos, topping para tostadas o incluso al horno con un toque de canela.\n\nEn el blog iremos subiendo recetas de temporada.",
        ];

        $images = [
            'images/blog/cerezas.jpg',
            'images/blog/albaricoques.jpg',
            'images/blog/huerta.jpg',
            null,
        ];

        for ($i = 0; $i < 12; $i++) {
            $title = $titles[array_rand($titles)];
            $body  = $bodies[array_rand($bodies)];

        DB::table('posts')->insert([
                'post_type_id' => $typeIds[array_rand($typeIds)],
                'title'        => $title,
                'body'         => $body,
                'published_at' => now()->subDays(rand(0, 120))->toDateString(), // date
                'image'        => $images[array_rand($images)],
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
