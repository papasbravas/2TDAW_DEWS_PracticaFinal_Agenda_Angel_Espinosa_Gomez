<?php
// Iniciar sesión para gestionar la información del usuario durante la sesión
session_start();

// Incluir la clase que maneja las operaciones relacionadas con el usuario
require_once("../MODELO/class.usuario.php");

/**
 * Función para manejar el inicio de sesión del usuario.
 */
function inicio()
{
    // Si se ha enviado el formulario de inicio de sesión
    if (isset($_POST["inicio"])) {
        $usu = new usuario(); // Crear una instancia de la clase usuario
        
        // Verificar si el usuario y la contraseña son correctos
        if ($usu->comprobarUsu($_POST["nombre_usuario"], $_POST["contrasenna"])) {

            // Guardar la información del usuario en la sesión
            $_SESSION['usuario'] = $usu->getNombreUsuario(); // Guardar el nombre del usuario
            $_SESSION['tipo'] = $usu->getTipo(); // Guardar el tipo (admin o usuario)
            $_SESSION['id_usuario'] = $usu->getIdUsuario(); // Guardar el ID del usuario

            // Si el usuario seleccionó "recordar", guardar el nombre de usuario en una cookie
            if (isset($_POST['recordar'])) {
                setcookie("nombre_usuario", $_POST["nombre_usuario"], time() + (86400 * 30), "/");
            } else {
                // Si no se seleccionó "recordar", eliminar la cookie (si existe)
                setcookie("nombre_usuario", "", time() - 3600, "/");
            }

            // Si el usuario es un administrador, redirigir a la página de usuarios
            if ($_SESSION['tipo'] === 'admin') {
                header('Location: ../VISTA/usuarios.php');
            } else {
                // Si el usuario es normal, redirigir a la página de amigos
                header('Location: ../VISTA/amigos.php');
            }
            exit();
        } else {
            // Si el usuario o la contraseña son incorrectos, mostrar un mensaje de error
            echo "Usuario o contraseña incorrectos.";
            // Redirigir al formulario de inicio de sesión después de 3 segundos
            header('refresh:3;url=../VISTA/inicio.php');
        }
    }
}

/**
 * Función para manejar la salida del usuario.
 * Cierra la sesión y redirige a la página de inicio.
 */
function salir()
{
    session_start(); // Iniciar la sesión
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión

    // Eliminar la cookie de "nombre_usuario"
    // setcookie("nombre_usuario", "", time() - 3600, "/");

    // Redirigir al usuario a la página de inicio
    header('Location: ../VISTA/inicio.php');
    exit();
}

// Verificar si se ha pasado un parámetro 'action' para ejecutar la acción correspondiente
if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action']; // Obtener el nombre de la acción
    $action(); // Ejecutar la función correspondiente
}
?>
