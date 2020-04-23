@extends('layouts.master-navbar')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/signup-styles.css') }}">
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
            method="POST" action="{{ route('register') }}">
           @csrf

            @if(isset($user) && is_object($user))
		        <input type="hidden" name="id" value="{{ $user->id }}"/>
	        @endif

            <div id="name" class="left">
                <label for="name">{{__('messages.Name')}}</label>
                <input id="name" class="@error('name') input_error @enderror" type="text" name="name" value="{{ $user->name ?? old('name') }}">
                @error('name')
                    <div class="error_message">
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                @enderror
            </div>

            <div id="lastName" class="right">
                <label for="lastName">{{__('messages.Last Name')}}</label>
                <input id="lastName" class="@error('lastName') input_error @enderror" type="text" name="lastName" value="{{ $user->lastName ?? old('lastName') }}">
                @error('lastName')
                    <div class="error_message">
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                @enderror
            </div>

            <div id="email" >
                <label for="email">{{__('messages.E-Mail Address')}}</label>
                <input id="email" class="@error('email') input_error @enderror" type="text" name="email" value="{{ $user->email ?? old('email')}}">
                @error('email')
                    <div class="error_message" style="width: 81%;">
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                @enderror
            </div>

            <div id="password" class="left">
                <label for="password">{{ __('messages.Password') }}</label>
                <input id="password" class="@error('password') input_error @enderror" type="password" name="password" value="{{ $user->password ?? ''}}">
                @error('password')
                    <div class="error_message">
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                @enderror
            </div>

            <div id="repassword" class="right">
                <label for="password-confirm">{{ __('messages.Confirm Password') }}</label>
                <input id="password-confirm" type="password" name="password_confirmation">
            </div>

            <div id="phone" class="left">
                <label for="phone">{{__('messages.Phone')}}</label>
                <input id="phone" class="@error('phone') input_error @enderror" type="text" name="phone" value="{{ $user->phone ?? old('phone')}}">
                @error('phone')
                    <div class="error_message">
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                @enderror
            </div>

            <div id="alias" class="right">
                <label for="alias">{{__('messages.Alias')}}</label>
                <input id="alias" class="@error('alias') input_error @enderror" type="text" name="alias" value="{{ $user->alias ?? old('alias')}}">
                @error('alias')
                    <div class="error_message">
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                @enderror
            </div>

            <div id="degree" class="left">
                <label for="studies">{{__('messages.Studies')}}</label>
                <select name="studies" value="{{ $user->studies ?? old('studies')}}">
                    <option value="Ingeniería informática">Ingeniería informática</option>
                    <option value="Ingeniería multimedia">Ingeniería multimedia</option>
                    <option value="Derecho">Derecho</option>
                    <option value="Marketing">Marketing</option>
                </select>
                @error('studies')
                    <div class="error_message">
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                @enderror
            </div>

            <div id="course" class="right">
                <label for="course">{{__('messages.Course')}}</label>
                <input id="course" class="@error('course') input_error @enderror" type="text" name="course" value="{{ $user->course ?? old('course')}}">
                @error('course')
                    <div class="error_message" style="width: 70%;">
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                @enderror
            </div>

            <div id="description">
                <label for="description">{{__('messages.Description')}}</label>
                <div class="description_text"> 
                    <textarea id="description" class="@error('description') input_error @enderror" name="description" >{{ $user->description ?? old('description')}}</textarea>
                </div>

                @error('description')
                    <div class="error_message">
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                @enderror
            </div>

            <!--
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
                     De momento es estático, en un futuro consultará los grados disponibles y los listará 
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
        -->
            <button id="btnSignup" type="submit">
                <a>
                    {{ __('Register') }}
                </a>
            </button>

        </form>


@endsection
