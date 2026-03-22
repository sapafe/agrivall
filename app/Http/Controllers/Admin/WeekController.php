<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Week;
use Illuminate\Http\Request;

class WeekController extends Controller
{
    public function index()
    {
        $weeks = Week::orderBy('year', 'asc')->orderBy('week_number', 'asc')->get();
        return view('admin.weeks.index', compact('weeks'));
    }

    public function edit(Week $week)
    {
        return view('admin.weeks.edit', compact('week'));
    }

    public function update(Request $request, Week $week)
    {
        $data = $request->validate([
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'in:LIBRE,PRE-RESERVA,RESERVADO,NO DISPONIBLE'],
        ]);

        $week->update($data);

        return redirect()->route('admin.weeks.index')->with('success', 'Semana actualizada correctamente');
    }
}
