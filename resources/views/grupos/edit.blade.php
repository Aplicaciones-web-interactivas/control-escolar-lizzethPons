@extends('layouts.app')

@section('content')
    <h1>Editar grupo</h1>

    <form action="{{ route('grupos.update', $grupo) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre del grupo</label>
        <input type="text" name="nombre" value="{{ old('nombre', $grupo->nombre) }}" required>

        <label>Horario</label>
        <select name="horario_id" required>
            <option value="">Seleccione un horario</option>
            @foreach($horarios as $horario)
                <option value="{{ $horario->id }}" {{ old('horario_id', $grupo->horario_id) == $horario->id ? 'selected' : '' }}>
                    {{ $horario->materia->nombre }} - {{ $horario->user->nombre }} - {{ $horario->dia }} - {{ $horario->hora_inicio }} a {{ $horario->hora_fin }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn">Actualizar</button>
        <a href="{{ route('grupos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection