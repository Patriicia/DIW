<?php
include("conexion.php");


$Usuario_email = $Usuario_clave = $Usuario_clave2 = $Usuario_fecha_nacimiento ="";
$ErrMail= $ErrClave= $ErrFecha="";


if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    if (count($_POST) > 0) {
            
      $Usuario_email = test_input($_POST['Usuario_email']);
      $Usuario_clave = test_input($_POST['Usuario_clave']);
      $Usuario_clave2 = test_input($_POST['Usuario_clave2']);
      $Usuario_fecha_nacimiento = test_input($_POST['Usuario_fecha_nacimiento']);
      
    }
  

if(isset($_POST["Usuario_email"]));{
    $password="";
    $Usuario_token_aleatorio="";
    $timestamp=date('Y-m-d');
    $hora=time();
    $FechaAlta=$timestamp;
    //validaciones
    $campos = array();
    $MailExiste="SELECT * FROM usuarios WHERE Usuario_email='$Usuario_email'";
    $result=mysqli_query($conn, $MailExiste);
    $numRowsNew=$result->num_rows;
  
    if ($Usuario_email == "") {
            array_push($campos, $ErrMail);
           $ErrMail="Email es requerido";
            }else{
              if($numRowsNew >=1){
                array_push($campos,$ErrMail);
             $ErrMail="Ese Email ya está registrado";
            }
            
            }
          
  
    if ($Usuario_clave=="" || $Usuario_clave2=="") {
        array_push($campos, $ErrMail);
        $ErrClave="Contraseña es requerida";
        } else {
          if ($Usuario_clave!=$Usuario_clave2) {
              array_push($campos, "Las contraseñas tienen que ser iguales.");
              $ErrClave="Las contraseñas tienen que ser iguales";
            } else {
  
            if (strlen($Usuario_clave )<8) {
                array_push($campos, "Mínimo 8 carácteres");
                $ErrClave="Minimo 8 carácteres";
              }
              elseif (!preg_match('`[A-Z]`',$Usuario_clave)) {
                array_push($campos, "Introduce al menos una letra mayúscula");
                $ErrClave="Introduce al menos una letra mayúscula";
              }
              elseif (!preg_match('`[a-z]`',$Usuario_clave)) {
                array_push($campos, "Introduce al menos una letra minúscula");
                $ErrClave="Introduce al menos una letra minúscula";
              }
              elseif (!preg_match('`[0-9]`',$Usuario_clave)) {
                array_push($campos, "Introduce al menos un número");
                $ErrClave="Introduce al menos un número";
              }
            $Password=md5($Usuario_clave);
            //$Password=password_hash($Usuario_clave, PASSWORD_DEFAULT);
            $Usuario_token_aleatorio=md5($hora.$Password);
            }
        }
     $data_cumple = new DateTime($Usuario_fecha_nacimiento);
      $data_hoy = new DateTime();
      $edad = $data_cumple->diff($data_hoy);
      $edad = $edad->y;
        if($Usuario_fecha_nacimiento==""){
          array_push($campos, $ErrFecha);
        $ErrFecha="Fecha de nacimiento requerida";
        }else{
          if($edad<18){
            array_push($campos, $ErrFecha);
            $ErrFecha="Eres menor de edad";
          }
       
        }
     
   if (count($campos) > 0) {
              echo "<div class='error'>";
              for ($i=0; $i < count($campos); $i++) { 
               // echo "<li>".$campos[$i]."</li>";
              }
            }
            else{
              /*echo "<div class='correcto'>
                  Datos correctos";*/
   
    $sql = "INSERT INTO $tabla ( Usuario_email, Usuario_clave, Usuario_fecha_nacimiento, Usuario_token_aleatorio, Usuario_fecha_alta )
    VALUES ( '$Usuario_email', '$Password',  '$Usuario_fecha_nacimiento', '$Usuario_token_aleatorio', '$FechaAlta')";
  
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo contacto creado";
        //include("validarCorreo.php");
    } else {
  
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  
    $conn->close();
      }
      echo  "</div>";
    
    }
}
function test_input($data){
  $clear_data = trim($data);
  $clear_data = stripslashes($clear_data);
  $clear_data = htmlspecialchars($clear_data);
  
  return $clear_data;
}
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
  <style>
.error {color: #FF0000;}
.invalid-feedback{ display:block !important}
</style>
	</head>
	<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container px-5">
                <a class="navbar-brand" href="#page-top">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#!">Registro</a></li>
                        <li class="nav-item"><a class="nav-link" href="form_login.html">Inicia Sesión</a></li>
                    </ul>
                </div>
            </div>
        </nav>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Registro</h3>
		      	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="signin-form">
		      		<div class="form-group">
		      		<input class="form-control" type="email" name="Usuario_email" placeholder="Email" value="<?php echo $Usuario_email;?>" required>
              <span class="error invalid-feedback"> <?php echo $ErrMail;?></span>
            </div>
              
	            <div class="form-group">
              <input class="form-control" type="password" name="Usuario_clave" placeholder="Contraseña"  required>
              <span class="error invalid-feedback"> <?php echo $ErrClave;?></span> 
            </div>
                
                <div class="form-group">
                <input class="form-control" type="password" name="Usuario_clave2" placeholder="Repite contraseña" required>
                <span class="error invalid-feedback"> <?php echo $ErrClave;?></span>    
              </div>
               
                <div class="form-group">
                <input class="form-control" type="date" name="Usuario_fecha_nacimiento"  value="<?php echo $Usuario_fecha_nacimiento;?>" required >
                <span class="error invalid-feedback"> <?php echo $ErrFecha;?></span>    
              </div>
                          
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Registrar</button>
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