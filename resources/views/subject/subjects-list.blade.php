@extends('layouts.master-navbar')

@section('title','Lista de asignaturas')

@section('head')
    @parent 
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/subject/subject-index.css') }}">

@endsection

@section('content')

    @if(session('status'))
        <div id="statusCode">
            {{session('status')}}
        </div>
        <script>
            document.getElementById("statusCode").style.display = "flex";
        </script>
    @endif

    <div id="statusCode">
        {{ session('status')}}
    </div>

    <button class="btnCreate">
        <a href="{{ URL::route('subjectCreate') }}"> Crear una asignatura</a>
    </button> 

    <table id="subjects-table">
        <thead>
            <tr>
                <th>
                    Nombre de la asignatura
                </th>
                <th>
                    Departamento
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
            @include('subject.subject-list-data')
        </tbody>
    </table>

    <script>

//Uso jQuery para simplificar el uso de AJAX
$(document).ready(function() {

    $(document).on('click', '.sorting', function(){

        var column_name = $(this).data('column_name');
        var order_type = $(this).data('sorting_type');
        var reverse_order = '';

        //Si se ha clickado si era ascendente pasa a descendente y viceversa
        if(order_type == 'asc'){
            $(this).data('sorting_type', 'desc');
            reverse_order = 'desc';
        }

        if(order_type == 'desc'){
            $(this).data('sorting_type', 'asc');
            reverse_order = 'asc';               
        }

        $('#hidden_column_name').val(column_name);
        $('#hidden_sort_type').val(reverse_order);

        var page = $('#hidden_page').val();

        fetchData(page, reverse_order, column_name);
    });

    //Cuando clicko en un enlace de la paginación...
    //$(document).on('click', '.pagination a', function(event){
    function changePage(link_direction, page_item){
        event.preventDefault();
        var page = link_direction.split('page=')[1];
        $('#hidden_page').val(page);
        
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#hidden_sort_type').val();

        $('li').removeClass('active');
        link_parent.addClass('active');
        //page_item.removeClass('active');
        //$(this).parent().addClass('active');

        //console.log('tengo pagina ' + page + ' tipo de sorting ' + sort_type + ' y columna ' + column_name)
        fetchData(page, sort_type, column_name);
    };

    //Pequeño script para que los divs contenedores de links 
    //tambien dirigan donde el link (más cómodo para la paginación)
    $('.page-item').click(function(){
        link = $(this).find("a").attr("href");
        if(link)
            window.location.href = link;
    });

    $('.btnCreate').click(function(){
            link = $(this).find("a").attr("href");
            if(link)
                window.location.href = link;
        });

})

</script>


@endsection
