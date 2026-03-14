<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Horario;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = Grupo::with(['horario.materia', 'horario.user'])->orderBy('id', 'desc')->get();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        $horarios = Horario::with(['materia', 'user'])->orderBy('id', 'desc')->get();
        return view('grupos.create', compact('horarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'horario_id' => 'required|exists:horarios,id',
            'nombre' => 'required|string|max:255',
        ]);

        Grupo::create([
            'horario_id' => $request->horario_id,
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('grupos.index')->with('success', 'Grupo creado correctamente.');
    }

    public function edit(Grupo $grupo)
    {
        $horarios = Horario::with(['materia', 'user'])->orderBy('id', 'desc')->get();
        return view('grupos.edit', compact('grupo', 'horarios'));
    }

    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'horario_id' => 'required|exists:horarios,id',
            'nombre' => 'required|string|max:255',
        ]);

        $grupo->update([
            'horario_id' => $request->horario_id,
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado correctamente.');
    }

    public function destroy(Grupo $grupo)
    {
        $grupo->delete();

        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado correctamente.');
    }
}
