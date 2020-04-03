@extends('layouts.master-navbar')

@section('title', 'Inicio')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/index-styles.css') }}">
@endsection

@section('content')
    <div class="titulo">
        <button class="btnLogin">
            <a href="{{ URL::route('groupCreate') }}">Crear grupo</a>
        </button>
        <button class="btnLogin">
            <a href="{{ URL::route('subjectCreate') }}">Crear asignatura</a>
        </button>
        <button class="btnLogin">
            <a href="{{ URL::route('turnCreate') }}">Crear turno</a>
        </button>
    </div>
@endsection