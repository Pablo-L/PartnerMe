@extends('layouts.master-navbar')

@section('title', 'Lista de asignaturas')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/student/student-index.css') }}">
    
@endsection

@section('content')

    @if(session('status'))
        <div id="statusCode">
            {{ session('status') }}
        </div>
        <script>
            document.getElementById("statusCode").style.display = "flex";
        </script>
    @endif


    <div id="statusCode">
        {{ session('status') }}
    </div>


    <table id = "subjects-table">
        <tr>
            <th>Nombre Asignatura</th>
            <th>Departamento</th>
        </tr>
        @foreach($subjects as $subject)
            <tr id="{{$subject->id}}">
                <td>{{ $subject->subjectName}}</td>
                <td>{{ $subject->department }}</td>
            </tr>
        @endforeach

    </table>
@endsection