<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Week;
use Carbon\Carbon;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::create(2026, 3, 9); // La semana 11 comienza el 9 de marzo de 2026
        $year = 2026;
        $startWeek = 11;

        for ($i = 0; $i < 54; $i++) {
            $currentWeek = $startWeek + $i;
            $weekYear = $year;
            
            // Gestionar el cambio de año si es necesario (aunque 30 semanas desde la 11 todavía están en 2026)
            if ($currentWeek > 52) {
                // $currentWeek = $currentWeek - 52;
                // $weekYear++;
            }

            $endOfWeek = $startDate->copy()->addDays(6);
            
            $descriptor = $startDate->format('j M') . '-' . $endOfWeek->format('j M');

            Week::create([
                'year' => $startDate->year,
                'week_number' => $startDate->weekOfYear,
                'month' => $startDate->month,
                'descriptor' => $descriptor,
                'price' => 0,
                'status' => 'LIBRE',
            ]);

            $startDate->addWeek();
        }
    }
}
