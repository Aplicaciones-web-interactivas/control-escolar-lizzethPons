@extends('layouts.app')

@section('content')
    <h1>Mis tareas</h1>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Tarea</th>
                    <th>Grupo</th>
                    <th>Materia</th>
                    <th>Fecha límite</th>
                    <th>Entrega actual</th>
                    <th>Subir PDF</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tareas as $tarea)
                    <tr>
                        <td>{{ $tarea->titulo }}</td>
                        <td>{{ $tarea->grupo->nombre }}</td>
                        <td>{{ $tarea->grupo->horario->materia->nombre }}</td>
                        <td>{{ $tarea->fecha_entrega }}</td>
                        <td>
                            @if($tarea->entregas->count() > 0)
                                Entregado
                            @else
                                Sin entregar
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('entregas.store', $tarea->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="archivo" accept="application/pdf" required>
                                <button type="submit" class="btn">Subir PDF</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No tienes tareas asignadas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection