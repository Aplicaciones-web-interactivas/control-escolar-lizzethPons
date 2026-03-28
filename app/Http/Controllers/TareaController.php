<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Grupo;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::with(['grupo.horario.materia', 'grupo.horario.user'])
            ->orderBy('id', 'desc')
            ->get();

        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        $grupos = Grupo::with(['horario.materia', 'horario.user'])->orderBy('nombre')->get();

        return view('tareas.create', compact('grupos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_entrega' => 'required|date',
        ]);

        Tarea::create([
            'grupo_id' => $request->grupo_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_entrega' => $request->fecha_entrega,
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    public function edit(string $id)
    {
        $tarea = Tarea::findOrFail($id);
        $grupos = Grupo::with(['horario.materia', 'horario.user'])->orderBy('nombre')->get();

        return view('tareas.edit', compact('tarea', 'grupos'));
    }

    public function update(Request $request, string $id)
    {
        $tarea = Tarea::findOrFail($id);

        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_entrega' => 'required|date',
        ]);

        $tarea->update([
            'grupo_id' => $request->grupo_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_entrega' => $request->fecha_entrega,
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada correctamente.');
    }
}