@extends('layouts.app')

@section('content')
    <h1>Calificaciones</h1>

    <a href="{{ route('calificaciones.create') }}" class="btn">Nueva calificación</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Alumno</th>
                <th>Grupo</th>
                <th>Materia</th>
                <th>Calificación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($calificaciones as $calificacion)
                <tr>
                    <td>{{ $calificacion->id }}</td>
                    <td>{{ $calificacion->user->nombre }}</td>
                    <td>{{ $calificacion->grupo->nombre }}</td>
                    <td>{{ $calificacion->grupo->horario->materia->nombre }}</td>
                    <td>{{ $calificacion->calificacion }}</td>
                    <td>
                        <a href="{{ route('calificaciones.edit', $calificacion->id) }}" class="btn btn-secondary">Editar</a>

                        <form action="{{ route('calificaciones.destroy', $calificacion->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar calificación?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay calificaciones registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection