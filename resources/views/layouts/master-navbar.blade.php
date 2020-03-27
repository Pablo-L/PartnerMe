<!DOCTYPE html>
<html>
   @section('head')
      <head>
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta charset="UTF-8">

         <title> @yield('title')</title>

         <link href="https://fonts.googleapis.com/css?family=Roboto:400,700|Rubik:400,700&display=swap" rel="stylesheet">
         <link rel="stylesheet" type="text/css" href="../../css/styles.css">
         <link rel="stylesheet" type="text/css" href="../../css/iconos.css">

      </head>
   @show

   <body>

      @section('nav')
         <nav>
            <div class="logo"><h1>PartnerMe</h1></div>
            
            <div class="icon-menu">
               <i class="fas fa-bars"></i>
            </div>
            
            <!--Se usaría para no tener que marcar el dropdown como absolute
            <div class="drop-filler"></div>
            -->
            
            <div class="dropdown-content">
               <a href="#">Opción 1</a>
               <a href="#">Opción 2</a>
               <a href="#">Opción 3</a>
            </div>

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
               </select>
            </div>

            <div class="btnLogin">
               <input type="button" name="" value="Iniciar sesión">
            </div>

            <div class="btnRegister">
               <input type="button" name="" value="Registrarse">
            </div>


         </nav>
      @show

      <div class="main-container">
         @yield('content')
      </div>   
      
      <script>
         const btnMenuDrop = document.querySelector('.icon-menu')
         const menuDrop = document.querySelector('.dropdown-content')
         const logo = document.querySelector('.logo')
         const icon = document.querySelector('.icon-menu')
         const main = document.querySelector('.main-container')

         btnMenuDrop.addEventListener('click', async () => {

            if(menuDrop.style.display === "flex"){
               menuDrop.style.display = "none"
               logo.className = "logo"
               icon.className = "icon-menu"
            }else{
               menuDrop.style.display = "flex"
               logo.className = "logoDrop"
               icon.className = "icon-menuDrop"
            }
            
         });

         main.addEventListener('click', async () => {
            if(menuDrop.style.display === "flex"){
               menuDrop.style.display = "none"
               logo.className = "logo"
               icon.className = "icon-menu"
            }
         });

      </script>
  
   </body>
</html>
