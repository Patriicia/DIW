<?php

    include_once "conexion.php";
    session_start();
    if (!isset($_SESSION['Usuario_email'])) {
        header('Location: form_login.html');
        exit; 
    }

    $nombre = $_POST['Usuario_nombre'];
    $apellido1 = $_POST['Usuario_apellido1'];
    $apellido2 = $_POST['Usuario_apellido2'];
    $domicilio = $_POST['Usuario_domicilio'];
    $poblacion = $_POST['Usuario_poblacion'];
    $provincia = $_POST['Usuario_provincia'];
    $nif = $_POST['Usuario_nif'];
    $telefono = $_POST['Usuario_numero_telefono'];
    

    $_SESSION["Usuario_nombre"] = $nombre;
    $_SESSION['Usuario_apellido1'] = $apellido1 ;
    $_SESSION['Usuario_apellido2'] = $apellido2 ;
    $_SESSION['Usuario_domicilio'] = $domicilio ;
    $_SESSION['Usuario_poblacion'] = $poblacion ;
    $_SESSION['Usuario_provincia'] = $provincia ;
    $_SESSION['Usuario_nif'] = $nif ;
    $_SESSION['Usuario_numero_telefono'] = $telefono ;
    
   
$Usuario_email = $_SESSION['Usuario_email'];
$sql = "UPDATE usuarios 
        SET Usuario_nombre = '$nombre',
        Usuario_apellido1 = '$apellido1',
        Usuario_apellido2 = '$apellido2',
        Usuario_domicilio = '$domicilio',
        Usuario_poblacion = '$poblacion',
        Usuario_provincia = '$provincia',
        Usuario_nif = '$nif',
        Usuario_numero_telefono = '$telefono'
        WHERE Usuario_email LIKE '$Usuario_email'";

if ($conn->query($sql) === TRUE) {
    if ($_SESSION['Usuario_perfil']=="admin") {
        header('Location: perfilAdmin.php');    
    
    } else if ($_SESSION['Usuario_perfil']=="usuario") {
        header('Location: perfilUsuario.php');    
    }

} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>