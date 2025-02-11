<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buscar Amigos</title>
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
    <!-- Si simplemente le doy a enviar sin meter nada saca todos los amigos, si no saca solo los que pido -->
    <form action="../CONTROLADOR/amigos.php?action=buscarAmigo" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre">
        <input type="submit" value="Enviar" name="envA">
    </form>

    <!-- Esto debe de salir en amigos.php para mostrar la lista y asi modificarlos -->
    <h3>Lista de Amigos</h3>
    <ul class="list-group">
        <?php if (isset($amigos) && count($amigos) > 0) { ?>
            <?php foreach ($amigos as $amigo): ?>
                <li class="list-group-item">
                    <strong><?php echo htmlspecialchars($amigo['nombre_amigo'] . " " . $amigo['apellido_amigo']); ?></strong><br>
                    Fecha de nacimiento: <?php echo htmlspecialchars($amigo['fecha_nacimiento']); ?>

                    <!-- Botón para editar arreglarlo -->
                    <button><a href="../CONTROLADOR/amigos.php?action=editarAmigo&id_amigo=<?php echo $amigo['id_amigo']; ?>" class="btn btn-warning btn-sm float-right ml-2">Modificar</a></button>
                </li>
            <?php endforeach; ?>
        <?php } else { ?>
            <li class="list-group-item">No tienes amigos en tu lista.</li>
        <?php } ?>
    </ul>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>