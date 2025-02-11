<?php
    require_once("../MODELO/class.conexion.php");

    class juegos{
        private $bd; // Objeto para la conexión a la base de datos
        private $id_juego; // Identificador único del juego
        private $id_usuario; // Identificador del usuario propietario del juego
        private $titulo; // Título del juego
        private $plataforma; // Plataforma en la que está disponible el juego (e.g., PC, PS4)
        private $anno_lanzamiento; // Año en que se lanzó el juego
        private $foto; // Imagen asociada al juego (ruta de la foto)

        // Constructor que inicializa los valores de la clase
        public function __construct(){
            $this->bd = new bd(); // Crea una instancia de la clase de conexión a la base de datos
            $this->id_juego = 0;
            $this->id_usuario = 0;
            $this->titulo = "";
            $this->plataforma = "";
            $this->anno_lanzamiento = 0;
            $this->foto = "";
        }

        // Método que se utiliza para buscar juegos por título
        public function buscarJuego($titulo = null) {
            // Consulta SQL para buscar juegos con título que coincide parcialmente con el valor dado
            $sent = "SELECT id_juego, foto, titulo, plataforma, anno_lanzamiento FROM juegos WHERE titulo LIKE ?";
            if($cons = $this->bd->getConn()->prepare($sent)){
                if($titulo){
                    $titulo = $titulo.'%'; // Añade el comodín '%' para hacer búsqueda parcial
                    $cons->bind_param("s", $titulo); // Asocia el parámetro del título para la consulta
                }
            }
            // Ejecuta la consulta
            if($cons->execute()){
                $cons->bind_result($id_juego, $foto, $titulo, $plataforma, $anno_lanzamiento); // Vincula los resultados a las variables
            }
            $juegos = []; // Array para almacenar los juegos encontrados
            // Itera sobre los resultados y agrega cada juego al array
            while($cons->fetch()){
                $juegos[] = [
                    'id_juego' => $id_juego,
                    'foto' => $foto,
                    'titulo' => $titulo,
                    'plataforma'=> $plataforma,
                    'anno_lanzamiento'=> $anno_lanzamiento
                ];
            }
            return $juegos; // Retorna el array de juegos encontrados
        }

        // Método para insertar un nuevo juego en la base de datos
        public function insertJuego($id_usuario, $foto, $titulo = "", $plataforma = "", $anno_lanzamiento = 0) {
            // Consulta SQL para insertar un juego nuevo
            $sent = "INSERT INTO juegos (id_usuario, titulo, plataforma, anno_lanzamiento, foto) VALUES (?, ?, ?, ?, ?)";
            
            if ($cons = $this->bd->getConn()->prepare($sent)) {
                $cons->bind_param("issis", $id_usuario, $foto, $titulo, $plataforma, $anno_lanzamiento); // Asocia los parámetros para la inserción
                // Ejecuta la inserción y verifica si fue exitosa
                if ($cons->execute()) {
                    echo "Juego añadido"; // Mensaje de éxito
                } else {
                    echo "Error en la inserción: " . $cons->error; // Mensaje de error en caso de fallo
                }
            } else {
                echo "Error al preparar la consulta: " . $this->bd->getConn()->error; // Mensaje de error si no se pudo preparar la consulta
            }
        }

        // Método para obtener un juego por su ID
        public function obtenerJuegoPorId($id_juego) {
            // Consulta SQL para obtener los detalles de un juego usando su ID
            $sent = "SELECT id_juego, titulo, plataforma, anno_lanzamiento, foto FROM juegos WHERE id_juego = ?";
            
            if ($cons = $this->bd->getConn()->prepare($sent)) {
                $cons->bind_param("i", $id_juego); // Asocia el parámetro de ID del juego
                // Ejecuta la consulta y obtiene los resultados
                if ($cons->execute()) {
                    $cons->bind_result($this->id_juego, $this->titulo, $this->plataforma, $this->anno_lanzamiento, $this->foto);
                    $cons->fetch(); // Obtiene el primer (y único) resultado
                    // Retorna los detalles del juego
                    return [
                        'id_juego' => $this->id_juego,
                        'titulo' => $this->titulo,
                        'plataforma' => $this->plataforma,
                        'anno_lanzamiento' => $this->anno_lanzamiento,
                        'foto' => $this->foto
                    ];
                }
            }
            return []; // Retorna un array vacío si no se encuentra el juego
        }

        // Método para actualizar los detalles de un juego en la base de datos
        public function actualizarJuego($id_juego, $titulo, $plataforma, $anno_lanzamiento, $foto) {
            // Consulta SQL para actualizar los detalles del juego
            $sent = "UPDATE juegos SET titulo = ?, plataforma = ?, anno_lanzamiento = ?, foto = ? WHERE id_juego = ?";
            
            if ($cons = $this->bd->getConn()->prepare($sent)) {
                $cons->bind_param("ssisi", $titulo, $plataforma, $anno_lanzamiento, $foto, $id_juego); // Asocia los parámetros para la actualización
                // Ejecuta la actualización y verifica si fue exitosa
                if ($cons->execute()) {
                    echo "Juego actualizado correctamente."; // Mensaje de éxito
                } else {
                    echo "Error al actualizar el juego."; // Mensaje de error en caso de fallo
                }
            }
        }
    }
?>
