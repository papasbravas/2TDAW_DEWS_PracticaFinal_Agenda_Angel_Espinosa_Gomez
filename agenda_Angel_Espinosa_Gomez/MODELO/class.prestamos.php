<?php
require_once("../MODELO/class.conexion.php");

class prestamos
{
    private $bd; // Objeto para la conexión a la base de datos
    private $id_prestamo; // ID único del préstamo
    private $id_amigo; // ID del amigo al que se le presta el juego
    private $id_usuario; // ID del usuario que realiza el préstamo
    private $fecha_prestamo; // Fecha en que se realiza el préstamo
    private $devuelto; // Estado que indica si el juego ha sido devuelto (SI/NO)

    // Constructor que inicializa los valores de la clase
    public function __construct()
    {
        $this->bd = new bd(); // Crea una instancia de la clase de conexión a la base de datos
        $this->id_prestamo = 0;
        $this->id_amigo = 0;
        $this->id_usuario = 0;
        $this->fecha_prestamo = "";
        $this->devuelto = "";
    }

    // Método para buscar préstamos basados en un término de búsqueda (nombre de amigo o título del juego)
    public function buscarPrestamo($input)
    {
        // Consulta SQL para obtener información sobre los préstamos, amigos y juegos relacionados
        $sent = "SELECT p.id_prestamo, a.nombre_amigo, j.titulo, j.foto, p.fecha_prestamo, p.devuelto 
                 FROM amigos a, juegos j, prestamos p 
                 WHERE p.id_amigo = a.id_amigo AND p.id_juego = j.id_juego";

        // Si hay un término de búsqueda, añade condiciones a la consulta
        if ($input != NULL) {
            $sent .= " AND (a.nombre_amigo LIKE ? OR j.titulo LIKE ?)";
        }

        // Prepara y ejecuta la consulta
        $cons = $this->bd->getConn()->prepare($sent);
        $searchTerm = $input . "%"; // Se añade el comodín '%' para búsqueda parcial
        $cons->bind_param("ss", $searchTerm, $searchTerm); // Asocia los parámetros de búsqueda
        $cons->execute();
        $resultado = $cons->get_result(); // Obtiene el resultado de la consulta

        // Crea un array con los resultados de los préstamos encontrados
        $prestamos = [];
        while ($row = $resultado->fetch_assoc()) {
            $prestamos[] = $row;
        }

        return $prestamos; // Retorna el array de préstamos encontrados
    }

    // Método para insertar un nuevo préstamo. Devuelto se inserta por defecto como "NO".
    public function insertarPrestamo($idAmigo, $idJuego, $fechaPrestamo)
    {
        // Consulta SQL para insertar un nuevo préstamo
        $sentencia = "INSERT INTO prestamos (id_amigo, id_juego, fecha_prestamo, devuelto) VALUES (?, ?, ?, ?)";
        $stmt = $this->bd->getConn()->prepare($sentencia);
        $devuelto = "NO"; // Valor por defecto de "devuelto"

        // Verificación de los valores que se están enviando (comentado por si necesitas depuración)
        // echo "ID Amigo: " . htmlspecialchars($idAmigo) . "<br>";
        // echo "ID Juego: " . htmlspecialchars($idJuego) . "<br>";
        // echo "Fecha Préstamo: " . htmlspecialchars($fechaPrestamo) . "<br>";

        // Asocia los parámetros para la inserción
        $stmt->bind_param("iiss", $idAmigo, $idJuego, $fechaPrestamo, $devuelto);

        // Ejecuta la consulta de inserción y verifica si fue exitosa
        if ($stmt->execute()) {
            echo "Préstamo insertado correctamente."; // Mensaje de éxito
        } else {
            echo "Error al insertar el préstamo: " . $stmt->error; // Mensaje de error si algo falla
        }
    }

    // Método para marcar un préstamo como devuelto
    public function devolverPrestamo($id_prestamo)
    {
        // Consulta SQL para actualizar el estado de "devuelto" a "SI" para el préstamo con el ID proporcionado
        $sentencia = "UPDATE prestamos SET devuelto = 'SI' WHERE id_prestamo = ?";

        // Prepara y ejecuta la consulta
        $stmt = $this->bd->getConn()->prepare($sentencia);
        $stmt->bind_param("i", $id_prestamo); // Asocia el parámetro de ID del préstamo

        // Ejecuta la actualización y verifica si fue exitosa
        if ($stmt->execute()) {
            echo "Préstamo devuelto correctamente."; // Mensaje de éxito
        } else {
            echo "Error al devolver el préstamo: " . $stmt->error; // Mensaje de error si algo falla
        }
    }
}
?>

