@extends('layouts.app')

@section('content')
    <h1>Editar usuario</h1>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre', $user->nombre) }}" required>

        <label>Clave institucional</label>
        <input type="text" name="clave_institucional" value="{{ old('clave_institucional', $user->clave_institucional) }}" required>

        <label>Nueva contraseña</label>
        <input type="password" name="password">

        <label>Confirmar nueva contraseña</label>
        <input type="password" name="password_confirmation">

        <label>Rol</label>
        <input type="text" name="rol" value="{{ old('rol', $user->rol) }}">

        <label>
            <input type="checkbox" name="activo" value="1" {{ $user->activo ? 'checked' : '' }} style="width:auto;">
            Activo
        </label>

        <br><br>
        <button type="submit" class="btn">Actualizar</button>
    </form>
@endsection