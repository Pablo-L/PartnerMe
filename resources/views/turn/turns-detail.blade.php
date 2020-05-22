@extends('layouts.master-navbar')

@section('title', 'Detalles del turno')

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
        <div class="day">
            <label>Dia: </label>
            <span class="data"> {{ $turn->day }} </span>
        </div>
        <div class="hoursBox">
            <label>Horas: </label>
            <span class="hours">{{DATE_FORMAT(date_create_from_format('H:i:s', $turn->beginHour), 'H:i')}} - 
            {{DATE_FORMAT(date_create_from_format('H:i:s', $turn->endHour), 'H:i')}}</span>
        </div>

        <div class="subject">
            <label>Asignatura:</label>
            <span class="data"><a href="{{route('subjectDetail', $turn->subjectName)}}">{{ $turn->subjectName }}</a></span>
        </div>
    
    </div>


@endsection