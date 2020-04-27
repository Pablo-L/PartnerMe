@extends('layouts.master-navbar')

@section('title', 'Rating de ' . $user->alias)

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/rating/user-rating.css') }}">
@endsection

@section('content')

    <div class="photo"></div>

    <div class="header">
    
        <div class="nya">
            <div class="alias">{{ $user->alias }}</div>
            
            <div class="name">
                <label>Nombre: </label>
                <span class="data"> {{ $user->name }} </span>
            </div>
            
            <div>
                <label>Apellidos: </label>
                <span class="data"> {{ $user->lastName }} </span>
            </div>
        </div>

        <div class="puntuation">
            <label>Valoracion: </label>
            <span class="puntuation_data"> {{ number_format($user->puntuation, 2) }} </span>
        </div>
    </div>

    @php $ratingsIds = []; @endphp
    <div class="comments_container">
        @foreach($ratings as $rating)
            <div class="comment">
                
                <div class="comment_profile" onclick="redirectStudent({{ $rating->user_id_creator }})">
                    <div class="comment_photo"></div>
                    <span class="comment_alias">{{DB::table('users')->where('id', $rating->user_id_creator)->first()->alias}}</span>
                    
                    <span>
                        @php array_push($ratingsIds,$rating->user_id_creator) @endphp
                        {{DB::table('users')->where('id', $rating->user_id_creator)->first()->name}},
                        {{DB::table('users')->where('id', $rating->user_id_creator)->first()->lastName}}
                    </span>

                </div>
                
                <div class="comment_text_containter">
                    <span class="comment_text">Valoración: {{$rating->points}}</span>
                    <span class="comment_text"> {{$rating->comment}} </span>
                    @if(Auth::user()->id == $rating->user_id_creator)
                        <div class="comment_delete">
                            <a href="{{ route('admin.delete-comment', 
                                [
                                    'creatorId' => Auth::user()->id,
                                    'receiverId' => $user->id, 
                                    'ratingId' => $rating->id
                                ]) 
                            }}"><i class="far fa-minus-square"></i></a>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Lo muestro si el perfil no es mio y si no he comentado antes (un usuario no puede comentar varias veces) -->
    @if(Auth::user()->id != $user->id && !(in_array(Auth::user()->id, $ratingsIds)))
        <div class="publish_comment">
            <form class="publish_comment" method="POST" action= "{{ route('admin.upload-comment', Auth::user()->alias) }}">
            @csrf

            <!-- El creador sería el usuario que tiene abierta la sesión, 
            como esta función todavía no esta implementada escogeremos un usuario aleatorio
            un id entre el primer id y el número de ids que hay
                value="{{DB::table('users')->where('id', 
                mt_rand(
                    DB::table('users')->first()->id,
                    DB::table('users')->first()->id + count(DB::table('users')->get())
                ))->first()->id}}" />
            -->
            <input type="hidden" name="user_creator_id" value="{{ Auth::user()->id }}">

                
            <input type="hidden" name="user_receiver_id" value="{{$user->id}}" /> 
            <input type="hidden" name="user_alias" value="{{$user->alias}}" /> 

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
    @endif
    <script>
        function redirectStudent(id){
            console.log(id);
            window.location.href = "/admin/users/" + id;
        }
    </script>


@endsection