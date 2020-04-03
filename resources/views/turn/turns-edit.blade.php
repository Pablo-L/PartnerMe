@extends('layouts.master-navbar')

@section('content')

    <form action="{{action('TurnController@update')}}"method='POST'>
        @csrf
        {{method_field('POST')}}

        @if(isset ($turn) && is_object($turn))
            <input type="hidden" name="id" value="{{$turn->id}}"/>
        @endif

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
    <div class="form-group">
        <label>Asignatura</label>
        <select name="subject_id"  id="subject_id" class="form-control">
        @foreach ($subjects as $subject)
            <option value="{{$subject->id}}">
                    {{$subject['subjectName']}}
            </option>
        @endforeach
        </select>
    </div>
        
        <button type="submit" style="background:blue">Enviar</button>

    </form>

@endsection