<?php
// Definimos la clase de conexión a la base de datos
class bd{
    private $con;  // Variable para almacenar la conexión a la base de datos

    // Constructor de la clase
    public function __construct(){
        // Se incluye el archivo de credenciales para acceder a la base de datos (comentado para tu referencia)
        // require_once('../../../../cred.php');
        
        // Requerimos el archivo que contiene las credenciales de la base de datos
        require_once('../../../cred.php');

        // Creamos una nueva conexión a la base de datos usando las credenciales
        // `localhost` es el servidor donde se encuentra la base de datos
        // `USU_CONN` es el nombre de usuario para la base de datos
        // `PSW_CONN` es la contraseña para la base de datos
        // `"agenda"` es el nombre de la base de datos
        $this->con = new mysqli("localhost", USU_CONN, PSW_CONN, "agenda");
    }

    // Método para obtener la conexión a la base de datos
    public function getConn(){
        return $this->con;  // Retorna el objeto de conexión
    }
}
?>
