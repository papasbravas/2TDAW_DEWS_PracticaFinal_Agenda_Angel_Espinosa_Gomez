<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Añadir Juegos</title>
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
    <!-- Para subir la foto falta -->
    <form action="../CONTROLADOR/listarJuegos.php?action=insertoJuego" method="post" enctype="multipart/form-data">
        <label for="titulo">Titulo: </label>
        <input type="text" name="titulo">
        <br><br>
        <label for="plataforma">Plataforma: </label>
        <input type="text" name="plataforma">
        <br><br>
        <label for="anno_lanzamiento">Año de lanzamiento: </label>
        <input type="text" name="anno_lanzamiento">
        <br><br>
        <label for="foto">Foto: </label>
        <input type="file" name="foto">
        <br><br>
        <input type="submit" name="insJuego" value="Enviar">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>