<!DOCTYPE html>
<html>
   @section('head')
      <head>
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta charset="UTF-8">

         <title> @yield('title')</title>

         <link href="https://fonts.googleapis.com/css?family=Roboto:400,700|Rubik:400,700&display=swap" rel="stylesheet">
         <link rel="stylesheet" type="text/css" href="{{ asset('../../css/styles.css') }}">
         <link rel="stylesheet" type="text/css" href="../../css/iconos.css">

      </head>
   @show

   <body>

      @section('nav')
         <nav>

            <div class="logoBox">
               <div class="logo"><a href=" {{URL::route('main')}} "><h1>PartnerMe</h1></a></div>
               <div class="icon-menu">
                  <i class="fas fa-bars"></i>
               </div>

            </div>

            <div class="dropdown-content">
                  <a href=" {{URL::route('usersIndex')}} ">Estudiantes</a>
                  <a href=" {{URL::route('subjectsIndex')}} ">Asignaturas</a>
                  <a href=" {{URL::route('groupsIndex')}} ">Grupos</a>
                  <a href=" {{URL::route('turnsIndex')}} ">Turnos</a>
               </div>
            
            <!--Se usaría para no tener que marcar el dropdown como absolute
            <div class="drop-filler"></div>
            -->

            <div class="search-container">
               <input type="text" class="search_field" placeholder="Buscar " name="search" id='name' required />
               <div class="icon-search">
                  <i class="fas fa-search"></i>
               </div>
            </div>

            <div class="custom-select">
               <select>
               <option value="1">Alumno</option>
               <option value="2">Grupo</option>
               <option value="3">Profesor</option>
               <option value="4">Asignatura</option>
               <option value="5">Turno</option>
               </select>
            </div>

            <div class="botonesLogin">

               <button class="btnLogin"><a href="{{URL::route('login')}}">Iniciar sesión</a></button>



            <button class="btnRegister"><a href="{{URL::route('signup')}}">Registrarse</a></button>

            </div>

         </nav>
      @show

      <div class="main-container">
         @yield('content')
      </div>   
      
      <script>
         const btnMenuDrop = document.querySelector('.icon-menu')
         const menuDrop = document.querySelector('.dropdown-content')
         const logo = document.querySelector('.logoBox')
         const icon = document.querySelector('.icon-menu')
         const main = document.querySelector('.main-container')

         btnMenuDrop.addEventListener('click', async () => {

            if(menuDrop.style.display === "flex"){
               menuDrop.style.display = "none"
               logo.className = "logoBox"
               icon.className = "icon-menu"
            }else{
               menuDrop.style.display = "flex"
               logo.className = "logoBoxDrop"
               icon.className = "icon-menuDrop"

               var anchoDecimal = logo.getBoundingClientRect();
               var anchoDecimalText = anchoDecimal.width + 'px';
               menuDrop.style.width = anchoDecimalText;
            }
            
         });

         main.addEventListener('click', async () => {
            if(menuDrop.style.display === "flex"){
               menuDrop.style.display = "none"
               logo.className = "logoBox"
               icon.className = "icon-menu"
            }
         });

      </script>
  
   </body>
</html>
