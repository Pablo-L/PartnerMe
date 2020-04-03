@extends('layouts.master-navbar')

@section('title', 'Crear grupo')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/group/group-form.css') }}">
@endsection

@section('content')

    <div class="group-form-container">
        <div class="group-form-title">Creación de un grupo</div>
        <form id="group-form" class="group-form-container" action="{{action('GroupController@save')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="group-form-name">
                <label>Nombre del grupo:</label>
                <input type="text" name="groupName">
            </div>
            <div class="group-form-upload">
                <label>Imagen del grupo:</label>
                <img id="output" src="" width="100" height="100">
                <input type="file" name="image" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
            </div>
            <div class="group-form-desc">
                <label>Descripción del grupo:</label>
                <textarea name="description"></textarea>
            </div>
            <div class="group-form-turn">
                <label>Turno:</label>
                <select name="turn">
                    @foreach($turns as $turn)
                        <option value="{{ $turn->id }}">{{$turn->subjectName}}: {{$turn->day}} {{$turn->beginHour}}-{{$turn->endHour}}</option>
                    @endforeach
                </select>
            </div>
            <button class="group-form-btn" type="submit">Crear grupo</button>
        </form>
    </div>

@endsection