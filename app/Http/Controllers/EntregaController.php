<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EntregaController extends Controller
{
    public function indexAlumno()
    {
        $userId = Auth::id();

        $tareas = Tarea::whereHas('grupo.inscripciones', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->with(['grupo.horario.materia', 'entregas' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->orderBy('id', 'desc')
            ->get();

        return view('entregas.alumno', compact('tareas'));
    }

    public function store(Request $request, string $tareaId)
    {
        $tarea = Tarea::findOrFail($tareaId);

        $request->validate([
            'archivo' => 'required|file|mimes:pdf|max:2048',
        ]);

        $userId = Auth::id();

        $entregaExistente = Entrega::where('tarea_id', $tarea->id)
            ->where('user_id', $userId)
            ->first();

        if ($entregaExistente) {
            if (Storage::disk('public')->exists($entregaExistente->archivo)) {
                Storage::disk('public')->delete($entregaExistente->archivo);
            }

            $entregaExistente->delete();
        }

        $rutaArchivo = $request->file('archivo')->store('entregas', 'public');

        Entrega::create([
            'tarea_id' => $tarea->id,
            'user_id' => $userId,
            'archivo' => $rutaArchivo,
            'fecha_entrega' => now(),
        ]);

        return redirect()->route('mis.tareas')->with('success', 'Entrega subida correctamente.');
    }

   public function revisar()
    {
        $entregas = Entrega::with(['tarea.grupo.horario.materia', 'tarea.grupo.horario.user', 'user'])
            ->orderBy('id', 'desc')
            ->get();

        return view('entregas.revisar', compact('entregas'));
    }

    public function descargar(string $id)
    {
        $entrega = Entrega::findOrFail($id);

        return Storage::disk('public')->download($entrega->archivo);
    }
}