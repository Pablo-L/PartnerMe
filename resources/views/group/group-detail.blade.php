@extends('layouts.master-navbar')

@section('title', $group->groupName)

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/group/group-detail.css') }}">
@endsection

@section('content')

    <!-- <div class="group-container">
        <div class="group-name">{{ $group->groupName }}</div>
        <div>
            <div class="group-image" style="background-image:url('/storage/group_img/{{ $group->image }}')"></div>
            <div class="group-description ">{{ $group->description }}</div>
        </div>
        <div class="group-integrantes">Integrantes</div>
        <div>
            @foreach($students as $student)
                <div class="group-student">
                    <div class="group-student-photo">foto</div>
                    <div class="group-student-info">{{ $student->name }}<br>Valoración: {{ $student->avgRating }}</div>
                </div>
            @endforeach
        </div>
        <div class="group-turn">
            <label>Turno:</label>
            <span>{{$turn->day}} {{$turn->beginHour}}-{{$turn->endHour}}</span>
        </div>
        <div class="group-subject">
            <label>Asignatura:</label>
            <span> {{ $subject->subjectName }} </span>
        </div>
    </div>
    -->

    <div class="group-container">
        <div class="group-name">
            {{ $group->groupName }}
        </div>

        <div class="group-image"></div>
        <div class="group-description">{{ $group->description }}</div>

        <div class="students-title">Integrantes</div>

        <div class="group-integrantes">
            @foreach($students as $student)
                    <div class="group-student">
                        <div class="group-student-photo"></div>
                        <div class="group-student-info">{{ $student->name }}<br>Valoración: {{ $student->avgRating }}</div>
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