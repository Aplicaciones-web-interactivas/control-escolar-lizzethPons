@extends('layouts.app')

@section('content')
    <h1>Inicio</h1>

    <div class="grid-2">
        <div class="info-box">
            <h2>Bienvenido</h2>
            <p><strong>Usuario:</strong> {{ auth()->user()->nombre }}</p>
            <p><strong>Clave institucional:</strong> {{ auth()->user()->clave_institucional }}</p>
            <p>Desde este panel puedes administrar usuarios, materias, horarios, grupos, inscripciones y calificaciones.</p>
        </div>

        <div class="info-box">
            <h2>Mensaje de Chuck Norris</h2>
            <p>{{ $mensajeChuck }}</p>

            @if(!empty($debugChuck))
                <div style="margin-top:12px; padding:10px; background:#fff7ed; border-left:4px solid #f97316; border-radius:8px;">
                    <strong>Detalle:</strong> {{ $debugChuck }}
                </div>
            @endif

            <div style="margin-top: 15px;">
                <a href="{{ route('home') }}" class="btn btn-secondary">Cargar otro mensaje</a>
            </div>
        </div>
    </div>
@endsection