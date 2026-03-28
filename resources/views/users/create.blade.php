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

        <div class="form-group">
            <label>Rol</label>
            <select name="rol" required>
                <option value="alumno" {{ old('rol') == 'alumno' ? 'selected' : '' }}>Alumno</option>
                <option value="maestro" {{ old('rol') == 'maestro' ? 'selected' : '' }}>Maestro</option>
            </select>
        </div>

        <label>
            <input type="checkbox" name="activo" value="1" checked style="width:auto;">
            Activo
        </label>

        <br><br>
        <button type="submit" class="btn">Guardar</button>
    </form>
@endsection