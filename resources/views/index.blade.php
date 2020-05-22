@extends('layouts.master-navbar')

@section('title', 'Inicio')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/index-styles.css') }}">
@endsection

@section('content')
    <div class="indexContainer">
        <div class="indexText">
            <h1>Crea y colabora en grupos de tu universidad de forma sencilla</h1>
            <p>PartnerMe ofrece un conjunto de herramientas online para que los miembros
                 de la comunidad  universitaria puedan crear grupos de trabajo, colaborar
                y comunicarse de forma sencilla y rápida. <a href="">Saber más...</a></p>
        </div>
        <img src="{{asset('imgs/indeximage.png')}}" alt="Imagen del índice" class="indexImg">
    </div>
@endsection