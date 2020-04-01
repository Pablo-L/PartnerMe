@extends('layouts.master-navbar')

@section('title', 'Lista de estudiantes')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/student/student-detail.css') }}">
@endsection

@section('content')

    <div class="student-container">
        <div class="photo"></div>
        <div class="alias">{{ $student->alias }}</div>
    
        <div class="nya">
            <div class="name">
                <label>Nombre: </label>
                <span class="data"> {{ $student->name }} </span>
            </div>
            
            <div>
                <label>Apellidos: </label>
                <span class="data"> {{ $student->lastName }} </span>
            </div>
        </div>
    
        <div class="puntuation">
            <label>Valoracion: </label>
            <span class="puntuation_data"> {{$student->puntuation }} </span>
        </div>

        <div class="dContainer">
            <div class="description">
                <label>Descripción: </label>
                <br>
                <span class="data"> {{ $student->description }} </span>  
            </div>

            <div class="phone">
                <label>Teléfono: </label>
                <span class="data"> {{ $student->phone }} </span>  
            </div>

            <div class="email">
                <label>Correo electrónico: </label>
                <span class="data"> {{ $student->email }} </span>  
            </div>

            <div class="degree">
                <label>Grado Universitario: </label>
                <span class="data"> {{ $student->studies }} </span>  
            </div>
        </div>

        <div class="groupTitle">Grupos a los que pertenece</div>
    
    </div>


@endsection