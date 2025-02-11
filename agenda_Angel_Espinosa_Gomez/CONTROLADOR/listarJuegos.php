<?php
// Iniciar sesión para manejar la sesión del usuario
session_start();

// Incluir la clase que maneja las operaciones con juegos
require_once("../MODELO/class.juegos.php");

// Si se envía el formulario de búsqueda de juegos
if (isset($_POST["envJ"])) {
    sacarJuego(); // Llama a la función para buscar juegos
    exit();
}

// Si se envía el formulario para insertar un nuevo juego
if (isset($_SESSION['id_usuario']) && isset($_POST['insJuego'])) {
    $id_usuario = $_SESSION['id_usuario']; // Obtener ID del usuario desde la sesión

    // Obtener datos del formulario
    $titulo = $_POST['titulo'];
    $plataforma = $_POST['plataforma'];
    $anno_lanzamiento = $_POST['anno_lanzamiento'];

    // Manejo de la imagen del juego (si se subió)
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $directorio_destino = "../imagenes/juegos/"; // Directorio donde se guardarán las imágenes
        $nombre_archivo = basename($_FILES["foto"]["name"]); // Obtener el nombre del archivo
        $ruta_foto = $directorio_destino . $nombre_archivo; // Ruta final del archivo
        
        // Mover el archivo al directorio destino
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_foto)) {
            $foto = $ruta_foto;
        } else {
            $foto = null;
        }
    } else {
        $foto = null; // Si no hay imagen, se guarda como null
    }

    // Insertar el nuevo juego en la base de datos
    insertoJuego($id_usuario, $titulo, $plataforma, $anno_lanzamiento, $foto);
    exit();
}

/**
 * Función para buscar juegos en la base de datos
 */
function sacarJuego() {
    // Obtener el título del juego desde el formulario (si se envió)
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : "_";

    $juego = new juegos(); // Crear una instancia de la clase juegos

    // Buscar juegos que coincidan con el título
    $juegos = $juego->buscarJuego($titulo);

    // Guardar los resultados en la sesión para mostrarlos en la vista
    $_SESSION['juegos'] = $juegos;

    // Redirigir a la vista que muestra la lista de juegos
    header("Location: ../VISTA/juegos.php");
    exit();
}

/**
 * Función para insertar un nuevo juego en la base de datos
 */
function insertoJuego($id_usuario, $titulo, $plataforma, $anno_lanzamiento, $foto) {
    $juego = new juegos(); // Crear una instancia de la clase juegos

    // Insertar el juego en la base de datos
    $juego->insertJuego($id_usuario, $foto, $titulo, $plataforma, $anno_lanzamiento);

    // Después de insertar, recargar la lista de juegos
    mostrarJuegos();
    exit();
}

/**
 * Función para editar un juego existente
 */
function editarJuego() {
    $juego = new juegos(); // Crear una instancia de la clase juegos

    // Si la solicitud es de tipo POST (se envió el formulario)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos enviados desde el formulario
        $id_juego = $_GET['id_juego'];
        $titulo = $_POST['titulo'];
        $plataforma = $_POST['plataforma'];
        $anno_lanzamiento = $_POST['anno_lanzamiento'];

        // Manejo de la imagen en caso de que se haya subido una nueva
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK && !empty($_FILES['foto']['name'])) {
            $directorio_destino = "../imagenes/juegos/"; // Directorio donde se guardarán las imágenes
            $nombre_archivo = basename($_FILES["foto"]["name"]); // Obtener el nombre del archivo
            $ruta_foto = $directorio_destino . $nombre_archivo; // Ruta final del archivo
            
            // Mover el archivo al directorio destino
            move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_foto);
        } else {
            $ruta_foto = $_POST['foto_actual']; // Si no se subió una nueva imagen, mantener la actual
        }

        // Actualizar la información del juego en la base de datos
        $juego->actualizarJuego($id_juego, $titulo, $plataforma, $anno_lanzamiento, $ruta_foto);

        // Recargar la lista de juegos después de la actualización
        mostrarJuegos();
        exit();
    } else {
        // Si la solicitud es GET, mostrar el formulario de edición con los datos actuales
        if (isset($_GET['id_juego'])) {
            $id_juego = $_GET['id_juego'];

            // Obtener los datos actuales del juego
            $datos_juego = $juego->obtenerJuegoPorId($id_juego);

            // Incluir la vista de modificación con los datos cargados
            include("../VISTA/modificarJuegos.php");
            exit();
        } else {
            echo "No se especificó el juego a editar.";
            exit();
        }
    }
}

/**
 * Función para mostrar la lista completa de juegos
 */
function mostrarJuegos() {
    $juego = new juegos(); // Crear una instancia de la clase juegos

    // Llamar a la función para obtener todos los juegos (pasando "_" como filtro)
    $juegos = $juego->buscarJuego("_");

    // Guardar los resultados en la sesión para mostrarlos en la vista
    $_SESSION['juegos'] = $juegos;

    // Redirigir a la vista que muestra la lista de juegos
    header("Location: ../VISTA/juegos.php");
    exit();
}

/**
 * Verificar si se ha pasado un parámetro 'action' en la URL o formulario
 * para ejecutar una de las funciones definidas.
 */
if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action']; // Obtener el nombre de la función a ejecutar
    $action(); // Llamar a la función correspondiente
}
?>
