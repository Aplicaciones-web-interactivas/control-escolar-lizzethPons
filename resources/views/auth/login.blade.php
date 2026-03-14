@extends('layouts.app')

@section('content')
    <h1>Login</h1>

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <label>Clave institucional</label>
        <input type="text" name="clave_institucional" value="{{ old('clave_institucional') }}" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn">Ingresar</button>
    </form>
@endsection