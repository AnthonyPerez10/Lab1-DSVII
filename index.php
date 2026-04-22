<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Matemáticas</title>
    <link rel="stylesheet" href="Styles/style.css">
</head>

<body>

    <nav class="navbar">
        <div class="navbar-brand">Módulo Matemáticas</div>

        <ul class="nav-menu">

            <li class="nav-item">
                <a class="nav-link <?php echo (($_GET['pagina'] ?? '') == 'angulos') ? 'active' : ''; ?>"
                    href="index.php?pagina=angulos">Ángulos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo (($_GET['pagina'] ?? '') == 'fuerza') ? 'active' : ''; ?>"
                    href="index.php?pagina=fuerza">Fuerzas</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo (($_GET['pagina'] ?? '') == 'masa') ? 'active' : ''; ?>"
                    href="index.php?pagina=masa">Masa</a>
            </li>

        </ul>
    </nav>

    <div class="main-content">
        <div class="card">

            <?php

            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            $pagina = $_GET['pagina'] ?? 'angulos';

            switch ($pagina) {

                case 'angulos':
                    if (file_exists(__DIR__ . '/Vistas/angulos.php')) {
                        include __DIR__ . '/Vistas/angulos.php';
                    } else {
                        echo "<h1 class='page-title'>Ángulos</h1><p>Módulo en construcción.</p>";
                    }
                    break;

                case 'fuerza':
                    if (file_exists(__DIR__ . '/Vistas/fuerza.php')) {
                        include __DIR__ . '/Vistas/fuerza.php';
                    } else {
                        echo "<h1 class='page-title'>Fuerzas</h1><p>Módulo en construcción.</p>";
                    }
                    break;

                case 'masa':
                    if (file_exists(__DIR__ . '/Vistas/masa.php')) {
                        include __DIR__ . '/Vistas/masa.php';
                    } else {
                        echo "<h1 class='page-title'>Masa</h1><p>Módulo en construcción.</p>";
                    }
                    break;

                default:
                    echo "<h1 class='page-title'>Error 404</h1><p>Página no encontrada.</p>";
                    break;
            }

            ?>

        </div>
    </div>

    <footer class="footer">
        <p>Grupo 3 - L1P3 Matemáticas</p>
        <p>Integrantes: Anthony Perez, Brandon Arcia, Luis Vasquez, Alexandra de Gracia</p>
    </footer>

</body>

</html>