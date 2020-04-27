@extends('layouts.master-navbar')

@section('title', 'Lista de grupos')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/group/group-index.css') }}">
    
@endsection

@section('content')

    <table id="list-table">
        <thead>
            <tr>
                <th>
                    Imagen del grupo
                </th>
                <th>
                    Id. del grupo
                </th>
                <th>
                    Nombre del grupo
                </th>
                <th>
                    Descripción del grupo
                </th>
                <th>
                    Modificar
                </th>
                <th>
                    Eliminar
                </th>
            </tr>
        </thead>
        <tbody>
            @include('group.groups-list-data')
        </tbody>
    </table>

    <script>
        $('.page-item').click(function(){
            link = $(this).find("a").attr("href");
            if(link)
                window.location.href = link;
        });
    </script>

@endsection