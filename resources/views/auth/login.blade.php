@extends('layouts.master-navbar')

@section('head')
    @parent
    @section('title', __('messages.Login'))
	<link rel="stylesheet" type="text/css" href="{{ asset('../../css/login-styles.css') }}">
@endsection


@section('content')

    <div class="divs-container">
		<div class="titulo">
			<h1 id = "btnInicio"><a href="{{URL::route('main')}}">PartnerMe</a></h1>
        </div>
        
		<div class="login-box">

			<div>
				<h1> {{__('messages.Login')}}</h1>
			</div>

			<form action="{{ route('login') }}" method="post">
                @csrf

 				<label for="email"> {{ __('messages.E-Mail Address') }} </label>
				<input type="email" id="email" name="email" class="@error('email') input_error @enderror" value="{{ old('email') ?? '' }}" > 
                @error('email')
                    <div class="error_message">
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                @enderror

 				<label for="password"> {{ __('messages.Password') }} </label>
                <input type="password" id="password" name="password"  class="@error('email') input_error @enderror">
                @error('password')
                    <div class="error_message">
                        <span>
                            {{ $message }}
                        </span>
                    </div>
                @enderror 

                <div class="remember-box">
                    <input type="checkbox" name="remember" id="remember" value=" {{ old('remember') ? 'checked' : '' }} ">
                    <label for="remember">{{ __('messages.Remember Me') }}</label>
                </div>

                <button class="button">{{ __('messages.Login') }}</button>

                <hr class="line">
                <div class="form-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('messages.Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
			</form>
		</div>
	</div>

<!-- 
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
@endsection
