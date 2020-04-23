@extends('layouts.master-navbar')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/signup-styles.css') }}">
@endsection

@section('content')

    <div class="signup-container">

        <div id="title">
            @if(isset($user) && is_object($user))
                <h1> Editar perfil de {{$user->alias}}</h1>
                @section('title', $user->alias)
            @else
                <h1>Registro</h1>
                @section('title', 'Registro')
            @endif
        </div>

        <form class="signup-container" id="signup-form" 
            method="POST" action="{{ isset($user) ? action('UserController@update') : action('UserController@save') }}">

           @csrf

            @if(isset($user) && is_object($user))
		        <input type="hidden" name="id" value="{{ $user->id }}"/>
	        @endif

            <div id="name" class="left">
                <label>Nombre:</label>
                <input type="text" name="name" value="{{ $user->name ?? ''}}">
            </div>

            <div id="lastName" class="right">
                <label>Apellidos:</label>
                <input type="text" name="lastName" value="{{ $user->lastName ?? ''}}">
            </div>

            <div id="email">
                <label>Correo electrónico:</label>
                <input type="text" name="email" value="{{ $user->email ?? ''}}">
            </div>

            <div id="password" class="left">
                <label>Contraseña:</label>
                <input type="password" name="password" value="{{ $user->password ?? ''}}">
            </div>

            <div id="repassword" class="right">
                <label>Repite la contraseña:</label>
                <input type="password" name="respassword" value="{{ $user->password ?? ''}}">
            </div>

            <div id="phone" class="left">
                <label>Teléfono:</label>
                <input type="text" name="phone" value="{{ $user->phone ?? ''}}">
            </div>

            <div id="alias" class="right">
                <label>Alias (nombre de usuario):</label>
                <input type="text" name="alias" value="{{ $user->alias ?? ''}}">
            </div>

            <div id="degree" class="left">
                <label>Grado universitario:</label>
                <select name="degree" value="{{ $user->studies ?? ''}}">
                    <!-- De momento es estático, en un futuro consultará los grados disponibles y los listará -->
                    <option value="Ingeniería informática">Ingeniería informática</option>
                    <option value="Ingeniería multimedia">Ingeniería multimedia</option>
                    <option value="Derecho">Derecho</option>
                    <option value="Marketing">Marketing</option>
                </select>
            </div>

            <div id="course" class="right">
                <label>Curso:</label>
                <input type="text" name="course" value="{{ $user->course ?? ''}}">
            </div>

            <div id="description">
                <label>Descripción</label>
                <textarea name="description" >{{ $user->description ?? ''}}</textarea>
            </div>

            <button id="btnSignup">
                <a>
                    @if(isset($user) && is_object($user))
                        Editar perfil
	                @else
                        Registrarse
                    @endif
                </a>
            </button>

        </form>


@endsection
