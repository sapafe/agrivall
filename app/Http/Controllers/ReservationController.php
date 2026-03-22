<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Week;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function create()
    {
        $weeks = Week::orderBy('year', 'asc')
            ->orderBy('week_number', 'asc')
            ->where('year', '>=', 2026)
            ->get()
            ->groupBy(function($week) {
                return $week->year . '-' . str_pad($week->month, 2, '0', STR_PAD_LEFT);
            });

        return view('casella.create', compact('weeks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'week_id' => ['required', 'exists:weeks,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        $week = Week::findOrFail($data['week_id']);
        
        if ($week->status !== 'LIBRE') {
            return back()->withErrors(['week_id' => 'Esta semana ya no está disponible.']);
        }

        // Guardar la reserva
        Reservation::create([
            'week_id' => $data['week_id'],
            'user_id' => auth()->id() ?? 1, // Fallback al admin o primer usuario si no hay autenticación
            'reserved_at' => now(),
            'status' => 'pendiente',
        ]);

        // Actualizar el estado de la semana
        $week->update(['status' => 'PRE-RESERVA']);

        // Enviar Correo electrónico
        \Illuminate\Support\Facades\Mail::to(config('mail.from.address'))
            ->send(new \App\Mail\ReservationRequested([
                'name' => $data['name'],
                'email' => $data['email'],
                'message' => $data['message'],
                'week_descriptor' => $week->descriptor,
                'week_number' => $week->week_number,
                'year' => $week->year,
            ]));

        return redirect()->route('casella.create')->with('ok', '¡Reserva enviada! El estado de la semana ha pasado a PRE-RESERVA. Te contactaremos pronto.');
    }
}
