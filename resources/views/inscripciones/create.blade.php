@extends('layouts.app')

@section('content')
    <h1>Crear inscripción</h1>

    <form action="{{ route('inscripciones.store') }}" method="POST">
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
                    {{ $grupo->nombre }} - {{ $grupo->horario->materia->nombre }} - {{ $grupo->horario->user->nombre }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn">Guardar</button>
        <a href="{{ route('inscripciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection