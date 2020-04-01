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
                <span class="comment_text"> {{$rating->comment}} </span>
                
            </div>
        @endforeach
    </div>

    <div class="publish_comment">
    <form class="publish_comment">
        @csrf
        <div>
            <label>Puntuar: </label>
            <input id="puntuation_input" type="text" />

            <div id="comment_text_input">
                <label>Comentario: </label>
                <textarea></textarea>
            </div>

        </div>

    </form>
    </div>
    <script>

    </script>


@endsection