@extends('layouts.app')

@section('content')
    <h1>Crear materia</h1>

    <form action="{{ route('materias.store') }}" method="POST">
        @csrf

        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" required>

        <label>Clave</label>
        <input type="text" name="clave" value="{{ old('clave') }}" required>

        <button type="submit" class="btn">Guardar</button>
    </form>
@endsection