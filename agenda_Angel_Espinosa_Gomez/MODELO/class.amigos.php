<?php
// Incluir la clase de conexión a la base de datos
require_once("../MODELO/class.conexion.php");

class amigos {
    private $bd;  // Conexión con la base de datos
    private $id_amigo;  // ID del amigo
    private $id_usuario;  // ID del usuario que tiene el amigo
    private $nombre_amigo;  // Nombre del amigo
    private $apellido_amigo;  // Apellido del amigo
    private $fecha_nacimiento;  // Fecha de nacimiento del amigo

    // Constructor de la clase
    public function __construct(){
        $this->bd = new bd();  // Se inicializa la conexión a la base de datos
        $this->id_amigo = 0;  // Se establece un valor inicial para el ID del amigo
        $this->id_usuario = 0;  // Se establece un valor inicial para el ID del usuario
        $this->nombre_amigo = "";  // Se establece un valor inicial para el nombre del amigo
        $this->apellido_amigo = "";  // Se establece un valor inicial para el apellido del amigo
        $this->fecha_nacimiento = "";  // Se establece un valor inicial para la fecha de nacimiento
    }

    /**
     * Obtener los datos de un amigo por su ID
     */
    public function obtenerAmigoPorId($id_amigo) {
        // Consulta para obtener los datos del amigo
        $sent = "SELECT id_amigo, nombre_amigo, apellido_amigo, fecha_nacimiento FROM amigos WHERE id_amigo = ?";
        
        // Preparar y ejecutar la consulta
        if ($cons = $this->bd->getConn()->prepare($sent)) {
            $cons->bind_param("i", $id_amigo);  // Vinculamos el ID del amigo a la consulta
            if ($cons->execute()) {
                $cons->bind_result($id, $nombre, $apellido, $fecha);  // Asociamos los resultados de la consulta
                if ($cons->fetch()) {  // Si se encuentra el amigo
                    $cons->close();
                    // Devolvemos los datos del amigo en forma de arreglo
                    return [
                        'id_amigo' => $id,
                        'nombre_amigo' => $nombre,
                        'apellido_amigo' => $apellido,
                        'fecha_nacimiento' => $fecha
                    ];
                }
            }
            $cons->close();
        }
        return [];  // Si no se encuentra el amigo, devolvemos un arreglo vacío
    }
    
    /**
     * Obtener todos los contactos (amigos) de todos los usuarios
     */
    public function obtenerTodosLosContactos() {
        // Consulta para obtener los amigos de todos los usuarios
        $sent = "SELECT a.id_amigo, a.nombre_amigo, a.apellido_amigo, a.fecha_nacimiento, 
                        u.nombre_usuario 
                 FROM amigos a 
                 JOIN usuarios u ON a.id_usuario = u.id_usuario";
        
        $conn = $this->bd->getConn();  // Se obtiene la conexión a la base de datos
        
        if (!$conn) {
            die("Error en la conexión: " . mysqli_connect_error());  // Si no hay conexión, se muestra un error
        }
        
        // Preparar y ejecutar la consulta
        $cons = $conn->prepare($sent);
        if (!$cons) {
            die("Error al preparar la consulta: " . $conn->error);  // Si falla la preparación, mostramos un error
        }
        
        if (!$cons->execute()) {
            die("Error en la ejecución de la consulta: " . $cons->error);  // Si falla la ejecución, mostramos un error
        }

        // Asociamos los resultados con las variables
        $cons->bind_result($id_amigo, $nombre_amigo, $apellido_amigo, $fecha_nacimiento, $nombre_usuario);
        
        $contactos = [];  // Creamos un arreglo para almacenar los contactos
        while ($cons->fetch()) {  // Iteramos sobre los resultados obtenidos
            // Agregamos cada contacto al arreglo
            $contactos[] = [
                'id_amigo' => $id_amigo,
                'nombre_amigo' => $nombre_amigo,
                'apellido_amigo' => $apellido_amigo,
                'fecha_nacimiento' => $fecha_nacimiento,
                'nombre_usuario' => $nombre_usuario
            ];
        }
        
        $cons->close();  // Cerramos la consulta
        return $contactos;  // Devolvemos todos los contactos encontrados
    }

