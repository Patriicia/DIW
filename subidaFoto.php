<?php
    include_once "conexion.php";
    session_start();

    $target_path = "images/";
  $target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

   if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
     
           $Usuario_email = $_SESSION['Usuario_email'];
           $sql = "SELECT Usuario_email FROM usuarios WHERE Usuario_email LIKE '$Usuario_email'";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
              
            $foto = basename( $_FILES['uploadedfile']['name']);
      
            $sql = "UPDATE usuarios 
            SET Usuario_fotografia = '$foto'
            WHERE Usuario_email LIKE '$Usuario_email'";
            if ($conn->query($sql) === TRUE) {
              if ($_SESSION['Usuario_perfil']=="admin") {
                header('Location: perfilAdmin.php');    
            
            } else if ($_SESSION['Usuario_perfil']=="usuario") {
                header('Location: perfilUsuario.php');    
            }
            } else {          
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

          
          } else {
            header('Location: noEstaTrabajando.html'); 
        }
        


  } else{
    echo "0 results";

  }

  
  $conn->close(); 


?>