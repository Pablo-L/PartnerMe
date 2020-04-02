@extends('layouts.master-navbar')

@section('title', 'Editar grupo')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/group/group-form.css') }}">
@endsection

@section('content')

    <div>Editando grupo #{{$group->id}}</div>
    <div>
        <form action="{{action('GroupController@update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id" value="{{$group->id}}">
            <input type="file" name="image" accept="image/png, image/jpeg">
            <label>Nombre del grupo</label>
            <input type="text" name="groupName" id="groupName" value="{{$group->groupName}}">
            <label>Descripción del grupo</label>
            <input type="text" name="description" id="description" value="{{$group->description}}">
            <label>Turno</label>
            <select name="turn">
                @foreach($turns as $turn)
                    <option value="{{ $turn->id }}" 
                        @if($turn->id==$group->turn_id) 
                        selected 
                        @endif
                        >{{$turn->subjectName}}: {{$turn->day}} {{$turn->beginHour}}-{{$turn->endHour}</option>
                @endforeach
            </select>
            <button type="submit">Editar grupo</button>
        </form>
    </div>

@endsection