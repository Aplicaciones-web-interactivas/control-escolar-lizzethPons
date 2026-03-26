@extends('layouts.app')

@section('content')
    <h1 class="auth-title">Iniciar sesión</h1>
    <p class="auth-subtitle">Accede al sistema de control escolar</p>

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Clave institucional</label>
            <input type="text" name="clave_institucional" value="{{ old('clave_institucional') }}" required>
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn">Ingresar</button>
        <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
    </form>

    <p class="footer-note">Usa tu clave institucional y contraseña para entrar al sistema.</p>
@endsection