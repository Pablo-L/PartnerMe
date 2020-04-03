@extends('layouts.master-navbar')

@section('title','lista de asignaturas')

@section('head')
    @parent 
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/subject/subject-index.css') }}">

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

    <table id="subjects-table">
        <thead>
            <tr>
                <th>
                    Nombre de la asignatura
                </th>
                <th>
                    Departamento
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
            @include('subject.subject-list-data')
        </tbody>
    </table>
@endsection
