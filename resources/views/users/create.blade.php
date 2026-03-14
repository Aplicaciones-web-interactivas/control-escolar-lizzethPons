@extends('layouts.app')

@section('content')
    <h1>Crear usuario</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" required>

        <label>Clave institucional</label>
        <input type="text" name="clave_institucional" value="{{ old('clave_institucional') }}" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <label>Confirmar contraseña</label>
        <input type="password" name="password_confirmation" required>

        <label>Rol</label>
        <input type="text" name="rol" value="{{ old('rol', 'user') }}">

        <label>
            <input type="checkbox" name="activo" value="1" checked style="width:auto;">
            Activo
        </label>

        <br><br>
        <button type="submit" class="btn">Guardar</button>
    </form>
@endsection