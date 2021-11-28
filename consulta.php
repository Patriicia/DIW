<?php

    include_once "conexion.php";
    session_start();
    if (!isset($_SESSION['Usuario_email'])) {
        $_SESSION['Usuario_email'] = "";
        $_SESSION['Usuario_id'] = "";
        $_SESSION['Usuario_perfil'] = "";
        header('Location: form_login.html');
        exit; }
    

    $Usuario_email = $_SESSION['Usuario_email'];


?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Log In</title>
    <meta charset="utf-8">
    <meta  name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
		<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container px-5">
                <a class="navbar-brand" href="index.html">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="modificarPerfilAdmin.php">Editar perfil</a></li>
                       
                       <li class="nav-item"><a class="nav-link" href="gestionUsuario.php">Gestión usuario</a></li>
                       <li class="nav-item"><a class="nav-link" href="registraNuevoUsuario.php">Registrar Usuario</a></li>
                       <li class="nav-item"><a class="nav-link" href="consulta.php">Consulta</a></li>
                       <li class="nav-item"><a class="nav-link" href="exit.php">Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				
			</div>
			<div class="row justify-content-center ">
				<div class="col-md-6 col-lg-4 bg-white rounded">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center pt-4" style="color:black">Buscar usuarios por:</h3>
		      	<form action="gestionUsuarioConsulta.php" class="signin-form " method="post">
		      		<div class="form-group  text-center">
                        
					  <input class="rounded-pill " type="text" name="Usuario_email" placeholder="Email"  >
		      		</div>
	            <div class="form-group text-center">
                <input class="rounded-pill" type="text" name="Usuario_provincia" placeholder="Provincia"  >
	            </div>
                <div class="form-group  text-center">
                <input class="rounded-pill" type="text" name="Usuario_nif" placeholder="Nif"  >
	            </div>
	            <div class="form-group pt-3  pb-4">
	            	<input type="submit" name="submit" class="form-control btn btn-primary submit px-3" value=" Buscar">
	            </div>
	           
	          </form>
	          
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>
