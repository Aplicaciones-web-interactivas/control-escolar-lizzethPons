@extends('layouts.app')

@section('content')
    <h1>Materias</h1>
    <a href="{{ route('materias.create') }}" class="btn">Nueva materia</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Clave</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($materias as $materia)
                <tr>
                    <td>{{ $materia->id }}</td>
                    <td>{{ $materia->nombre }}</td>
                    <td>{{ $materia->clave }}</td>
                    <td>
                        <a href="{{ route('materias.edit', $materia) }}" class="btn btn-secondary">Editar</a>

                        <form action="{{ route('materias.destroy', $materia) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar materia?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay materias.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection