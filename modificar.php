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
  
            $Usuario_perfil = $row['Usuario_perfil'];
            $sql = "UPDATE usuarios SET Usuario_perfil='$perfil' WHERE Usuario_id LIKE '$id' ";
    if ($conn->query($sql) === TRUE) {
        header('Location: perfilAdmin.php');
    } else {          
        echo "Error: " . $sql . "<br>" . $conn->error;
    } 
        }
    } else {
        echo "0 results";
    }
  
     
    
$conn->close(); 
?>