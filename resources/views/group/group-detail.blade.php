@extends('layouts.master-navbar')

@section('title', $group->groupName)

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/group/group-detail.css') }}">
@endsection

@section('content')

    <div class="group-container">
        <div class="group-name">
            {{ $group->groupName }}
        </div>

        <div class="group-image" style="background-image:url('/storage/group_img/{{ $group->image }}')"></div>
        <div class="group-description">{{ $group->description }}</div>

        <div class="users-title">Integrantes</div>

        <div class="group-integrantes">
            @foreach($users as $user)
                <div class="group-user">
                    <div class="group-user-photo"></div>
                    <div class="group-user-info">{{$user->alias}} <br> {{ $user->name }}<br>Valoración: {{ $user->avgRating }}</div>
                </div>
            @endforeach

        </div>


        <div class="turno_asig">
            <div class="group-turn">
                <label>Turno:</label>
                <span>{{$turn->day}} {{$turn->beginHour}}-{{$turn->endHour}}</span>
            </div>
            <div class="group-subject">
                <label>Asignatura:</label>
                <span> {{ $subject->subjectName }} </span>
            </div>
        </div>


    </div>

@endsection