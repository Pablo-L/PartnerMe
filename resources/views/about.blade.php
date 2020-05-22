@extends('layouts.master-navbar')

@section('title', 'Acerca de PartnerMe')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/about-styles.css') }}">
@endsection

@section('content')
    <div class="aboutContainer">
        <div class="aboutText" id="text1">
            <h1>¡Todos tus compañeros de carrera están en PartnerMe!</h1>
            <p>Encuentralos facilmente con nuestro buscador desde cualquier
                parte de la web. También puedes buscar grupos, profesores,
                 asignaturas y turnos.</p>
        </div>
        <img src="{{asset('imgs/buscar.png')}}" alt="Busqueda de usuarios" class="aboutImg" id="img1">
        <div class="aboutText" id="text2">
            <h1>Perfiles con puntuaciones por usuarios</h1>
            <p>Podrás explorar los detalles de los perfiles de tus compañeros 
                de carrera, acceder a su información de contacto, ver a qué grupos
                pertenecen y ver el promedio de valoraciones que han recibido.</p>
        </div>
        <img src="{{asset('imgs/detalles-usuario.png')}}" alt="Detalles de usuario" class="aboutImg" id="img2">
        <div class="aboutText" id="text3">
            <h1>Pon comentarios sobre los compañeros con los que has trabajado</h1>
            <p>El sistema de valoraciones te permitirá punturar a tus compañeros del 1 al 10
                 y dejar un comentario sobre como ha sido tu experiencia trabajando con ellos.
                  Podrás visualizar los comentarios que han recibido otros usuarios para decidir
                   si quieres hacer grupo con ellos.
            </p>
        </div>
        <img src="{{asset('imgs/comentarios-usuario.png')}}" alt="Comentarios de usuario" class="aboutImg" id="img3">
        <div class="aboutText" id="text4">
            <h1>Crea grupos con compañeros de forma sencilla</h1>
            <p>PartnerMe ofrece un conjunto de herramientas online para que los miembros
                 de la comunidad  universitaria puedan crear grupos de trabajo.</p>
        </div>
        <img src="{{asset('imgs/crear-grupo.png')}}" alt="Creación de grupos" class="aboutImg" id="img4">
        <div class="aboutText" id="text5">
            <h1>Colabora y comparte en grupos de tu universidad</h1>
            <p>Con PartnerMe colaborar y comunicarse es muy rápido y sencillo. En las páginas
                de los grupos podrás ver todos los detalles y consultar sus integrantes y sus valoraciones.
            </p>
        </div>
        <img src="{{asset('imgs/detalles-grupo.png')}}" alt="Detalles de los grupos" class="aboutImg" id="img5">
    </div>
@endsection