@extends('layouts.master-navbar')

@section('title','lista de asignaturas')

@section('head')
    @parent 
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/turn/turn-index.css') }}">

@endsection

@section('content')

    @if(session('status'))
        <div id="statusCode">
            {{session('status')}}
        </div>
        <script>
            document.getElementById("statusCode").style.display = "flex";
        </script>
    @endif

    <div id="statusCode">
        {{ session('status')}}
    </div>

    <table id="turns-table">
        <thead>
            <tr>
                <th>
                    Aula
                </th>
                <th>
                    Día
                </th>
                <th>
                    Hora de comienzo
                </th>
                <th>
                    Hora de final
                </th>
                <th>
                    Asignatura
                </th>
                <th>
                    Modificar
                </th>
                <th>
                    Eliminar
                </th>
            </tr>
        </thead>
        <tbody>
            @include('turn.turns-list-data')
        </tbody>
    </table>
@endsection
