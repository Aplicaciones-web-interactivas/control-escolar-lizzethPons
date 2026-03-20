@extends('layouts.app')

@section('content')
    <h1>Inscripciones</h1>

    <a href="{{ route('inscripciones.create') }}" class="btn">Nueva inscripción</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Alumno</th>
                <th>Grupo</th>
                <th>Materia</th>
                <th>Profesor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inscripciones as $inscripcion)
                <tr>
                    <td>{{ $inscripcion->id }}</td>
                    <td>{{ $inscripcion->user->nombre }}</td>
                    <td>{{ $inscripcion->grupo->nombre }}</td>
                    <td>{{ $inscripcion->grupo->horario->materia->nombre }}</td>
                    <td>{{ $inscripcion->grupo->horario->user->nombre }}</td>
                    <td>
                        <a href="{{ route('inscripciones.edit', $inscripcion->id) }}" class="btn btn-secondary">Editar</a>

                        <form action="{{ route('inscripciones.destroy', $inscripcion->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar inscripción?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay inscripciones registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection