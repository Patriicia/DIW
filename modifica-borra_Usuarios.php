<?php
    include_once "conexion.php";
    session_start();

        foreach ($_POST['idModificar'] as $id) {
            $sql = "UPDATE usuarios SET Usuario_bloqueado=0 WHERE Usuario_id=$id";

            if ($conn->query($sql) === TRUE) {
                
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        
        foreach ($_POST['idEliminar'] as $id) {
            $sql = "DELETE FROM usuarios WHERE Usuario_id=$id";

            if ($conn->query($sql) === TRUE) {
                
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        foreach ($_POST['idEditar'] as $id) {
            $sql = "UPDATE usuarios SET Usuario_perfil='admin' WHERE Usuario_id=$id";

            if ($conn->query($sql) === TRUE) {
                
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
        

        header('Location: gestionUsuario.php');

?>