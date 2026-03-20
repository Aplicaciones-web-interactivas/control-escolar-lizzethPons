@extends('layouts.app')

@section('content')
    <h1>Editar inscripción</h1>

    <form action="{{ route('inscripciones.update', $inscripcion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Alumno</label>
        <select name="user_id" required>
            <option value="">Seleccione un alumno</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id', $inscripcion->user_id) == $user->id ? 'selected' : '' }}>
                    {{ $user->nombre }} - {{ $user->clave_institucional }}
                </option>
            @endforeach
        </select>

        <label>Grupo</label>
        <select name="grupo_id" required>
            <option value="">Seleccione un grupo</option>
            @foreach($grupos as $grupo)
                <option value="{{ $grupo->id }}" {{ old('grupo_id', $inscripcion->grupo_id) == $grupo->id ? 'selected' : '' }}>
                    {{ $grupo->nombre }} - {{ $grupo->horario->materia->nombre }} - {{ $grupo->horario->user->nombre }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn">Actualizar</button>
        <a href="{{ route('inscripciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection