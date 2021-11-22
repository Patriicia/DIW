<?php

    include_once "conexion.php";
    session_start();
    if (!isset($_SESSION['Usuario_email'])) {
        header('Location: form_login.html');
        exit; }
    

    $Usuario_email = $_SESSION['Usuario_email'];

  
    $conn->close();

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Perfil Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
    <style>
        .imgRedonda {
    width:300px;
    height:300px;
    border-radius:160px;
    border:10px solid #666;
}
    </style>
	</head>
	<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
		<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container px-5">
                <a class="navbar-brand" href="introducirDatos.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="modificarPerfilAdmin.php">Editar perfil</a></li>
                       
                        <li class="nav-item"><a class="nav-link" href="gestionUsuario.php">Gestión usuario</a></li>
                        <li class="nav-item"><a class="nav-link" href="registraNuevoUsuario.php">Registrar Usuario</a></li>
                        <li class="nav-item"><a class="nav-link" href="exit.php">Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
		<section class="ftco-section">
		<div class="container">
			
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
			<form action="modificar.php" method="post">	
                <select class="form-control" name="perfiles">
                <option value="0">Selecciona un perfil</option>
    <option value="admin">Administrador</option>
    <option value="usuario">Usuario</option>

    </select>
    <a href='modificar.php?Usuario_id=".$Usuario_id."' name='idEditar' >Editar</a>
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