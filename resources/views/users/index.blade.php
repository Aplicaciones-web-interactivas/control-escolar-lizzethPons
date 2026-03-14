@extends('layouts.app')

@section('content')
    <h1>Usuarios</h1>
    <a href="{{ route('users.create') }}" class="btn">Nuevo usuario</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Clave institucional</th>
                <th>Rol</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nombre }}</td>
                    <td>{{ $user->clave_institucional }}</td>
                    <td>{{ $user->rol }}</td>
                    <td>{{ $user->activo ? 'Sí' : 'No' }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-secondary">Editar</a>

                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar usuario?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay usuarios.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection