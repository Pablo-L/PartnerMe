@extends('layouts.master-navbar')

@section('title', 'Rating de ' . $student->alias)

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/rating/student-rating.css') }}">
@endsection

@section('content')

    <div class="photo"></div>

    <div class="header">
    
        <div class="nya">
            <div class="alias">{{ $student->alias }}</div>
            
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
            <span class="puntuation_data"> {{ number_format($student->puntuation, 2) }} </span>
        </div>
    </div>




    <div class="comments_container">
        @foreach($ratings as $rating)
            <div class="comment">
                <div class="comment_profile">
                    <div class="comment_photo"></div>
                    <span class="comment_alias">{{DB::table('students')->where('id', $rating->student_id_creator)->first()->alias}}</span>
                    <span>{{DB::table('students')->where('id', $rating->student_id_creator)->first()->name}},
                    {{DB::table('students')->where('id', $rating->student_id_creator)->first()->lastName}}</span>

                </div>
                
                <div class="comment_text_containter">
                    <span class="comment_text">Valoración: {{$rating->points}}</span>
                    <span class="comment_text"> {{$rating->comment}} </span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="publish_comment">
    <form class="publish_comment" method="POST" action=" {{ action('RatingController@upload') }} ">
        @csrf

        <!-- El creador sería el usuario que tiene abierta la sesión, 
        como esta función todavía no esta implementada escogeremos un usuario aleatorio
        un id entre el primer id y el número de ids que hay-->
        <input type="hidden" name="student_creator_id" 
        value="{{DB::table('students')->where('id', 
            mt_rand(
                DB::table('students')->first()->id,
                DB::table('students')->first()->id + count(DB::table('students')->get())
            ))->first()->id}}" />
        
        <input type="hidden" name="student_receiver_id" value="{{$student->id}}" /> 
        <input type="hidden" name="student_alias" value="{{$student->alias}}" /> 

        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif


        <div>
            <label>Puntuar: </label>
            <input name="points" id="puntuation_input" type="text" />

            <div id="comment_text_input">
                <label>Comentario: </label>
                <textarea name="comment"></textarea>
            </div>

        </div>

        <button id="btn_comment">Publicar comentario</button>

    </form>
    </div>
    <script>

    </script>


@endsection