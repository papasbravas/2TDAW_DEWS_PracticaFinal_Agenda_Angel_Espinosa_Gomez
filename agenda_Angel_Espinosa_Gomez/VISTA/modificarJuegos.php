<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Juegos</title>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="../VISTA/juegos.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Juegos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../VISTA/aniadirJuego.php">Insertar Juegos</a></li>
                                <li><a class="dropdown-item" href="../VISTA/buscarJuego.php">Buscar juegos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../VISTA/prestamos.php">Prestamos</a>
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
        <div class="container mt-4">
            <h2>Editar Juego</h2>
            <form action="../CONTROLADOR/listarJuegos.php?action=editarJuego&id_juego=<?= $id_juego ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" name="titulo" value="<?= htmlspecialchars($datos_juego['titulo']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="plataforma" class="form-label">Plataforma</label>
                    <input type="text" class="form-control" name="plataforma" value="<?= htmlspecialchars($datos_juego['plataforma']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="anno_lanzamiento" class="form-label">Año de Lanzamiento</label>
                    <input type="number" class="form-control" name="anno_lanzamiento" value="<?= htmlspecialchars($datos_juego['anno_lanzamiento']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" name="foto">
                    <p>Imagen actual:</p>
                    <img src="../imagenes/juegos/<?= htmlspecialchars($datos_juego['foto']) ?>" width="200" alt="Imagen actual">
                    <!-- Campo oculto para mantener la foto actual -->
                    <input type="hidden" name="foto_actual" value="<?= htmlspecialchars($datos_juego['foto']) ?>">
                </div>
                <button type="submit" name="editarJuego" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>