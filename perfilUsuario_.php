<?php

    include_once "conexion.php";
    session_start();
    if (!isset($_SESSION['Usuario_email'])) {
        header('Location: form_login.html');
        exit; }
    

    $Usuario_email = $_SESSION['Usuario_email'];

    $sql = "SELECT Usuario_nombre, Usuario_apellido1, Usuario_apellido2, Usuario_domicilio, Usuario_poblacion, Usuario_provincia, Usuario_nif, Usuario_numero_telefono, Usuario_perfil, Usuario_fotografia 
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
            $Usuario_perfil = $row['Usuario_perfil'];
            $Usuario_fotografia=$row['Usuario_fotografia'];
        }
    } else {
        echo "0 results";
    }
    $conn->close();

?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<div class="profile-block">
  <div class="panel text-center">
    <div class="user-heading"> <a href="subidaFoto.php"><img src="images/<?=$Usuario_fotografia?>" alt="" title=""></a>
    
      <h1><?=$_SESSION['Usuario_nombre']?> </h1>
      <p><?=$_SESSION['Usuario_email']?></p>
      <p><?=$_SESSION['Usuario_perfil']?></p>
    </div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="#"><i class="fa fa-user"></i>Perfil</a></li>
      <li class="active"><a href="modificarPerfilUser.php"><i class="fa fa-pencil-square-o"></i>Editar perfil</a></li>
     
      <li><a href="exit.php"><i class="fa fa-sign-out"></i>Salir</a></li>
    </ul>
  </div>
</div>