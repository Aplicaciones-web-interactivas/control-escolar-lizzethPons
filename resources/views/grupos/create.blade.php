@extends('layouts.app')

@section('content')
    <h1>Crear grupo</h1>

    <form action="{{ route('grupos.store') }}" method="POST">
        @csrf

        <label>Nombre del grupo</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" required>

        <label>Horario</label>
        <select name="horario_id" required>
            <option value="">Seleccione un horario</option>
            @foreach($horarios as $horario)
                <option value="{{ $horario->id }}" {{ old('horario_id') == $horario->id ? 'selected' : '' }}>
                    {{ $horario->materia->nombre }} - {{ $horario->user->nombre }} - {{ $horario->dia }} - {{ $horario->hora_inicio }} a {{ $horario->hora_fin }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn">Guardar</button>
        <a href="{{ route('grupos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection