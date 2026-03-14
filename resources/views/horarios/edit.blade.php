@extends('layouts.app')

@section('content')
    <h1>Editar horario</h1>

    <form action="{{ route('horarios.update', $horario) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Materia</label>
        <select name="materia_id" required>
            <option value="">Seleccione una materia</option>
            @foreach($materias as $materia)
                <option value="{{ $materia->id }}" {{ old('materia_id', $horario->materia_id) == $materia->id ? 'selected' : '' }}>
                    {{ $materia->nombre }} ({{ $materia->clave }})
                </option>
            @endforeach
        </select>

        <label>Profesor</label>
        <select name="user_id" required>
            <option value="">Seleccione un profesor</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id', $horario->user_id) == $user->id ? 'selected' : '' }}>
                    {{ $user->nombre }} - {{ $user->clave_institucional }}
                </option>
            @endforeach
        </select>

        <label>Día</label>
        <select name="dia" required>
            <option value="Lunes" {{ old('dia', $horario->dia) == 'Lunes' ? 'selected' : '' }}>Lunes</option>
            <option value="Martes" {{ old('dia', $horario->dia) == 'Martes' ? 'selected' : '' }}>Martes</option>
            <option value="Miércoles" {{ old('dia', $horario->dia) == 'Miércoles' ? 'selected' : '' }}>Miércoles</option>
            <option value="Jueves" {{ old('dia', $horario->dia) == 'Jueves' ? 'selected' : '' }}>Jueves</option>
            <option value="Viernes" {{ old('dia', $horario->dia) == 'Viernes' ? 'selected' : '' }}>Viernes</option>
            <option value="Sábado" {{ old('dia', $horario->dia) == 'Sábado' ? 'selected' : '' }}>Sábado</option>
        </select>

        <label>Hora de inicio</label>
        <input type="time" name="hora_inicio" value="{{ old('hora_inicio', $horario->hora_inicio) }}" required>

        <label>Hora de fin</label>
        <input type="time" name="hora_fin" value="{{ old('hora_fin', $horario->hora_fin) }}" required>

        <button type="submit" class="btn">Actualizar</button>
        <a href="{{ route('horarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection