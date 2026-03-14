@extends('layouts.app')

@section('content')
    <h1>Crear horario</h1>

    <form action="{{ route('horarios.store') }}" method="POST">
        @csrf

        <label>Materia</label>
        <select name="materia_id" required>
            <option value="">Seleccione una materia</option>
            @foreach($materias as $materia)
                <option value="{{ $materia->id }}" {{ old('materia_id') == $materia->id ? 'selected' : '' }}>
                    {{ $materia->nombre }} ({{ $materia->clave }})
                </option>
            @endforeach
        </select>

        <label>Profesor</label>
        <select name="user_id" required>
            <option value="">Seleccione un profesor</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->nombre }} - {{ $user->clave_institucional }}
                </option>
            @endforeach
        </select>

        <label>Día</label>
        <select name="dia" required>
            <option value="">Seleccione un día</option>
            <option value="Lunes" {{ old('dia') == 'Lunes' ? 'selected' : '' }}>Lunes</option>
            <option value="Martes" {{ old('dia') == 'Martes' ? 'selected' : '' }}>Martes</option>
            <option value="Miércoles" {{ old('dia') == 'Miércoles' ? 'selected' : '' }}>Miércoles</option>
            <option value="Jueves" {{ old('dia') == 'Jueves' ? 'selected' : '' }}>Jueves</option>
            <option value="Viernes" {{ old('dia') == 'Viernes' ? 'selected' : '' }}>Viernes</option>
            <option value="Sábado" {{ old('dia') == 'Sábado' ? 'selected' : '' }}>Sábado</option>
        </select>

        <label>Hora de inicio</label>
        <input type="time" name="hora_inicio" value="{{ old('hora_inicio') }}" required>

        <label>Hora de fin</label>
        <input type="time" name="hora_fin" value="{{ old('hora_fin') }}" required>

        <button type="submit" class="btn">Guardar</button>
        <a href="{{ route('horarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection