@extends('layouts.master-navbar')

@section('title', 'Lista de estudiantes')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/student/student-index.css') }}">
    
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
            <th>Alias</th>
            <th>Nombre del alumno</th>
            <th>Descripción</th>
            <th>Modificar</th>
            <th>Eliminar</th>
        </tr>
        @foreach($students as $student)
            <tr id="{{$student->id}}">
                <td>
                    <a class="alias-links" href=" {{ action('StudentController@detail', ['alias' => $student->alias]) }} ">
                        {{ @$student->alias }}
                    </a>
                </td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->description }}</td>
                <td>
                    <a href=" {{ action('StudentController@edit', ['alias' => $student->alias]) }} "> 
                        <i class="fas fa-edit"></i> 
                    </a> 
                </td>
                <td> 
                    <a class="delete-link" alias="{{$student->alias}}" id="{{$student->id}}"> 
                        <i class="fas fa-trash-alt"> </i> 
                    </a> 
                </td>
            </tr>
        @endforeach

    </table>

    <div id="pagnav">
        {{$students->links()}}
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        //Uso jQuery para simplificar el uso de AJAX
        $(document).ready(function() {

            $(".delete-link").click(function(e){

                var alias = this.getAttribute('alias');
                var id = this.getAttribute('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })

                jQuery.ajax({
                    url: '/students/delete/' + alias,
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
