@extends('layouts.app')

@section('content')
    <h1 class="auth-title">Registro</h1>
    <p class="auth-subtitle">Crea una cuenta para acceder al sistema</p>

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label>Clave institucional</label>
            <input type="text" name="clave_institucional" value="{{ old('clave_institucional') }}" required>
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label>Confirmar contraseña</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-success">Registrarse</button>
        <a href="{{ route('login') }}" class="btn btn-secondary">Volver al login</a>
    </form>
@endsection