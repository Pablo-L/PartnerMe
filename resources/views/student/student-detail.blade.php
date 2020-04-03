@extends('layouts.master-navbar')

@section('title', $student->alias)

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/student/student-detail.css') }}">
@endsection

@section('content')

    <div class="student-container">
        <div class="photo"></div>
        <div class="alias">{{ $student->alias }}</div>
    
        <div class="nya">
            <div class="name">
                <label>Nombre: </label>
                <span class="data"> {{ $student->name }} </span>
            </div>
            
            <div>
                <label>Apellidos: </label>
                <span class="data"> {{ $student->lastName }} </span>
            </div>
        </div>
    
        <div class="puntuation">
            <label>Valoracion: </label>
            <a href=" {{ action('RatingController@detail', ['id' => $student->id, 'puntuation' => $student->puntuation]) }} " 
                class="puntuation_data"> {{number_format($student->puntuation, 2) }} </a>
        </div>

        <div class="dContainer">
            <div class="description">
                <label>Descripción: </label>
                <br>
                <span class="data"> {{ $student->description }} </span>  
            </div>

            <div class="phone">
                <label>Teléfono: </label>
                <span class="data"> {{ $student->phone }} </span>  
            </div>

            <div class="email">
                <label>Correo electrónico: </label>
                <span class="data"> {{ $student->email }} </span>  
            </div>

            <div class="degree">
                <label>Grado Universitario: </label>
                <span class="data"> {{ $student->studies }} </span>  
            </div>
        </div>

        <div class="groupTitle">Grupos a los que pertenece</div>
    
        <div class="groups">
            @foreach($groups as $group)
                <div class="group_card" onclick="redirectGroup( {{$group->id}} )">
                    

                    <div class="group_photo" style="background-image:url('/storage/group_img/{{ $group->image }}')"></div>

                    
                    <div class="group_data">
                        <div class="group_name"> {{ $group->groupName }} </div>
                        @php
                            $turn = DB::table('turns')->where('id', DB::table('groups')->where('id', $group->id)->first()->turn_id)->first();
                            $subject = DB::table('subjects')->where('id', $turn->subject_id)->first();
                            $beginDate = date_create_from_format('H:i:s', $turn->beginHour);
                            $EndDate = date_create_from_format('H:i:s', $turn->endHour);
                        @endphp
                        
                        <div class="group_turn">
                            {{$turn->classroomName}} 
                            {{$turn->day }} 
                            {{DATE_FORMAT($beginDate, 'H:i')}} - {{DATE_FORMAT($EndDate, 'H:i')}}
                        </div>

                        <div class="group_subject">
                            {{$subject->subjectName}} 
                            <!--{{$subject->department}}-->
                        </div>
                      


                    </div>
                </div>
            @endforeach
        </div>

    </div>


    <script>
        function redirectGroup(id){
            console.log(id);
            window.location.href = "/group/detail/" + id;
        }
    </script>

    


@endsection