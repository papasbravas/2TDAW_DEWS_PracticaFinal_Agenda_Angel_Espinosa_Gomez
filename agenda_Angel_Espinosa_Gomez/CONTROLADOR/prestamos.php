<?php
// Iniciar sesión para gestionar la información del usuario durante la sesión
session_start();

// Incluir las clases necesarias para manejar préstamos, amigos y juegos
require_once("../MODELO/class.prestamos.php");
require_once("../MODELO/class.amigos.php");
require_once("../MODELO/class.juegos.php");

// Verificar que el usuario está logueado, si no, mostrar un error y detener la ejecución
if (!isset($_SESSION['id_usuario'])) {
    die("Error: No hay usuario en sesión.");
}

/**
 * Función para añadir un préstamo de juego a un amigo.
 */
function aniadir()
{
    // Iniciar sesión si no se ha hecho previamente (esto es redundante si ya se llama session_start() al inicio del archivo)
    if (session_status() == PHP_SESSION_NONE) session_start();

    $id_usuario = $_SESSION['id_usuario']; // Obtener el ID del usuario desde la sesión

    // Crear una instancia de la clase 'amigos' y buscar los amigos del usuario
    $amigosModel = new amigos();
    $amigos = $amigosModel->buscarAmigos($id_usuario, "");

    // Crear una instancia de la clase 'juegos' y obtener los juegos del usuario
    $juegosModel = new juegos();
    $juegos = $juegosModel->buscarJuego($id_usuario); // Obtener los juegos que tiene el usuario logueado

    // Incluir la vista para añadir préstamos
    require_once("../VISTA/aniadirPrestamos.php");

    // Verificar si los datos del préstamo fueron enviados, si no, mostrar un error
    if (!isset($_POST['id_amigo'], $_POST['id_juego'], $_POST['fecha_prestamo'])) {
        die("Faltan datos para insertar el préstamo.");
    }

    // Obtener los datos del préstamo desde el formulario
    $id_amigo = $_POST['id_amigo'];
    $id_juego = $_POST['id_juego'];
    $fecha_prestamo = $_POST['fecha_prestamo'];

    // Crear una instancia de la clase 'prestamos' e insertar el nuevo préstamo
    $prestamo = new prestamos();
    $prestamo->insertarPrestamo($id_amigo, $id_juego, $fecha_prestamo);

    // Redirigir a la página de préstamos (esto está comentado pero es necesario)
    // header("Location: ../VISTA/prestamos.php");
    exit();
}

/**
 * Función para marcar un préstamo como devuelto.
 */
function prestamo()
{
    // Si se recibe un ID de préstamo en la URL, proceder a devolver el préstamo
    if (isset($_GET['id_prestamo'])) {
        $id_prestamo = $_GET['id_prestamo']; // Obtener el ID del préstamo desde la URL
        $prestamoModel = new prestamos();
        $prestamoModel->devolverPrestamo($id_prestamo); // Llamar al método que actualiza el estado del préstamo
    }

    // Redirigir a la página que lista los préstamos después de la actualización
    header("Location: ../VISTA/buscarPrestamos.php");
    exit();
}

/**
 * Función para buscar préstamos, ya sea por nombre o mostrando todos.
 */
function buscarPrestamo()
{
    // Verificar que el usuario está logueado antes de proceder
    if (!isset($_SESSION['id_usuario'])) {
        die("Error: No hay usuario en sesión.");
    }

    $id_usuario = $_SESSION['id_usuario']; // Obtener el ID del usuario desde la sesión
    $input = $_POST['nombres'] ?? ''; // Obtener el nombre de búsqueda (si lo hay)

    // Crear una instancia de la clase 'prestamos' e intentar buscar los préstamos
    $prestamo = new prestamos();
    $prestamos = $prestamo->buscarPrestamo($input); // Buscar préstamos según el nombre proporcionado

    // Incluir la vista para mostrar los préstamos
    require_once("../VISTA/buscarPrestamos.php");
}

// Verificar si se pasa una acción a través de la URL o la solicitud y ejecutar la función correspondiente
if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action']; // Obtener la acción desde la solicitud
    $action(); // Ejecutar la función correspondiente a la acción
}
?>
