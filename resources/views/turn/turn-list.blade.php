@extends('layouts.master-navbar')

@section('title', 'Lista de turnos')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/turn/turn-index.css') }}">
    
@endsection

@section('content')

    @if(session('status'))
        <div id="statusCode">
            {{ session('status') }}
        </div>
        <script>
            document.getElementById("statusCode").style.display = "flex";
        </script>
    @endif


    <div id="statusCode">
        {{ session('status') }}
    </div>


    <table id = "students-table">
        <tr>
            <th>classroomName</th>
            <th>day</th>
            <th>beginHour</th>
            <th>endHour</th>
            <th>subject_id</th>
        </tr>
        @foreach($turns as $turn)
            <tr id="{{$turn->id}}">
                <td>
                    <a class="id-links" href=" {{ action('TurnController@detail', ['id' => $turn->id]) }} ">
                        {{ @$turn->id }}
                    </a>
                </td>
                <td>{{ $turn->classroomName }}</td>
                <td>{{ $turn->day }}</td>
                <td>{{ $turn->beginHour }}</td>
                <td>{{ $turn->endHour }}</td>
                <td>{{ $turn->subject_id }}</td>
                <td>
                    <a href=" {{ action('TurnController@edit', ['id' => $turn->id]) }} "> 
                        <i class="fas fa-edit"></i> 
                    </a> 
                </td>
                <td> 
                    <a class="delete-link" id="{{$turn->id}}"> 
                        <i class="fas fa-trash-alt"> </i> 
                    </a> 
                </td>
            </tr>
        @endforeach

    </table>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        //Uso jQuery para simplificar el uso de AJAX
        $(document).ready(function() {

            $(".delete-link").click(function(e){

                var id = this.getAttribute('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })

                jQuery.ajax({
                    url: '/turns/delete/' + id,
                    method: 'get',

                    success: function(result){
                        //Elimino la fila de la tabla, puesto que ya se ha eliminado en la base de datos
                        $('#' + id).remove();
                        console.log(result.status)
                        $("#statusCode").html(result.status);
                        $("#statusCode").css("display", "flex");
                    }
                    /*si quiero manejar errores...
                    error: function () {
                    }*/
                })
            })
        })
    </script>



@endsection