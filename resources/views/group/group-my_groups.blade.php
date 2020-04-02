@extends('layouts.master-navbar')

@section('title', 'Tus grupos')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/group/group-my_groups.css') }}">
@endsection

@section('content')

    <div>
        <div>Tus grupos</div>
        <form action="{{action('GroupController@list')}}" method="POST">
            @csrf
        </form>
    </div>

@endsection