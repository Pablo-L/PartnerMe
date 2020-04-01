@extends('layouts.master-navbar')

@section('title', 'Lista de estudiantes')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/student/student-detail.css') }}">
@endsection

@section('content')

    <div class="subject-container">
    
        <div class="nya">
            <div class="name">
                <label>Nombre de la asignatura: </label>
                <span class="data"> {{ $subject->subjectName }} </span>
            </div>
            
            <div>
                <label>Departamento al que pertenece: </label>
                <span class="data"> {{ $subject->department }} </span>
            </div>
        </div>
    </div>


@endsection