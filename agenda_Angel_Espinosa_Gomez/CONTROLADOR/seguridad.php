<?php
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: ../VISTA/inicio.php");
        exit();
    }
?>