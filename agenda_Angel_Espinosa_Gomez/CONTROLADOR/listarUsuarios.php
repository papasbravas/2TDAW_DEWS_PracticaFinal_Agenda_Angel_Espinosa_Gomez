<?php
// Incluir los archivos necesarios para manejar amigos y usuarios
require_once("../MODELO/class.amigos.php");
require_once("../MODELO/class.usuario.php");

// Iniciar sesión para acceder a los datos del usuario
session_start();

/**
 * Función para listar todos los contactos disponibles.
 */
function listarContactos() {
    // Crear una instancia de la clase 'amigos' para acceder a los datos
    $datos = new amigos();

    // Obtener todos los contactos almacenados en la base de datos
    $contactos = $datos->obtenerTodosLosContactos();

    // Mostrar los datos obtenidos en la pantalla para depuración (debe eliminarse en producción)
    var_dump($contactos);

    // Incluir la vista que mostrará los contactos en la interfaz de usuario
    require_once("../VISTA/contactos.php");
}
?>
