@extends('layouts.master-navbar')

@section('title', 'Inicio')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/home-styles.css') }}">
@endsection

@section('content')
    <div class="home-container">
        
        <div id="welcomeText">Bienvenido {{ Auth::user()->name }}. 
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        ¿No eres tú?
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
        </div>
        <a href="{{ URL::route('myGroups') }}"><div id="myGroupsBtn" class="homeBtn">Tus grupos</div></a>
        <a href="{{ URL::route('groupCreate') }}"><div id="createGroupBtn" class="homeBtn">Crear grupo</div></a>
        <a href="{{ URL::route('otherGroups') }}"><div id="otherGroupsBtn" class="homeBtn">Otros grupos</div></a>

    </div>
@endsection
