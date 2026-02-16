<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Week;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function create()
    {
        // semanas disponibles (ajusta el status según tu app)
        $weeks = Week::orderBy('year', 'desc')
            ->orderBy('week_number', 'desc')
            ->get();

        return view('casella.create', compact('weeks'));
    }

    public function store(Request $request)
    {
        // Si aún no tienes login, deja esto en comentario y lo hacemos "sin user" temporal.
        $data = $request->validate([
            'week_id' => ['required', 'exists:weeks,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        // Si quieres que la reserva vaya ligada a user_id como en tu migración:
        // necesitas estar logueada. De momento, obligamos login:
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        Reservation::create([
            'week_id' => $data['week_id'],
            'user_id' => auth()->id(),
            'reserved_at' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('casella.create')->with('ok', '¡Reserva enviada! Te contactaremos pronto.');
    }
}
