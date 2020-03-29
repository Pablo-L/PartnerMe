<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Iniciar sesión</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto|Rubik:400,700|Ubuntu&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('../css/login-styles.css') }}">
</head>

<body onload=start()>
	<div class="divs-container">
		<div class="titulo">
			<h1 id = "btnInicio"><a href="{{URL::route('main')}}">PartnerMe</a></h1>
        </div>
        
		<div class="login-box">

			<div>
				<h1>Iniciar sesión</h1>
			</div>

			<form action="" method="post">
                {{ csrf_field() }}

 				<label for="email"> Correo electrónico </label>
				<input type="text" id="email" name="email"> 
 				
 				<label for="password"> Contraseña </label>
 				<input type="password" id="password" name="password"> 
	
 				<button class="button">Iniciar sesión</button>

 				<hr class="line">
				
				<div class="form-links">
 					<a>Reestablecer contraseña </a>
					<span>-</span>
	 				<a id="link-registrarse">Registrarse </a>
				</div>
			</form>
		</div>
	</div>

</body>
</html>

		