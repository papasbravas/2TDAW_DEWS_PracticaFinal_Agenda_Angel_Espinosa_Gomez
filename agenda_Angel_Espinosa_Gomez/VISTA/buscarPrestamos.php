<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buscar Prestamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./style.css"> -->
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="../VISTA/inicio.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../VISTA/amigos.php">Amigos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../CONTROLADOR/listarJuegos.php?action=sacarJuego">Juegos</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="../VISTA/prestamos.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Prestamos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../CONTROLADOR/prestamos.php?action=aniadir">Insertar Prestamos</a></li>
                                <li><a class="dropdown-item" href="../VISTA/buscarPrestamos.php">Buscar Prestamos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../CONTROLADOR/log.php?action=salir">Salir</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
    <form action="../CONTROLADOR/prestamos.php?action=buscarPrestamo" method="post">
        <label for="nombres">Nombre de amigo/Título de juego:</label>
        <input type="text" name="nombres" placeholder="Buscar préstamo...">
        <br><br>
        <input type="submit" value="Buscar" name="buscP">
    </form>

    <?php
if (!empty($prestamos)) {
    echo "<table border='1'>
            <tr>
                <th>Amigo</th>
                <th>Juego</th>
                <th>Foto</th>
                <th>Fecha Préstamo</th>
                <th>Devuelto</th>
                <th>Acciones</th>
            </tr>";

    foreach ($prestamos as $prestamo) {
        $foto = !empty($prestamo['foto']) ? $prestamo['foto'] : '../imagenes/juegos/default.jpg';

        echo "<tr>
                <td>" . htmlspecialchars($prestamo['nombre_amigo']) . "</td>
                <td>" . htmlspecialchars($prestamo['titulo']) . "</td>
                <td><img src='" . htmlspecialchars($foto) . "' alt='Foto' width='400' height='220'></td>
                <td>" . htmlspecialchars($prestamo['fecha_prestamo']) . "</td>
                <td>" . htmlspecialchars($prestamo['devuelto']) . "</td>
                <td>";

        // Si el préstamo no ha sido devuelto, mostramos el enlace "Devolver"
        if ($prestamo['devuelto'] == 'NO') {
            echo "<a href='../CONTROLADOR/prestamos.php?action=prestamo&id_prestamo=" . $prestamo['id_prestamo'] . "' class='btn btn-success'>Devolver</a>";
        } else {
            // Si ya fue devuelto, mostramos "Devuelto"
            echo "Ya devuelto";
        }

        echo "</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No se encontraron préstamos.</p>";
}
?>

</main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
