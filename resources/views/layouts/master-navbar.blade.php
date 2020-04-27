<!DOCTYPE html>
<html>
   @section('head')
      <head>
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta charset="UTF-8">

         <title> @yield('title')</title>

         <link href="https://fonts.googleapis.com/css?family=Roboto:400,700|Rubik:400,700&display=swap" rel="stylesheet">
         <link rel="stylesheet" type="text/css" href="{{ asset('../../css/styles.css') }}">
         <link rel="stylesheet" type="text/css" href="{{ asset('../../css/iconos.css') }}">
         
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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

            @guest
               <script>
                  
                  function expandLogo(media){

                     const logoguest = document.getElementsByClassName('logoBox');

                     if(media.matches){
                        logoguest[0].style.gridColumn = "1 / -1";
                     }else{
                        logoguest[0].style.gridColumn = "col-start / span 4";
                     }
                     
                  }

                  var mediaQuery = window.matchMedia("(max-width: 1400px)")
                  expandLogo(mediaQuery) // Call listener function at run time
                  mediaQuery.addListener(expandLogo) // Attach listener function on state changes 

               </script>
            @endguest

            <div class="dropdown-content">
                  @can('manage-users')
                     <a href=" {{URL::route('admin.users.index')}} ">Usuarios</a>
                  @endcan

                  @can('manage-subjects')
                     <a href=" {{URL::route('subjectsIndex')}} ">Asignaturas</a>
                  @endcan
                  
                  @can('manage-turns')
                     <a href=" {{URL::route('turnsIndex')}} ">Turnos</a>
                  @endcan

                  <a href=" {{URL::route('groupsIndex')}} ">Grupos</a>
                  
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

            @guest
               <div class="botonesLogin">
                  <button class="btnLogin"><a href="{{URL::route('login')}}">Iniciar sesión</a></button>
                  <button class="btnRegister"><a href="{{URL::route('register')}}">Registrarse</a></button>
               </div>
            @else
               <div class="BoxBtnUsuario">
                  <button class="btnUsuario"><a>Bienvenido {{ Auth::user()->alias }}</a></button>

                  <div class="dropdown-user">
                     <a class="dropdown-user-item">{{ __('messages.Edit Profile') }}</a>
                     <a class="dropdown-user-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('messages.Logout') }}
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                     </form>
                  </div>
               </div>



               <!--
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                  </form>
               </div>
               -->
            @endguest

         </nav>
      @show

      @section('notification')
         <script>
            function showNotification(text){
               $(".notify").toggleClass("active");
               $("#notifyType").toggleClass("success");
            
               $("#notifyType").html(text);
               setTimeout(function(){
               $(".notify").removeClass("active");
               $("#notifyType").removeClass("success");
               },2000);
            }
         </script>
         <div class="notify">
            <span id="notifyType" class="">
               @if(session('success'))
                  {{ session('success') }}
                  <script>showNotification()</script>
               @endif

               @if(session('error'))
                  {{session('error')}}
                  <script>
                     $('.notify').css("background-color", "#c00");
                     showNotification()
                  </script>
               @endif
            </span>
         </div>
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

         const btnMenuUser = document.querySelector('.BoxBtnUsuario')
         const btnUser = document.querySelector('.btnUsuario')
         const menuUser = document.querySelector('.dropdown-user')

         if(btnMenuUser){
            btnMenuUser.addEventListener('click', async () =>{
               if(menuUser.style.display === "block"){
                  menuUser.style.display = "none"
               }else{
                  menuUser.style.display = "block"
                  var anchoDecimal = btnUser.getBoundingClientRect();
                  var anchoDecimalText = anchoDecimal.width + 'px';
                  menuUser.style.width = anchoDecimalText;
               }
            });
         }

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