    /**
     * Buscar amigos por nombre (y por usuario)
     */
    public function buscarAmigos($id_usuario, $nombre = null) {
        // Consulta para buscar amigos por nombre y por usuario
        $sent = "SELECT id_amigo, nombre_amigo, apellido_amigo, fecha_nacimiento FROM amigos WHERE id_usuario = ?";
        
        if ($nombre != NULL) {
            $sent .= " AND nombre_amigo LIKE ?";  // Si se proporciona un nombre, se añade la condición
        }

        if ($cons = $this->bd->getConn()->prepare($sent)) {
            if ($nombre) {
                $nombre = $nombre . '%';  // Se crea un filtro para que la búsqueda sea por prefijo
                $cons->bind_param("is", $id_usuario, $nombre);  // Vinculamos los parámetros de búsqueda
            } else {
                $cons->bind_param("i", $id_usuario);  // Solo buscamos por el ID del usuario
            }
            
            // Ejecutamos la consulta y asociamos los resultados
            $cons->execute();
            $cons->bind_result($this->id_amigo, $this->nombre_amigo, $this->apellido_amigo, $this->fecha_nacimiento);
            
            $amigos = [];  // Creamos un arreglo para almacenar los amigos encontrados
            while ($cons->fetch()) {
                $fecha = date("d/m/Y", strtotime($this->fecha_nacimiento));  // Formateamos la fecha de nacimiento
                // Agregamos cada amigo encontrado al arreglo
                $amigos[] = [
                    'id_amigo' => $this->id_amigo,
                    'nombre_amigo' => $this->nombre_amigo,
                    'apellido_amigo' => $this->apellido_amigo,
                    'fecha_nacimiento' => $fecha
                ];
            }
            
            $cons->close();  // Cerramos la consulta
            return $amigos;  // Devolvemos todos los amigos encontrados
        }
        return [];  // Si no se encuentran amigos, devolvemos un arreglo vacío
    }

    /**
     * Insertar un nuevo amigo en la base de datos
     */
    public function insertarAmigos($id_usuario, $nombre_amigo, $apellido_amigo, $fecha_nacimiento) {
        // Consulta para insertar un nuevo amigo en la base de datos
        $sent = "INSERT INTO amigos (id_usuario, nombre_amigo, apellido_amigo, fecha_nacimiento) VALUES (?, ?, ?, ?)";
        
        $conn = $this->bd->getConn();  // Obtenemos la conexión a la base de datos
        if (!$conn) {
            die("Error en la conexión: " . mysqli_connect_error());  // Si falla la conexión, mostramos un error
        }
        
        // Preparar y ejecutar la consulta
        if ($cons = $conn->prepare($sent)) {
            $cons->bind_param("isss", $id_usuario, $nombre_amigo, $apellido_amigo, $fecha_nacimiento);
        
            if ($cons->execute()) {
                $cons->close();  // Si la inserción es exitosa, cerramos la consulta
                return true;  // Devolvemos true para indicar que el amigo fue insertado correctamente
            }
        }
        
        return false;  // Si falla la inserción, devolvemos false
    }

    /**
     * Modificar los datos de un amigo existente
     */
    public function modificarAmigo($id_amigo, $nombre_amigo, $apellido_amigo, $fecha_nacimiento) {
        // Consulta para actualizar los datos de un amigo
        $sent = "UPDATE amigos SET nombre_amigo = ?, apellido_amigo = ?, fecha_nacimiento = ? WHERE id_amigo = ?";
        
        // Preparar y ejecutar la consulta
        if ($cons = $this->bd->getConn()->prepare($sent)) {
            $cons->bind_param("sssi", $nombre_amigo, $apellido_amigo, $fecha_nacimiento, $id_amigo);
        
            if ($cons->execute()) {
                echo "Amigo modificado correctamente";  // Si la modificación es exitosa, mostramos un mensaje
                header("Location: ../VISTA/amigos.php");  // Redirigimos a la página de amigos
            } else {
                echo "Error al modificar el amigo";  // Si falla la modificación, mostramos un mensaje de error
            }
        } else {
            echo "Error al preparar la consulta";  // Si hay un error al preparar la consulta, mostramos un mensaje de error
        }
    }
}
?>
