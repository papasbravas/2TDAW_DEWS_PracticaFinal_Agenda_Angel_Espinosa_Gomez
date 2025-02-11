<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Añadir Amigo</title>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="../VISTA/juegos.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Amigos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../VISTA/aniadirAmigos.php">Insertar Amigos</a></li>
                                <li><a class="dropdown-item" href="../VISTA/buscarAmigos.php">Buscar Amigos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../CONTROLADOR/listarJuegos.php?action=sacarJuego">Juegos</a>
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
        <h2>Añadir Amigo</h2>
        <form action="../CONTROLADOR/amigos.php?action=aniadirAmigo" method="post">
            <label for="nombre_amigo">Nombre: </label>
            <input type="text" name="nombre_amigo" id="nombre_amigo" required>
            <br><br>
            <label for="apellido_amigo">Apellido: </label>
            <input type="text" name="apellido_amigo" id="apellido_amigo" required>
            <br><br>
            <label for="fecha_nacimiento">Fecha de Nacimiento: </label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
            <br><br>
            <input type="submit" value="Añadir Amigo" name="envA">
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>