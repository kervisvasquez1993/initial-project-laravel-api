<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener las reservas del usuario autenticado con la información del horario, la cancha y el usuario
        $reservas = Reserva::with('horario.cancha', 'user')->get();

        // Eliminar el campo 'id_horario' de cada reserva
        $reservas->transform(function ($reserva) {
            unset($reserva->id_horario);
            unset($reserva->id_user);
            unset($reserva->horario->id_cancha);
            return $reserva;
        });

        return response()->json($reservas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'id_horario' => 'required|exists:horarios,id',
        ]);

        // Verificar si el horario y la fecha están disponibles
        $reservaExistente = Reserva::where('fecha', $request->fecha)
            ->where('id_horario', $request->id_horario)
            ->exists();

        if ($reservaExistente) {
            return response()->json(['error' => 'El horario ya está ocupado'], 400);
        }

        // Crear la reserva
        $reserva = Reserva::create([
            'fecha' => $request->fecha,
            'id_horario' => $request->id_horario,
            'porcentaje_lluvia' => $request->porcentaje_lluvia,
            'id_user' => auth()->id(),
        ]);

        return response()->json(['message' => 'Reserva creada con éxito', 'data' => $reserva]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
