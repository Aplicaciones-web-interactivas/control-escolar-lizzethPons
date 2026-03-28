@extends('layouts.app')

@section('content')
    <h1>Tareas</h1>

    <div class="actions-top">
        <a href="{{ route('tareas.create') }}" class="btn">Nueva tarea</a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Grupo</th>
                    <th>Materia</th>
                    <th>Maestro</th>
                    <th>Fecha entrega</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tareas as $tarea)
                    <tr>
                        <td>{{ $tarea->id }}</td>
                        <td>{{ $tarea->titulo }}</td>
                        <td>{{ $tarea->grupo->nombre }}</td>
                        <td>{{ $tarea->grupo->horario->materia->nombre }}</td>
                        <td>{{ $tarea->grupo->horario->user->nombre }}</td>
                        <td>{{ $tarea->fecha_entrega }}</td>
                        <td>
                            <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-secondary">Editar</a>

                            <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar tarea?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No hay tareas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection