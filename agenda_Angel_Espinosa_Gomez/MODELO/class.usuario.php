<?php
require_once("../MODELO/class.conexion.php");

class usuario {
    private $bd; // Objeto para la conexión a la base de datos
    private $id_usuario; // ID único del usuario
    private $nombre_usuario; // Nombre del usuario
    private $contrasenna; // Contraseña del usuario
    private $tipo; // Tipo de usuario (puede ser admin, usuario normal, etc.)

    // Constructor de la clase que inicializa los valores
    public function __construct() {
        $this->bd = new bd(); // Crea una nueva instancia de la clase de conexión a la base de datos
        $this->id_usuario = 0;
        $this->nombre_usuario = "";
        $this->contrasenna = "";
        $this->tipo = "";
    }

    // Método para comprobar si un usuario existe en la base de datos mediante su nombre de usuario y contraseña
    public function comprobarUsu(string $nomUsu, string $contrasenna) {
        // Consulta SQL para buscar un usuario con el nombre de usuario y la contraseña proporcionados
        $sent = "SELECT id_usuario, tipo FROM usuarios WHERE nombre_usuario = ? AND contrasenna = ?";
        $cons = $this->bd->getConn()->prepare($sent);
        
        $cons->bind_param("ss", $nomUsu, $contrasenna); // Asocia los parámetros con los valores del nombre de usuario y la contraseña
        $cons->execute(); // Ejecuta la consulta
        
        $cons->bind_result($this->id_usuario, $this->tipo); // Obtiene los resultados (ID y tipo de usuario)
        
        // Si se encuentra un usuario, guarda su ID y tipo, y devuelve true
        if ($cons->fetch()) {
            $this->nombre_usuario = $nomUsu;    
            $cons->close();
            return true;
        }

        // Si no se encuentra el usuario, cierra la consulta y devuelve false
        $cons->close();
        return false;
    }

    // Método para obtener todos los usuarios de la base de datos (solo ID y nombre de usuario)
    public function obtenerUsuarios() {
        // Consulta SQL para obtener el ID y nombre de todos los usuarios
        $sent = "SELECT id_usuario, nombre_usuario FROM usuarios";
        $conn = $this->bd->getConn(); // Obtiene la conexión a la base de datos
        
        if (!$conn) {
            die("Error en la conexión: " . mysqli_connect_error()); // Si no hay conexión, muestra un error
        }

        $cons = $conn->prepare($sent); // Prepara la consulta
        if (!$cons) {
            die("Error al preparar la consulta: " . $conn->error); // Si hay un error al preparar la consulta, muestra un error
        }

        if (!$cons->execute()) {
            die("Error en la ejecución de la consulta: " . $cons->error); // Si hay un error al ejecutar la consulta, muestra un error
        }

        // Obtiene los resultados de la consulta en forma de un array asociativo
        $result = $cons->get_result();
        $usuarios = $result->fetch_all(MYSQLI_ASSOC); // Convierte los resultados en un array

        $cons->close(); // Cierra la consulta

        return $usuarios; // Retorna el array con los usuarios
    }

    // Métodos getters para obtener los valores privados de la clase
    public function getIdUsuario(): int {
        return $this->id_usuario;
    }

    public function getNombreUsuario(): string {
        return $this->nombre_usuario;
    }

    public function getTipo(): string {
        return $this->tipo;
    }
}
?>
