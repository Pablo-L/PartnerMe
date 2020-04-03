@extends('layouts.master-navbar')

@section('content')

    <form action="{{action('SubjectController@update')}}"method='POST'>
        @csrf
        {{method_field('POST')}}

        @if(isset ($subject) && is_object($subject))
            <input type="hidden" name="id" value="{{$subject->id}}"/>
        @endif

        <div id="name" class="left">
            <label>Nombre de la asignatura:</label>
            <input type="text" name="subjectName" id="subjectName" value="{{$subject->subjectName ?? ''}}">
        </div>

        <div id="department" class="right">
            <label>Departamento:</label>
            <input type="text" name="department"  id="department" value="{{$subject->department ?? ''}}">
        </div>
        
        <button type="submit" style="background:blue">Enviar</button>

    </form>

@endsection