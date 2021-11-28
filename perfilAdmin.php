<?php

    include_once "conexion.php";
    session_start();
    if (!isset($_SESSION['Usuario_email'])) {
        header('Location: form_login.html');
        exit; }
    

    $Usuario_email = $_SESSION['Usuario_email'];

    $sql = "SELECT Usuario_nombre, Usuario_apellido1, Usuario_apellido2, Usuario_domicilio, Usuario_poblacion, Usuario_provincia, Usuario_nif, Usuario_numero_telefono, Usuario_fotografia 
            FROM usuarios
            WHERE Usuario_email LIKE '$Usuario_email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Usuario_nombre = $row['Usuario_nombre'];
            $Usuario_apellido1 = $row['Usuario_apellido1'];
            $Usuario_apellido2 = $row['Usuario_apellido2'];
            $Usuario_domicilio = $row['Usuario_domicilio'];
            $Usuario_poblacion = $row['Usuario_poblacion'];
            $Usuario_provincia = $row['Usuario_provincia'];
            $Usuario_nif = $row['Usuario_nif'];
            $Usuario_numero_telefono = $row['Usuario_numero_telefono'];
            $Usuario_fotografia=$row['Usuario_fotografia'];
        }
    } else {
        echo "0 results";
    }
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
                <a class="navbar-brand" href="perfilAdmin.php">Inicio</a>
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
					<div class="login-wrap p-0">
                    <img src="images/<?=$Usuario_fotografia?>" class='imgRedonda'>
                    <h3>Administrador</h3>
		      	<!--<h3 class="mb-4 text-center"> Hola <?=$_SESSION['Usuario_nombre']?></h3>-->
		      
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