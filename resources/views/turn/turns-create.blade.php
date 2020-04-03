@extends('layouts.master-navbar')

@section('content')
<form action="{{action('TurnController@postForm')}}"method='POST'>
    @csrf
    {{method_field('POST')}}

    <div id="classroomName" class="left">
        <label>Nombre del aula:</label>
        <input type="text" name="classroomName" id="classroomName">
    </div>
    <div id="day" class="left">
        <label>Día:</label>
        <input type="text" name="day" id="day">
    </div>
    <div id="beginHour" class="right">
        <label>Hora de comienzo:</label>
        <input type="text" name="beginHour"  id="beginHour">
    </div>
    <div id="endHour" class="right">
        <label>Hora de final:</label>
        <input type="text" name="endHour"  id="endHour">
    </div>
    <div id="subject_id" class="left">
        <label>Asignatura:</label>
        <input type="text" name="subject_id"  id="subject_id">
    </div>
    <button type="submit" style="background:blue">Enviar</button>

</form>

@endsection