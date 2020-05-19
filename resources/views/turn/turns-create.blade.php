@extends('layouts.master-navbar')

@section('title', 'Crear turno')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/turn/turn-form.css') }}">
@endsection

@section('content')

<div class="turn-form-container">

    <form id="turn-form" class="turn-form-container" action="{{action('TurnController@postForm')}}"method='POST'>
        @csrf
        {{method_field('POST')}}

        <div class="turn-form-title">
            Creación de turno
        </div>

        <div id="classroomName" class="turn-form-nom">
            <label>Nombre del aula:</label>
            <input type="text" name="classroomName" id="classroomName" value="{{old('classroomName')}}">
            @error('classroomName')
                <div class="error_message" style="width: 81%;">
                    <span>
                        {{$message}}
                    </span>
                </div>
            @enderror
        </div>
        <div id="day" class="turn-form-day">
            <label>Día</label>
            <select name="day">
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miercoles">Miercoles</option>
                <option value="Jueves" selected>Jueves</option>
                <option value="Viernes" selected>Viernes</option>
            </select>
        </div>
        <div id="beginHour" class="turn-form-beginh">
            <label>Hora de comienzo:</label>
            <input type="time" name="beginHour" value="08:00" max="22:30" min="08:00" step="1">
        </div>
        <div id="endHour" class="turn-form-endh">
            <label>Hora de final:</label>
            <input type="time" name="endHour" value="08:00" max="22:30" min="08:00" step="1">
        </div>
        <div class="turn-form-subject">
            <label>Asignatura</label>
            <select name="subject_id"  id="subject_id" class="form-control">
            @foreach ($subjects as $subject)
                <option value="{{$subject->id}}">
                        {{$subject['subjectName']}}
                </option>
            @endforeach
            </select>
        </div>
        <button type="submit" class="turn-form-btn">Enviar</button>

    </form>
</div>
@endsection