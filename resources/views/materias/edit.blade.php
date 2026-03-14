@extends('layouts.app')

@section('content')
    <h1>Editar materia</h1>

    <form action="{{ route('materias.update', $materia) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre', $materia->nombre) }}" required>

        <label>Clave</label>
        <input type="text" name="clave" value="{{ old('clave', $materia->clave) }}" required>

        <button type="submit" class="btn">Actualizar</button>
    </form>
@endsection