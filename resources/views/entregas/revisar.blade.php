@extends('layouts.app')

@section('content')
    <h1>Revisar entregas</h1>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Alumno</th>
                    <th>Tarea</th>
                    <th>Grupo</th>
                    <th>Materia</th>
                    <th>Fecha entrega</th>
                    <th>Archivo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($entregas as $entrega)
                    <tr>
                        <td>{{ $entrega->id }}</td>
                        <td>{{ $entrega->user->nombre }}</td>
                        <td>{{ $entrega->tarea->titulo }}</td>
                        <td>{{ $entrega->tarea->grupo->nombre }}</td>
                        <td>{{ $entrega->tarea->grupo->horario->materia->nombre }}</td>
                        <td>{{ $entrega->fecha_entrega }}</td>
                        <td>
                            <a href="{{ route('entregas.descargar', $entrega->id) }}" class="btn btn-secondary">Descargar PDF</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No hay entregas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection