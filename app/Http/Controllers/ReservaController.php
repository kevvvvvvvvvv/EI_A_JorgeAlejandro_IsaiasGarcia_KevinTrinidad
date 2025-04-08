<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ReservaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $reservas = Reserva::paginate();

        return view('reserva.index', compact('reservas'))
            ->with('i', ($request->input('page', 1) - 1) * $reservas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reserva = new Reserva();
        
        // Obtener eventos formateando la fecha en PHP
        $eventos = Reserva::whereIn('estado', ['confirmado', 'pendiente'])
            ->get()
            ->map(function ($item) {
                return [
                    'start' => $item->fechaR, // Usar el campo fechaR directamente
                    'color' => $this->getColorByEstado($item->estado),
                    'title' => strtoupper($item->estado)
                ];
            })->toArray();
    
        return view('reserva.create', compact('reserva', 'eventos'));
    }
    
    private function getColorByEstado($estado)
    {
        return match($estado) {
            'confirmado' => '#ef4444',    // Rojo
            'pendiente' => '#eab308',     // Amarillo
            default => '#6b7280'          // Gris
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservaRequest $request): RedirectResponse
    {
        Reserva::create($request->validated());

        return Redirect::route('reservas.index')
            ->with('success', 'Reserva created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $reserva = Reserva::find($id);

        return view('reserva.show', compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $reserva = Reserva::find($id);

        return view('reserva.edit', compact('reserva'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservaRequest $request, Reserva $reserva): RedirectResponse
    {
        $reserva->update($request->validated());

        return Redirect::route('reservas.index')
            ->with('success', 'Reserva updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Reserva::find($id)->delete();

        return Redirect::route('reservas.index')
            ->with('success', 'Reserva deleted successfully');
    }

    public function mostrarCalendario(){
        // Obtener todas las reservas
        $reservas = DB::table('reservas')->get();
        
        // Obtener solo fechas ocupadas (confirmadas o pendientes)
        $fechasOcupadas = DB::table('reservas')
            ->whereIn('estado', ['confirmado', 'pendiente'])
            ->pluck('fechaR')
            ->toArray();

        return view('reserva.calendario', [
            'reservas' => $reservas,
            'fechasOcupadas' => $fechasOcupadas
        ]);
    }
}
