@extends('layouts.app')

@section('content')
    <h1>Crear calificación</h1>

    <form action="{{ route('calificaciones.store') }}" method="POST">
        @csrf

        <label>Alumno</label>
        <select name="user_id" required>
            <option value="">Seleccione un alumno</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->nombre }} - {{ $user->clave_institucional }}
                </option>
            @endforeach
        </select>

        <label>Grupo</label>
        <select name="grupo_id" required>
            <option value="">Seleccione un grupo</option>
            @foreach($grupos as $grupo)
                <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                    {{ $grupo->nombre }} - {{ $grupo->horario->materia->nombre }}
                </option>
            @endforeach
        </select>

        <label>Calificación</label>
        <input type="number" name="calificacion" value="{{ old('calificacion') }}" min="0" max="10" step="0.01" required>

        <button type="submit" class="btn">Guardar</button>
        <a href="{{ route('calificaciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection