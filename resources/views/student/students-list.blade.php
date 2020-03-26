@extends('layouts.master-navbar')

@section('title', 'Lista de estudiantes')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="../../css/student/student-index.css">
@endsection

@section('content')
    <ul>
        @foreach($students as $student)
            <li>
                {{ $student->name }}
            </li>
        @endforeach

    </ul>
@endsection