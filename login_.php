<?php 

include("conexion.php");



$Usuario_email=$_POST['Usuario_email'];
$Usuario_clave=$_POST['Usuario_clave'];
$Usuario_clave=md5($Usuario_clave);

$sql = "SELECT * FROM usuarios WHERE Usuario_email LIKE '$Usuario_email'";
$results = $conn->query($sql);

  $row = $results->fetch_assoc();
if($results->num_rows > 0){
    $Usuario_bloqueado=$row['Usuario_bloqueado'];
    $intentos=$row['Usuario_numero_intentos'];

    if($Usuario_bloqueado==0){
        $sql = "SELECT * FROM usuarios
                WHERE Usuario_email = '$Usuario_email' AND Usuario_clave = '$Usuario_clave'";

$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Usuario_id = $row['Usuario_id'];
            $Usuario_clave = $row['Usuario_clave'];
            $Usuario_email = $row['Usuario_email'];
            $Usuario_perfil = $row['Usuario_perfil'];
            $Usuario_nombre = $row['Usuario_nombre'];
            $Usuario_apellido1 = $row['Usuario_apellido1'];
            $Usuario_apellido2 = $row['Usuario_apellido2'];
            $Usuario_email = $row['Usuario_email'];
            $Usuario_nif = $row['Usuario_nif'];
            $Usuario_fotografia=$row['Usuario_fotografia'];
           


                session_start();
                $_SESSION["Usuario_id"] = $Usuario_id;
                $_SESSION['Usuario_clave'] = $Usuario_clave ;
                $_SESSION['Usuario_email'] = $Usuario_email ;
                $_SESSION['Usuario_perfil'] = $Usuario_perfil ;
                $_SESSION['Usuario_nombre'] = $Usuario_nombre ;
                $_SESSION['Usuario_apellido1'] = $Usuario_apellido1 ;
                $_SESSION['Usuario_apellido2'] = $Usuario_apellido2 ;
                $_SESSION['Usuario_nif'] = $Usuario_nif;
                $_SESSION['Usuario_fotografia'] = $Usuario_fotografia;
                $_SESSION['Usuario_numero_intentos'] = $intentos;
                $_SESSION['Usuario_bloqueado'] = $Usuario_bloqueado;
                

                if ($Usuario_perfil=="admin") {
                    $fechaActual = date('Y-m-d');
            $sql = "UPDATE usuarios SET Usuario_fecha_ultima_conexion = '$fechaActual' WHERE Usuario_email LIKE '$Usuario_email'";
                    if(mysqli_query($conn, $sql)){
                        header('Location: perfilAdmin.php');  
                    }
                     
                  
                } else if ($Usuario_perfil=="usuario") {
                    $fechaActual = date('Y-m-d');
                    $sql = "UPDATE usuarios SET Usuario_fecha_ultima_conexion = '$fechaActual' WHERE Usuario_email LIKE '$Usuario_email'";
                    if(mysqli_query($conn, $sql)){
                        header('Location: perfilUsuario.php');    
                    }
                    
                }
              
        }//while
    }else {
        echo "contraseña erronea";
        $intentos++;
        $sql = "UPDATE usuarios SET Usuario_numero_intentos='$intentos' WHERE Usuario_email LIKE '$Usuario_email'";
        if (!mysqli_query($conn, $sql)) {
            echo "no ha añadido el intento";
          
          }
          $sql = "SELECT * FROM usuarios WHERE Usuario_email = '$Usuario_email'";
          $results = $conn->query($sql);
          $row = $results->fetch_assoc(); 

          if ($row['Usuario_numero_intentos'] == 3) {
            $fechaActual = date('Y-m-d');
            $sql = "UPDATE usuarios SET Usuario_bloqueado='1', Usuario_fecha_bloqueo='$fechaActual' WHERE Usuario_email LIKE '$Usuario_email'";
            if (mysqli_query($conn, $sql)) {
              echo "Usuario bloqueado";
              //ventana modal por bloqueo de usuario tras tres intentos
              $_SESSION['Usuario_bloqueado']="visibility:visible";
             
             
              header('Location: form_login.html');
              exit();
 
            } else {
              echo "No hace el update a usuario bloqueado";
            } 

          }
          header('Location: form_login.html');
          exit();
    
    }//consulta
    } else{
        echo "usuario bloqueado";
        header('Location: bloqueado.html');
        exit();
    }
}else{
    echo "usuario no registrado";
    //header('Location: usuarioNoRegistrado.html');
}
$conn->close();
?>