@extends('layouts.app')

@section('content')
    <h1>Inicio</h1>
    <p>Bienvenido, {{ auth()->user()->nombre }}</p>
@endsection