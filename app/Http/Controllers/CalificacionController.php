<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CalificacionController extends Controller
{
    public function index()
    {
        $calificaciones = Calificacion::with(['grupo.horario.materia', 'user'])
            ->orderBy('id', 'desc')
            ->get();

        return view('calificaciones.index', compact('calificaciones'));
    }

    public function create()
    {
        $grupos = Grupo::with(['horario.materia', 'horario.user'])->orderBy('nombre')->get();
        $users = User::where('activo', 1)->orderBy('nombre')->get();

        return view('calificaciones.create', compact('grupos', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('calificaciones')->where(function ($query) use ($request) {
                    return $query->where('grupo_id', $request->grupo_id);
                }),
            ],
            'calificacion' => 'required|numeric|min:0|max:10',
        ], [
            'user_id.unique' => 'Ese alumno ya tiene una calificación registrada en ese grupo.',
        ]);

        Calificacion::create([
            'grupo_id' => $request->grupo_id,
            'user_id' => $request->user_id,
            'calificacion' => $request->calificacion,
        ]);

        return redirect()->route('calificaciones.index')->with('success', 'Calificación creada correctamente.');
    }

    public function edit(string $id)
    {
        $calificacion = Calificacion::findOrFail($id);
        $grupos = Grupo::with(['horario.materia', 'horario.user'])->orderBy('nombre')->get();
        $users = User::where('activo', 1)->orderBy('nombre')->get();

        return view('calificaciones.edit', compact('calificacion', 'grupos', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $calificacion = Calificacion::findOrFail($id);

        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('calificaciones')
                    ->ignore($calificacion->id)
                    ->where(function ($query) use ($request) {
                        return $query->where('grupo_id', $request->grupo_id);
                    }),
            ],
            'calificacion' => 'required|numeric|min:0|max:10',
        ], [
            'user_id.unique' => 'Ese alumno ya tiene una calificación registrada en ese grupo.',
        ]);

        $calificacion->update([
            'grupo_id' => $request->grupo_id,
            'user_id' => $request->user_id,
            'calificacion' => $request->calificacion,
        ]);

        return redirect()->route('calificaciones.index')->with('success', 'Calificación actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $calificacion = Calificacion::findOrFail($id);
        $calificacion->delete();

        return redirect()->route('calificaciones.index')->with('success', 'Calificación eliminada correctamente.');
    }
}
