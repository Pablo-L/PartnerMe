@extends('layouts.master-navbar')

@section('title', 'Lista de usuarios')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/user/user-index.css') }}">
@endsection


@section('content')

    <div class="user-search-container">
        <form id="search-form" method="GET" action="{{ route('admin.users.index') }}">
            <input type="text" id="search-text" class="search_field" placeholder="Buscar usuario "  />
            <div class="icon-search">
               <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>


    <table id = "users-table">
        
        <thead>
            <tr>
                <!-- Marco las columnas para su posterior tratamiento con javascript -->
                <th class="sorting" data-sorting_type="asc" data-column_name="alias">
                    Alias
                </th>

                <th class="sorting" data-sorting_type="asc" data-column_name="alias">
                    Roles
                </th>
                
                <th id="username_cells" class="sorting" data-sorting_type="asc" data-column_name="name">
                    Nombre del alumno
                </th>
                
                <th id="description_cells" class="sorting" data-sorting_type="asc" data-column_name="description">
                    Descripción
                </th>

                <!-- No incluir hasta arreglar paginación con AJAX
                    <th class="sorting" data-sorting_type="asc" data-column_name="puntuation">
                        Valoración
                    </th>
                -->
                
                @can('edit-users')
                <th>Modificar</th>
                @endcan
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>
            @include('admin.users.index_data')
        </tbody>

    </table>

    <!-- Necesito estos inputs ocultos para ir cambiando la info según la columna en la que se haga click-->
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" page="1"/>
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="alias" />
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />

    <script>

        //Uso jQuery para simplificar el uso de AJAX
        $(document).ready(function() {

            //$(document).on('click', '#search-form', function(e){
            $(document).on('keyup', '#search-text', function(e){
                e.preventDefault();
                var search = $('#search-text').val();

                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                })
                jQuery.ajax({
                    url: '/admin/search/' + search,
                    method: 'get',
                    success: function(result){
                        $('tbody').html('');
                        $('tbody').html(result);
                    },
                    //si quiero manejar errores...
                    error: function (error) {
                        console.log(error);
                    }
                })
            });


            //Para eliminar un estudiante...
            $(document).on('click', '.delete-link', function(){
                var alias = this.getAttribute('alias');
                var id = this.getAttribute('user_id');
                console.log("entro con id " + id + " y alias " + alias);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })

                jQuery.ajax({
                    url: '/admin/delete/' + id,
                    method: 'get',
                    success: function(result){
                        //Elimino la fila de la tabla, puesto que ya se ha eliminado en la base de datos
                        if(! (result.status === "El usuario " + alias + " no se pudo borrar, permiso denegado")){
                            $('#' + id).remove();
                        }

                        showNotification(result.status);
                    },

                    //si quiero manejar errores...
                    error: function (error) {
                        console.log(error);
                    }
                })
            })

            //Para actualizar la tabla (ordenar y etc)
            function fetchData(page, sort_type, sort_by){
                
                $.ajax({
                    //Realmente podría añadir un parámetro para sustituir users y generalizarlo (?)
                    url:"/admin/fetchData?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type,
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
