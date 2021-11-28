<?php

    include_once "conexion.php";
    session_start();
    if (!isset($_SESSION['Usuario_email'])) {
      header('Location: form_login.html');
      exit; }
  

  $Usuario_email = $_SESSION['Usuario_email'];

    $id=$_GET['Usuario_id'];

    $sql = "SELECT Usuario_id, Usuario_nombre, Usuario_apellido1, Usuario_apellido2, Usuario_domicilio, Usuario_poblacion, Usuario_provincia, Usuario_nif, Usuario_numero_telefono, Usuario_perfil, Usuario_fotografia, Usuario_fecha_nacimiento 
            FROM usuarios
            WHERE Usuario_id LIKE '$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Usuario_id = $row['Usuario_id'];
            $Usuario_nombre = $row['Usuario_nombre'];
            $Usuario_apellido1 = $row['Usuario_apellido1'];
            $Usuario_apellido2 = $row['Usuario_apellido2'];                
            $Usuario_domicilio = $row['Usuario_domicilio'];
            $Usuario_poblacion = $row['Usuario_poblacion'];
            $Usuario_provincia = $row['Usuario_provincia'];                
            $Usuario_nif = $row['Usuario_nif'];
            $Usuario_numero_telefono = $row['Usuario_numero_telefono'];
            $Usuario_perfil = $row['Usuario_perfil'];
            $Usuario_fotografia=$row['Usuario_fotografia'];
            $Usuario_fecha_nacimiento = $row['Usuario_fecha_nacimiento'];
        }
    } else {
        echo "0 results";
    }
    $conn->close();

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Log In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
   <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <style>
.error {color: #FF0000;}
.invalid-feedback{ display:block !important}
.imgRedonda {
    width:150px;
    height:150px;
    border-radius:75px;
    
}
</style>
	</head>
	<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container px-5">
                <a class="navbar-brand" href="#page-top">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="perfilAdmin.php">Mi perfil</a></li>
                        <li class="nav-item"><a class="nav-link" href="exit.php">Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="ftco-section">
	
            

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                
                <div class="w3-content w3-black">
          <div class="w3-card-4 rounded"style="width: 30%; margin:auto; background-color:white; color:black; ">
            
            <div class="p-4 ">
            <div> <b>ID:</b> <?=$Usuario_id?></div>
            <div><img src="images/<?=$Usuario_fotografia?>" style="float:right;" class="imgRedonda"></div>
            <div> <b>Nombre</b> <?=$Usuario_nombre?></div>
            <div> <b>Apellidos</b> <?=$Usuario_apellido1?><?=$Usuario_apellido2?></div>
            <div> <b>Nif:</b> <?=$Usuario_nif?></div>
            <div> <b>Provincia:</b> <?=$Usuario_provincia?></div>
            <div> <b>Población:</b> <?=$Usuario_poblacion?></div>
            <div> <b>Fecha de nacimiento:</b> <?=$Usuario_fecha_nacimiento?></div>
            <div> <b>Número de teléfono:</b> <?=$Usuario_numero_telefono?></div> 
            </div>
            
           
         
        </div>
      </div>
              
        
              
             </div><!--/tab-pane-->
            
               
             
          </div><!--/tab-content-->

       
    </div><!--/row-->
    
	</section>
	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>