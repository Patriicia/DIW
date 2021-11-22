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
  	<title>Perfil Administrador</title>
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
                <a class="navbar-brand" href="#">Inicio</a>
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
    <form action="modifica-borra_Usuarios.php" method="post">
    <table  class='table table-striped' style="background-color: white">
        <tr>
            <th scope='col'>ID Usuario</th>
            <th scope='col'>Email</th>
            
           
            <th scope='col'>Perfil</th>
            <th scope='col'>Bloqueado</th>
           
            <th scope='col'><input class='btn btn-danger' type='submit' name='btnEliminar' value='Eliminar' /></th>
            <th scope='col'><input class='btn btn-danger' type='submit' name='btnDesbloquear' value='Desbloquear' /></th>
            <th scope='col'><input class='btn btn-danger' type='submit' name='btnDesbloquear' value='Cambiar rol' /></th>
            
           <!-- <th scope='col'>Editar</th>-->
          
        </tr>
    
<?php
     $resultadoPorPaginas = 4;

     if (!isset($_GET['pagina'])) {
         $pagina = 1;
     } else {
         $pagina = $_GET['pagina'];
     }
     $sql = "SELECT *
     FROM usuarios
     WHERE Usuario_email NOT LIKE '$Usuario_email'";

      $sqlNull ="SELECT *
      FROM usuarios
      WHERE Usuario_email NOT LIKE '$Usuario_email'";

$result = $conn->query($sql);
$resultsNull = $conn->query($sqlNull);
                    $rownull = $resultsNull->fetch_assoc();
                    $numeroFilas = $resultsNull->num_rows;
                   
                    $paginacion = ceil($numeroFilas / $resultadoPorPaginas);
                    $primeraPagina = ($pagina - 1) * $resultadoPorPaginas;
                    $sqlPaginacion = "SELECT * FROM usuarios  WHERE Usuario_email  NOT LIKE '$Usuario_email' LIMIT ". $primeraPagina . ',' . $resultadoPorPaginas;
                    $resultsPagina = $conn->query($sqlPaginacion);
                    if ($resultsPagina->num_rows > 0) {
                        while ($row = $resultsPagina->fetch_assoc()) {
            $Usuario_id = $row['Usuario_id'];
            $email = $row['Usuario_email'];
            
            $perfil = $row['Usuario_perfil'];
            $bloqueado = $row['Usuario_bloqueado'];
           
          
            if ($bloqueado=="0") {
                $cadena = "No";
            } else if ($bloqueado=="1") {
                $cadena = "Si";
            }

            echo "
            <tr>
                <td>$Usuario_id</td>
                <td>$email</td>
               
               
                <td>$perfil</td>
                <td>$cadena</td>
               
                <td><input type='checkbox' name='idEliminar[]' value='$Usuario_id' /></td>
                <td><input type='checkbox' name='idModificar[]' value='$Usuario_id' /></td>
                <td><input type='checkbox' name='idEditar[]' value='$Usuario_id' /></td>
               
               
            </tr>";
        }
            echo "</table>";
            ?>
             <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item <?php echo $pagina == 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="gestionUsuario.php?pagina=<?php echo $pagina - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>

                                <?php for ($i = 1; $i <= $paginacion; $i++) {
                                ?>
                                    <li class="page-item <?php echo $pagina == $i ? 'active' : '' ?>"><a class="page-link" href="gestionUsuario.php?pagina=<?php echo ($i); ?>"><?php echo ($i); ?></a></li>
                                <?php }  ?>
                                    
                                <li class="page-item <?php echo $pagina >= $paginacion ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?php echo 'gestionUsuario.php?pagina=' . $pagina + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <br>
                        <?php
                    } else {
                        echo "0 results";
                    }
                   // <td>  <a href='modificarPerfil.php?Usuario_id=".$Usuario_id."' name='idEditar' >Editar</a></td>
                    $conn->close();
                        ?>
   
    </table>
    </form>
    <a class="btn btn-danger" href="perfilAdmin.php">Volver menu</a>

</div>
	</section>
	

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>