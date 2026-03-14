@extends('layouts.app')

@section('content')
    <h1>Horarios</h1>

    <a href="{{ route('horarios.create') }}" class="btn">Nuevo horario</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Materia</th>
                <th>Profesor</th>
                <th>Día</th>
                <th>Hora inicio</th>
                <th>Hora fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($horarios as $horario)
                <tr>
                    <td>{{ $horario->id }}</td>
                    <td>{{ $horario->materia->nombre }}</td>
                    <td>{{ $horario->user->nombre }}</td>
                    <td>{{ $horario->dia }}</td>
                    <td>{{ $horario->hora_inicio }}</td>
                    <td>{{ $horario->hora_fin }}</td>
                    <td>
                        <a href="{{ route('horarios.edit', $horario) }}" class="btn btn-secondary">Editar</a>

                        <form action="{{ route('horarios.destroy', $horario) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar horario?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay horarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection