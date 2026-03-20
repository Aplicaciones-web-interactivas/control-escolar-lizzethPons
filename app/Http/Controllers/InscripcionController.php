<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with(['grupo.horario.materia', 'user'])
            ->orderBy('id', 'desc')
            ->get();

        return view('inscripciones.index', compact('inscripciones'));
    }

    public function create()
    {
        $grupos = Grupo::with(['horario.materia', 'horario.user'])->orderBy('nombre')->get();
        $users = User::where('activo', 1)->orderBy('nombre')->get();

        return view('inscripciones.create', compact('grupos', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('inscripciones')->where(function ($query) use ($request) {
                    return $query->where('grupo_id', $request->grupo_id);
                }),
            ],
        ], [
            'user_id.unique' => 'Ese alumno ya está inscrito en ese grupo.',
        ]);

        Inscripcion::create([
            'grupo_id' => $request->grupo_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción creada correctamente.');
    }

    public function edit(string $id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $grupos = Grupo::with(['horario.materia', 'horario.user'])->orderBy('nombre')->get();
        $users = User::where('activo', 1)->orderBy('nombre')->get();

        return view('inscripciones.edit', compact('inscripcion', 'grupos', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $inscripcion = Inscripcion::findOrFail($id);

        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('inscripciones')
                    ->ignore($inscripcion->id)
                    ->where(function ($query) use ($request) {
                        return $query->where('grupo_id', $request->grupo_id);
                    }),
            ],
        ], [
            'user_id.unique' => 'Ese alumno ya está inscrito en ese grupo.',
        ]);

        $inscripcion->update([
            'grupo_id' => $request->grupo_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->delete();

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción eliminada correctamente.');
    }
}
