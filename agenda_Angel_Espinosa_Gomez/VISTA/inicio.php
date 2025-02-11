<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="../VISTA/inicio.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </nav>
    </header>
    <main>
        <!-- Al terminar debe llevar a la pagina de amigos, a no ser que sea admin que debe de llevar a usuarios.php -->
        <form action="../CONTROLADOR/log.php?action=inicio" method="post">
            <label for="nombre_usuario">Nombre usuario: </label>
            <input type="text" name="nombre_usuario" value="<?php echo isset($_COOKIE['nombre_usuario']) ? $_COOKIE['nombre_usuario'] : ''; ?>">
            <br><br>
            <label for="contrasenna">Contraseña: </label>
            <input type="password" name="contrasenna">
            <br><br>
            <input type="checkbox" name="recordar" id="recordar" <?php echo isset($_COOKIE['nombre_usuario']) ? 'checked' : ''; ?>>
            <label for="recordar">Recordar usuario</label>
            <br><br>
            <input type="submit" name="inicio" value="Enviar">
        </form>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>