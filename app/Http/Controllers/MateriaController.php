<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::orderBy('id', 'desc')->get();
        return view('materias.index', compact('materias'));
    }

    public function create()
    {
        return view('materias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'clave' => 'required|max:255|unique:materias,clave',
        ]);

        Materia::create([
            'nombre' => $request->nombre,
            'clave' => $request->clave,
        ]);

        return redirect()->route('materias.index')->with('success', 'Materia creada correctamente.');
    }

    public function edit(Materia $materia)
    {
        return view('materias.edit', compact('materia'));
    }

    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'clave' => [
                'required',
                'max:255',
                Rule::unique('materias', 'clave')->ignore($materia->id),
            ],
        ]);

        $materia->update([
            'nombre' => $request->nombre,
            'clave' => $request->clave,
        ]);

        return redirect()->route('materias.index')->with('success', 'Materia actualizada correctamente.');
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();

        return redirect()->route('materias.index')->with('success', 'Materia eliminada correctamente.');
    }
}