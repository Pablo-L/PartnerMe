@extends('layouts.master-navbar')

@section('title', 'Lista de estudiantes')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="../../css/student/student-detail.css">
@endsection

@section('content')
    <h1>{{$student->name}}</h1>
    <p>
        {{$student->description}}
    </p>
@endsection