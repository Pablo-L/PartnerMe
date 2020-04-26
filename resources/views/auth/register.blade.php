@extends('layouts.master-navbar')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/signup-styles.css') }}">
@endsection

@section('content')

    <div class="signup-container">

            @php
                if(isset($user) && is_object($user)){
                    $existsUser = true;
                }else{
                    $existsUser = false;
                }
            @endphp

        <div id="title">
            @if($existsUser)
                <h1> Editar perfil de {{$user->alias}}</h1>
                @section('title', $user->alias)
            @else
                <h1>Registro</h1>
                @section('title', 'Registro')
            @endif
        </div>

        <form class="signup-container" id="signup-form" 
            method="POST" 
            @if($existsUser)
                action="{{ route('admin.users.update', $user) }}">
	        @else
                action="{{ route('register') }}">
            @endif
            
            @csrf

            @if($existsUser)
                {{ method_field('PUT') }}
	        @endif            

            @if($existsUser)
		        <input type="hidden" name="id" value="{{ $user->id }}"/>
            @endif

            @if($existsUser)
                <!-- Solo el admin debe ver esta parte -->
                <div class="rol-box">
                    @foreach($roles as $role)
                        <div class="roles">
                            <input id="{{$role}}" type="checkbox" name="roles[]" value="{{$role->id}}" 
                            @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                            <label for="{{$role}}">{{ $role->rolName }}</label>
                        </div>
                    @endforeach
                </div>
            @endif

            <div id="name-box" class="left">
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

            <div id="lastName-box" class="right">
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

            <div id="email-box" >
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

            <div id="password-box" class="left">
                <label for="password">{{ __('messages.Password') }}</label>
                <input id="password" class="@error('password') input_error @enderror" type="password" name="password">
                @error('password')
                    <div class="error_message">
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                @enderror
            </div>

            <div id="repassword-box" class="right">
                <label for="password-confirm">{{ __('messages.Confirm Password') }}</label>
                <input id="password-confirm" type="password" name="password_confirmation">
            </div>

            <div id="phone-box" class="left">
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

            <div id="alias-box" class="right">
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

            <div id="degree-box" class="left">
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

            <div id="course-box" class="right">
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

            <div id="description-box">
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



            <button id="btnSignup" type="submit">
                @if($existsUser)
                    <a>{{ __('messages.Edit Profile') }}</a>
                @else
                    <a>{{ __('messages.Register') }}</a>
                @endif
            </button>

            

        </form>


@endsection
