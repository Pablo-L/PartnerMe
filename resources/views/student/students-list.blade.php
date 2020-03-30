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
        
        <thead>
            <tr>
                <!-- Marco las columnas para su posterior tratamiento con javascript -->
                <th class="sorting" data-sorting_type="asc" data-column_name="alias">
                    Alias
                </th>
                
                <th class="sorting" data-sorting_type="asc" data-column_name="name">
                    Nombre del alumno
                </th>
                
                <th class="sorting" data-sorting_type="asc" data-column_name="description">
                    Descripción
                </th>
                
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>
            @include('student.students-list-data')
        </tbody>

    </table>

    <!-- Necesito estos inputs ocultos para ir cambiando la info según la columna en la que se haga click-->
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" page="1"/>
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="alias" />
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>

        //Uso jQuery para simplificar el uso de AJAX
        $(document).ready(function() {

            //Para eliminar un estudiante...
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

            //Para actualizar la tabla (ordenar y etc)
            function fetchData(page, sort_type, sort_by){
                
                $.ajax({
                    //Realmente podría añadir un parámetro para sustituir students y generalizarlo (?)
                    url:"/students/fetch_data?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type,
                    success:function(data){
                        $('tbody').html('');
                        $('tbody').html(data);
                    },
                    error: function(data){
                        console.log(data);
                    }
                })
            }

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

            //Hacer que la paginación también funcione con AJAX (?)
            /*$('.pagination li').click(function(){
                if($(this).find("a").attr("href")){
                    
                    //Evito que refresque
                    event.preventDefault();

                    if($(this).find("a").attr("aria-label")){
                        console.log("es una flecha");
                    }

                    var hidden_page = $("#hidden_page:first")[0];
                    var previous_page = hidden_page.getAttribute('page');

                    var page = $(this).find("a").attr("href").split('page=')[1];
                    $('#hidden_page').attr('page', page);

                    console.log('antes ' + previous_page + ' despues ' + page);

                    var column_name = $('#hidden_column_name').val();
                    var sort_type = $('#hidden_sort_type').val();   
                    
                    //$(this > 'li').removeClass('active');
                    //$(this).addClass('active');
                    
                    fetchData(page, sort_type, column_name);
                }else{
                    
                }
            });*/


        })

    </script>



@endsection
