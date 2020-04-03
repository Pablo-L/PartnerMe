@extends('layouts.master-navbar')

@section('title', 'Lista de turnos')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/turn/turn-detail.css') }}">
@endsection

@section('content')

    <div class="turn-container">
        
        <div class="classroomName">
            <label>Aula: </label>
            <span class="data"> {{ $turn->classroomName }} </span>
        </div>
        <div class="time">
            <div class="day">
                <label>dia: </label>
                <span class="data"> {{ $turn->day }} </span>
            </div>
            <div class="beginHour">
                <label>Hora de comienzo: </label>
                <span class="data"> {{ $turn->beginHour }} </span>
            </div>
            <div class="endHour">
                <label>Hora de fin: </label>
                <span class="data"> {{ $turn->endHour }} </span>
            </div>
            <div class="subject_id">
                <label>Asignatura</label>
                <span class="data">{{ $turn->subjectName }}</span>
            </div>
        </div>
    
    </div>


@endsection