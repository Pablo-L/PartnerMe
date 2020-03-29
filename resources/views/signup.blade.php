@extends('layouts.master-navbar')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/signup-styles.css') }}">
@endsection

@section('content')

    <div class="signup-container">

        <div id="title">
            @if(isset($student) && is_object($student))
                <h1> Editar perfil de {{$student->alias}}</h1>
                @section('title', $student->alias)
            @else
                <h1>Registro</h1>
                @section('title', 'Registro')
            @endif
        </div>

        <form class="signup-container" id="signup-form" 
            method="POST" action="{{ isset($student) ? action('StudentController@update') : action('StudentController@save') }}">

           @csrf

            @if(isset($student) && is_object($student))
		        <input type="hidden" name="id" value="{{ $student->id }}"/>
	        @endif

            <div id="name" class="left">
                <label>Nombre:</label>
                <input type="text" name="name" value="{{ $student->name ?? ''}}">
            </div>

            <div id="lastName" class="right">
                <label>Apellidos:</label>
                <input type="text" name="lastName" value="{{ $student->lastName ?? ''}}">
            </div>

            <div id="email">
                <label>Correo electrónico:</label>
                <input type="text" name="email" value="{{ $student->email ?? ''}}">
            </div>

            <div id="password" class="left">
                <label>Contraseña:</label>
                <input type="password" name="password" value="{{ $student->password ?? ''}}">
            </div>

            <div id="repassword" class="right">
                <label>Repite la contraseña:</label>
                <input type="password" name="respassword" value="{{ $student->password ?? ''}}">
            </div>

            <div id="phone" class="left">
                <label>Teléfono:</label>
                <input type="text" name="phone" value="{{ $student->phone ?? ''}}">
            </div>

            <div id="alias" class="right">
                <label>Alias (nombre de usuario):</label>
                <input type="text" name="alias" value="{{ $student->alias ?? ''}}">
            </div>

            <div id="degree" class="left">
                <label>Grado universitario:</label>
                <select name="degree" value="{{ $student->studies ?? ''}}">
                    <!-- De momento es estático, en un futuro consultará los grados disponibles y los listará -->
                    <option value="Ingeniería informática">Ingeniería informática</option>
                    <option value="Ingeniería multimedia">Ingeniería multimedia</option>
                    <option value="Derecho">Derecho</option>
                    <option value="Marketing">Marketing</option>
                </select>
            </div>

            <div id="course" class="right">
                <label>Curso:</label>
                <input type="text" name="course" value="{{ $student->course ?? ''}}">
            </div>

            <div id="description">
                <label>Descripción</label>
                <textarea name="description" >{{ $student->description ?? ''}}</textarea>
            </div>

            <button id="btnSignup">
                <a>
                    @if(isset($student) && is_object($student))
                        Editar perfil
	                @else
                        Registrarse
                    @endif
                </a>
            </button>

        </form>


@endsection
