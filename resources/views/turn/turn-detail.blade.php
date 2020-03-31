@extends('layouts.master-navbar')

@section('title', 'Lista de turnos')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/turn/turn-detail.css') }}">
@endsection

@section('content')

    <div class="turn-container">
        <div class="subject_id">{{ $turn->subject_id }}</div>
    
        <div class="classroomName">
            <label>Aula: </label>
            <span class="data"> {{ $turn->classroomName }} </span>
        </div>
        <div class="time">
            <div class="beginHour">
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
        </div>
    
    </div>


@endsection