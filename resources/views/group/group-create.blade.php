@extends('layouts.master-navbar')

@section('title', 'Crear grupo')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/group/group-form.css') }}">
@endsection

@section('content')

    <div>Creación de un grupo</div>
    <div>
        <form action="{{action('GroupController@save')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" accept="image/png, image/jpeg">
            <label>Nombre del grupo</label>
            <input type="text" name="groupName" id="groupName">
            <label>Descripción del grupo</label>
            <input type="text" name="description" id="description">
            <label>Turno</label>
            <select name="turn">
                @foreach($turns as $turn)
                    <option value="{{ $turn->id }}">{{$turn->subjectName}}: {{$turn->day}} {{$turn->beginHour}}-{{$turn->endHour}</option>
                @endforeach
            </select>
            <button type="submit">Crear grupo</button>
        </form>
    </div>

@endsection