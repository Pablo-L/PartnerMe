@extends('layouts.master-navbar')

@section('title', 'Registro')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="../css/signup-styles.css">
@endsection

@section('content')


    <div class="signup-container">

        <div id="title">
            <h1>Registro</h1>
        </div>

        <form class="signup-container" id="signup-form" 
            method="POST" action="{{ isset($student) ? action('StudentController@update') : action('StudentController@save') }}">

           @csrf

            <div id="name" class="left">
                <label>Nombre:</label>
                <input type="text" name="name">
            </div>

            <div id="lastName" class="right">
                <label>Apellidos:</label>
                <input type="text" name="lastName">
            </div>

            <div id="email">
                <label>Correo electrónico:</label>
                <input type="text" name="email">
            </div>

            <div id="password" class="left">
                <label>Contraseña:</label>
                <input type="password" name="password">
            </div>

            <div id="repassword" class="right">
                <label>Repite la contraseña:</label>
                <input type="password">
            </div>

            <div id="phone" class="left">
                <label>Teléfono:</label>
                <input type="text" name="phone">
            </div>

            <div id="alias" class="right">
                <label>Alias (nombre de usuario):</label>
                <input type="text" name="alias">
            </div>

            <div id="degree" class="left">
                <label>Grado universitario:</label>
                <select name="degree">
                    <!-- De momento es estático, en un futuro consultará los grados disponibles y los listará -->
                    <option value="Ingeniería informática">Ingeniería informática</option>
                    <option value="Ingeniería multimedia">Ingeniería multimedia</option>
                    <option value="Derecho">Derecho</option>
                    <option value="Marketing">Marketing</option>
                </select>
            </div>

            <div id="course" class="right">
                <label>Curso:</label>
                <input type="text" name="course">
            </div>

            <div id="description">
                <label>Descripción</label>
                <textarea name="description"></textarea>
            </div>

            <button id="btnSignup"><a>Registrarse</a></button>

        </form>


@endsection
