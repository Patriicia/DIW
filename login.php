<?php 

include("conexion.php");



$Usuario_email=$_POST['Usuario_email'];
$Usuario_clave=$_POST['Usuario_clave'];
$Usuario_clave=md5($Usuario_clave);

$sql = "SELECT Usuario_id, Usuario_clave, Usuario_email, Usuario_perfil, Usuario_nombre, Usuario_apellido1, Usuario_apellido2, Usuario_nif, Usuario_fotografia, Usuario_numero_intentos, Usuario_bloqueado
FROM usuarios
WHERE Usuario_email LIKE '$Usuario_email' AND Usuario_clave LIKE '$Usuario_clave'";

$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Usuario_id = $row['Usuario_id'];
            $Usuario_clave = $row['Usuario_clave'];
            $usu_email = $row['Usuario_email'];
            $Usuario_perfil = $row['Usuario_perfil'];
            $Usuario_nombre = $row['Usuario_nombre'];
            $Usuario_apellido1 = $row['Usuario_apellido1'];
            $Usuario_apellido2 = $row['Usuario_apellido2'];
            $Usuario_email = $row['Usuario_email'];
            $Usuario_nif = $row['Usuario_nif'];
            $Usuario_fotografia=$row['Usuario_fotografia'];
            $Usuario_numero_intentos=$row['Usuario_numero_intentos'];
            $Usuario_bloqueado=$row['Usuario_bloqueado'];


                session_start();
                $_SESSION["Usuario_id"] = $Usuario_id;
                $_SESSION['Usuario_clave'] = $Usuario_clave ;
                $_SESSION['Usuario_email'] = $Usuario_email ;
                $_SESSION['Usuario_perfil'] = $Usuario_perfil ;
                $_SESSION['Usuario_nombre'] = $Usuario_nombre ;
                $_SESSION['Usuario_apellido1'] = $Usuario_apellido1 ;
                $_SESSION['Usuario_apellido2'] = $Usuario_apellido2 ;
                $_SESSION['Usuario_email'] = $Usuario_email;
                $_SESSION['Usuario_nif'] = $Usuario_nif;
                $_SESSION['Usuario_fotografia'] = $Usuario_fotografia;
                $_SESSION['Usuario_numero_intentos'] = $Usuario_numero_intentos;
                $_SESSION['Usuario_bloqueado'] = $Usuario_bloqueado;
                

                if ($Usuario_perfil=="admin") {
                    header('Location: perfilAdmin.php');    
                  
                } else if ($Usuario_perfil=="usuario") {
                    header('Location: perfilUsuario.php');    
                }
              
        }//while
    }else {
        header('Location: usuarioNoRegistrado.html');
    }//consulta
    $conn->close();
    ?>
    