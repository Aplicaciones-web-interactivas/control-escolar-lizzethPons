@extends('layouts.app')

@section('content')
    <h1>Grupos</h1>

    <a href="{{ route('grupos.create') }}" class="btn">Nuevo grupo</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Grupo</th>
                <th>Materia</th>
                <th>Profesor</th>
                <th>Día</th>
                <th>Horario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->id }}</td>
                    <td>{{ $grupo->nombre }}</td>
                    <td>{{ $grupo->horario->materia->nombre }}</td>
                    <td>{{ $grupo->horario->user->nombre }}</td>
                    <td>{{ $grupo->horario->dia }}</td>
                    <td>{{ $grupo->horario->hora_inicio }} - {{ $grupo->horario->hora_fin }}</td>
                    <td>
                        <a href="{{ route('grupos.edit', $grupo) }}" class="btn btn-secondary">Editar</a>

                        <form action="{{ route('grupos.destroy', $grupo) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar grupo?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay grupos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection