
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contactos</title>
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
                            <a class="nav-link dropdown-toggle" href="../VISTA/contactos.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Contactos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../VISTA/aniadirContactos.php">Insertar Amigos</a></li>
                                <li><a class="dropdown-item" href="#">Buscar Amigos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Juegos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Usuarios</a>
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
        <h2>Lista de Contactos</h2>
        <?php
session_start();

if (!isset($_SESSION['contactos']) || empty($_SESSION['contactos'])) {
    echo "<p>No hay contactos disponibles.</p>";
} else {
    echo "<h2>Lista de Contactos</h2>";
    echo "<ul>";
    foreach ($_SESSION['contactos'] as $contacto) {
        echo "<li>{$contacto['nombre_amigo']} {$contacto['apellido_amigo']} - Usuario: {$contacto['nombre_usuario']}</li>";
    }
    echo "</ul>";
}

// Para depuración, muestra toda la sesión
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>