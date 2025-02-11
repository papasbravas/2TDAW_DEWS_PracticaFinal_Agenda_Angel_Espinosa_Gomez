<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Juegos</title>
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
        <h2 class="mt-4">Lista de Juegos</h2>

        <div class="container mt-4">
            <?php session_start(); ?>

            <?php if (isset($_SESSION['juegos']) && !empty($_SESSION['juegos'])): ?>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Imagen</th>
                            <th scope="col">Título</th>
                            <th scope="col">Plataforma</th>
                            <th scope="col">Año de Lanzamiento</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['juegos'] as $juego): ?>
                            <tr>
                                <td><img src="<?= htmlspecialchars($juego['foto']) ?>" width="400" height="220" alt="Imagen del juego"></td>
                                <td><?= htmlspecialchars($juego['titulo']) ?></td>
                                <td><?= htmlspecialchars($juego['plataforma']) ?></td>
                                <td><?= htmlspecialchars($juego['anno_lanzamiento']) ?></td>
                                <!-- Para editar los juegos -->
                                <td>
                                    <a href="../CONTROLADOR/listarJuegos.php?action=editarJuego&id_juego=<?= $juego['id_juego'] ?>" class="btn btn-warning">Editar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php unset($_SESSION['juegos']); ?>
            <?php else: ?>
                <p>No se encontraron juegos.</p>
            <?php endif; ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>