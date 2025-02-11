<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Añadir Prestamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                                <li><a class="dropdown-item" href="../VISTA/aniadirPrestamos.php">Insertar Prestamos</a></li>
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
    <main class="container mt-4">
        <h2>Añadir Préstamo</h2>
        <form action="../CONTROLADOR/prestamos.php?action=aniadir" method="post">
            <div class="mb-3">
                <label for="amigo" class="form-label">Selecciona Amigo:</label>
                <select name="id_amigo" id="amigo" class="form-control" required>
                    <option value="">-- Selecciona un amigo --</option>
                    <?php foreach ($amigos as $amigo): ?>
                        <option value="<?= htmlspecialchars($amigo['id_amigo']) ?>">
                            <?= htmlspecialchars($amigo['nombre_amigo'] . " " . $amigo['apellido_amigo']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>
            <div class="mb-3">
                <label for="juego" class="form-label">Selecciona Juego:</label>
                <select name="id_juego" id="juego" class="form-control" required>
                    <option value="">-- Selecciona un juego --</option>
                    <?php foreach ($juegos as $juego): ?>
                        <option value="<?= htmlspecialchars($juego['id_juego']) ?>">
                            <?= htmlspecialchars($juego['titulo'] . " - " . $juego['plataforma']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>


            </div>
            <div class="mb-3">
                <label for="fecha_prestamo" class="form-label">Fecha del Préstamo:</label>
                <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="form-control" required>
            </div>
            <!-- El campo devuelto se inserta en el modelo como "NO" por defecto -->
            <button type="submit" class="btn btn-primary">Insertar Préstamo</button>
        </form>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>