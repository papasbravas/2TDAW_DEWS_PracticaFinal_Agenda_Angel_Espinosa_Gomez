<?php
    // Incluir la clase que maneja las operaciones con amigos
    require_once("../MODELO/class.amigos.php");

    // Iniciar sesión para acceder a las variables de sesión
    session_start();

    // Verificar si el usuario ha iniciado sesión, si no, redirigirlo a la página de inicio
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: ../VISTA/inicio.php");
        exit();
    }

    /**
     * Función para buscar amigos en la base de datos
     */
    function buscarAmigo() {
        require_once("../MODELO/class.amigos.php"); // Incluir la clase de amigos
        $amigo = new amigos(); // Crear instancia de la clase amigos
        
        // Obtener el nombre del amigo desde el formulario (si se ha enviado)
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';

        // Llamar al método para buscar amigos del usuario actual
        $amigos = $amigo->buscarAmigos($_SESSION['id_usuario'], $nombre);

        // Incluir la vista que mostrará los resultados de la búsqueda
        require_once "../VISTA/buscarAmigos.php";
    }

    /**
     * Función para añadir un nuevo amigo
     */
    function aniadirAmigo() {
        require_once("../MODELO/class.amigos.php"); // Incluir la clase de amigos

        // Verificar que la sesión esté activa y que el formulario haya sido enviado
        if (isset($_SESSION['id_usuario']) && isset($_POST['envA'])) {
            $id_usuario = $_SESSION['id_usuario']; // Obtener el ID del usuario desde la sesión

            // Obtener los datos del amigo desde el formulario
            $nombre_amigo = isset($_POST['nombre_amigo']) ? $_POST['nombre_amigo'] : '';
            $apellido_amigo = isset($_POST['apellido_amigo']) ? $_POST['apellido_amigo'] : '';
            $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : '';

            $amigo = new amigos(); // Crear una instancia de la clase amigos

            // Insertar el nuevo amigo en la base de datos
            $amigo->insertarAmigos($id_usuario, $nombre_amigo, $apellido_amigo, $fecha_nacimiento);

            // Redirigir a la página de amigos después de agregarlo
            header('Location: ../VISTA/amigos.php');
        } else {
            echo "No se ha encontrado el ID de usuario en la sesión o no se ha enviado el formulario.";
        }
    }

    /**
     * Función para editar los datos de un amigo
     */
    function editarAmigo(){
        $amigo = new amigos(); // Crear instancia de la clase amigos

        // Si la solicitud es de tipo POST (envío de formulario)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los datos enviados
            $id_amigo = $_GET['id_amigo'];
            $nombre_amigo = $_POST['nombre_amigo'];
            $apellido_amigo = $_POST['apellido_amigo'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];

            // Actualizar la información del amigo en la base de datos
            $amigo->modificarAmigo($id_amigo, $nombre_amigo, $apellido_amigo, $fecha_nacimiento);
            exit(); // Finalizar el script después de la modificación
        } else {
            // Si no es POST, mostrar la información del amigo a editar
            if (isset($_GET['id_amigo'])) {
                $id_amigo = $_GET['id_amigo'];
                
                // Obtener los datos actuales del amigo
                $datos_amigo = $amigo->obtenerAmigoPorId($id_amigo);
                
                // Incluir la vista de modificación
                include('../VISTA/modificarAmigos.php');
            } else {
                echo "No se especifica el amigo a editar";
                exit();
            }
        }
    }

    /**
     * Función para cargar la vista de modificación de un amigo
     */
    function modificarAmigo() {
        // Verificar si la sesión está activa y si se ha especificado un amigo a modificar
        if (isset($_SESSION['id_usuario']) && isset($_GET['id_amigo'])) {
            require_once("../VISTA/modificarAmigo.php"); // Incluir la vista de modificación
        } else {
            echo "Error: No se ha encontrado el amigo o la sesión.";
        }
    }

    /**
     * Función para guardar los cambios realizados a un amigo
     */
    function guardarModificacion() {
        // Verificar si se recibieron los datos necesarios en el formulario
        if (isset($_POST['id_amigo'], $_POST['nombre_amigo'], $_POST['apellido_amigo'], $_POST['fecha_nacimiento'])) {
            require_once("../MODELO/class.amigos.php"); // Incluir la clase amigos
            
            $amigo = new amigos(); // Crear instancia de la clase amigos
            
            // Llamar al método para modificar el amigo en la base de datos
            $amigo->modificarAmigo($_POST['id_amigo'], $_POST['nombre_amigo'], $_POST['apellido_amigo'], $_POST['fecha_nacimiento']);
            
            // Redirigir a la vista de búsqueda de amigos después de guardar los cambios
            header('Location: ../VISTA/buscarAmigos.php');
        } else {
            echo "Error: No se han recibido los datos del formulario.";
        }
    }
    
    /**
     * Verificar si se ha pasado un parámetro 'action' en la URL o formulario
     * para ejecutar una de las funciones definidas.
     */
    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action']; // Obtener el nombre de la función a ejecutar
        $action(); // Llamar a la función correspondiente
    } else {
        buscarAmigo(); // Si no se especifica acción, realizar una búsqueda de amigos por defecto
    }
?>
