@extends('layouts.master-navbar')

@section('content')
<form action="{{action('SubjectController@postForm')}}"method='POST'>
    @csrf
    {{method_field('POST')}}

    <div id="name" class="left">
        <label>Nombre de la asignatura:</label>
        <input type="text" name="subjectName" id="subjectName">
    </div>

    <div id="department" class="right">
        <label>Departamento:</label>
        <input type="text" name="department"  id="department">
    </div>

    <button type="submit" style="background:blue">Enviar</button>

</form>

@endsection