<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::with(['materia', 'user'])->orderBy('id', 'desc')->get();
        return view('horarios.index', compact('horarios'));
    }

    public function create()
    {
        $materias = Materia::orderBy('nombre')->get();
        $users = User::where('activo', 1)->orderBy('nombre')->get();

        return view('horarios.create', compact('materias', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'materia_id' => 'required|exists:materias,id',
            'user_id' => 'required|exists:users,id',
            'dia' => 'required|string|max:20',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        Horario::create([
            'materia_id' => $request->materia_id,
            'user_id' => $request->user_id,
            'dia' => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);

        return redirect()->route('horarios.index')->with('success', 'Horario creado correctamente.');
    }

    public function edit(Horario $horario)
    {
        $materias = Materia::orderBy('nombre')->get();
        $users = User::where('activo', 1)->orderBy('nombre')->get();

        return view('horarios.edit', compact('horario', 'materias', 'users'));
    }

    public function update(Request $request, Horario $horario)
    {
        $request->validate([
            'materia_id' => 'required|exists:materias,id',
            'user_id' => 'required|exists:users,id',
            'dia' => 'required|string|max:20',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        $horario->update([
            'materia_id' => $request->materia_id,
            'user_id' => $request->user_id,
            'dia' => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);

        return redirect()->route('horarios.index')->with('success', 'Horario actualizado correctamente.');
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();

        return redirect()->route('horarios.index')->with('success', 'Horario eliminado correctamente.');
    }
}
