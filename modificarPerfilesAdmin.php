<?php

    include_once "conexion.php";
    session_start();
    if (!isset($_SESSION['Usuario_email'])) {
      header('Location: form_login.html');
      exit; }
  

  $Usuario_email = $_SESSION['Usuario_email'];

    $id=$_GET['Usuario_id'];

    $sql = "SELECT Usuario_id, Usuario_nombre, Usuario_apellido1, Usuario_apellido2, Usuario_domicilio, Usuario_poblacion, Usuario_provincia, Usuario_nif, Usuario_numero_telefono, Usuario_perfil, Usuario_fotografia 
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
		
        <div class="container bootstrap snippet">
   
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
          <img src="images/<?=$Usuario_fotografia?>" class='imgRedonda'>
        

      <div class="text-center">
      
      <form enctype="multipart/form-data" action="subidaFoto.php" method="POST">
      
            <input name="uploadedfile" type="file" />
            <input type="submit" value="Subir archivo" />
        </form>
      </div></hr><br>

          
        </div><!--/col-3-->
    	<div class="col-sm-9">
            

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                  <form class="form" action="modificarRoot.php" method="post" id="registrationForm">
                 
                      
                      <div class="form-group">
                          <div class="row">
                          <div class="col">
                              <label for="first_name"><h5>Id</h5></label>
                              <input type="text" class="form-control" name="Usuario_id"  value='<?php echo $Usuario_id ?>' readonly>
                          </div>
                          <div class="col">
                              <label for="first_name"><h5>Nombre</h5></label>
                              <input type="text" class="form-control" name="Usuario_nombre"  value='<?php echo $Usuario_nombre ?>'>
                          </div>
                          <div class="col">
                            <label for="last_name"><h5>Primer apellido</h5></label>
                            <input type="text" class="form-control" name="Usuario_apellido1"  value='<?php echo $Usuario_apellido1 ?>'>
                          </div>
                          <div class="col">
                              <label for="phone"><h5>Segundo apellido</h5></label>
                              <input type="text" class="form-control" name="Usuario_apellido2"  value='<?php echo $Usuario_apellido2 ?>'>
                          </div>
</div>
                      </div>
          
                      <div class="form-group">
                          <div class="row">
                          <div class="col-xs-6">
                             <label for="mobile"><h5>Domicilio</h5></label>
                             <input type="text" class="form-control" name="Usuario_domicilio" value='<?php echo $Usuario_domicilio ?>'>
                          </div>
                          <div class="col">
                            <label for="last_name"><h5>Población</h5></label>
                            <input type="text" class="form-control" name="Usuario_poblacion" value='<?php echo $Usuario_poblacion ?>'>
                          </div>
                          <div class="col">
                              <label for="phone"><h5>Provincia</h5></label>
                              <input type="text" class="form-control" name="Usuario_provincia" value='<?php echo $Usuario_provincia ?>'>
                          </div>
</div>
                      <div class="form-group">
                      <div class="row">
                          <div class="col">
                              <label for="email"><h5>NIF</h5></label>
                              <input type="text" class="form-control" name="Usuario_nif" value='<?php echo $Usuario_nif ?>'>
                          </div>
                          <div class="col">
                              <label for="email"><h5>Móvil</h5></label>
                              <input type="text" class="form-control" name="Usuario_numero_telefono" value='<?php echo $Usuario_numero_telefono ?>'>
                          </div>
                      </div>
                      
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<input  class="btn btn-lg btn-success" type="submit" value="Guardar">
                                  <input  class="btn btn-lg btn-success" type="reset" value="Borrar">
                               
                            </div>
                      </div>
              	</form>
              
              <hr>
              
             </div><!--/tab-pane-->
            
               
             
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
    
	</section>
	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>