@extends('layouts.master-navbar')

@section('title', 'Detalles de asignatura')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/subject/subject-detail.css') }}">
@endsection

@section('content')

    <div class="subject-container">
    
        <div class="nya">
            <div class="data">
                <label>Nombre de la asignatura: </label>
                <span> {{ $subject->subjectName }} </span>
            </div>
            
            <div class="data">
                <label>Departamento al que pertenece: </label>
                <span> {{ $subject->department }} </span>
            </div>
        </div>

        <div class="turns">
            <span class="turnsTitle"> Turnos en los que se imparte... </span>
            @foreach($turns as $turn)
            <div class="element" id="{{$turn->id}}">
                <div class="classroom">{{$turn->classroomName}}</div>
                
                {{$turn->day}}
                {{DATE_FORMAT(date_create_from_format('H:i:s', $turn->beginHour), 'H:i')}} - 
                {{DATE_FORMAT(date_create_from_format('H:i:s', $turn->endHour), 'H:i')}}
            </div>
            @endforeach
        </div>


    </div>

    <script>
        const turns = document.getElementsByClassName('element')

        for(turn of turns){
            turn.addEventListener('click', item => {
                window.location.href = window.location.origin + '/turn/detail/' + item.currentTarget.id
            })
        }
    </script>


@endsection