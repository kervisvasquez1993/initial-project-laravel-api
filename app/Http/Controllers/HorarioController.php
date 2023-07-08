<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'dia' => 'required',
            'cancha' => 'required',
            'fecha' => 'required|date',
        ]);

        $dia = $request->query('dia');
        $idCancha = $request->query('cancha');
        $fecha = $request->query('fecha');

        $horarios = Horario::with(['reservas' => function ($query) use ($fecha) {
            $query->where('fecha', $fecha);
        }])
            ->where('dia_semana', $dia)
            ->where('id_cancha', $idCancha)
            ->get();

        return response()->json($horarios);
    }
    public function showAll(){
        $horarios = Horario::all();
        return response()->json($horarios);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
