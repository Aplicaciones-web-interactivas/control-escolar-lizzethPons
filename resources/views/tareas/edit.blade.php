@extends('layouts.app')

@section('content')
    <h1>Editar tarea</h1>

    <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Grupo</label>
            <select name="grupo_id" required>
                <option value="">Seleccione un grupo</option>
                @foreach($grupos as $grupo)
                    <option value="{{ $grupo->id }}" {{ old('grupo_id', $tarea->grupo_id) == $grupo->id ? 'selected' : '' }}>
                        {{ $grupo->nombre }} - {{ $grupo->horario->materia->nombre }} - {{ $grupo->horario->user->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Título</label>
            <input type="text" name="titulo" value="{{ old('titulo', $tarea->titulo) }}" required>
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <input type="text" name="descripcion" value="{{ old('descripcion', $tarea->descripcion) }}">
        </div>

        <div class="form-group">
            <label>Fecha de entrega</label>
            <input type="date" name="fecha_entrega" value="{{ old('fecha_entrega', $tarea->fecha_entrega) }}" required>
        </div>

        <button type="submit" class="btn">Actualizar</button>
        <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection