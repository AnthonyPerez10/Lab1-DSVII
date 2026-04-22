<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Matemáticas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!--Menu principal-->
    <nav class="navbar">
        <?php include("html/menu_principal.html"); ?>
    </nav>
    <!--Termina menu principal-->

    <!--Contenido Principal-->
    <div class="main-content">
        <div class="card">

            <?php
            // Configuracion de errroes 
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            // obtener la pagina principal 
            $pagina = $_GET['pagina'] ?? 'angulos';

            //si no ha parametro, carga por defecto la pagian de angulos
            switch ($pagina) {

                case 'angulos':
                case 'angulos': //Pagina de angulos 
                    if (file_exists(__DIR__ . '/php/angulos.php')) {
                        include __DIR__ . '/php/angulos.php'; // se carga la pagina de angulos
                    } else {
                        // Si hay un error al mostrar imprime este error. 
                        echo "<h1 class='page-title'>Ángulos</h1><p>Módulo en construcción.</p>";
                    }
                    break;

                case 'fuerza': // pagina de fuerza
                    if (file_exists(__DIR__ . '/php/fuerza.php')) {
                        include __DIR__ . '/php/fuerza.php'; // se carga la pagina de fuerza
                    } else {
                        // si hay un error se muestra el soguiente mensaje 
                        echo "<h1 class='page-title'>Fuerzas</h1><p>Módulo en construcción.</p>";
                    }
                    break;

                case 'masa': // pagina de masa
                    if (file_exists(__DIR__ . '/php/masa.php')) {
                        include __DIR__ . '/php/masa.php'; // se carga la pagina de masa 
                    } else {
                        // si hay un error se impime el siguiente mensaje. 
                        echo "<h1 class='page-title'>Masa</h1><p>Módulo en construcción.</p>";
                    }
                    break;
                // Pagina no encotrada 
                default:
                    echo "<h1 class='page-title'>Error 404</h1><p>Página no encontrada.</p>";
                    break;
            }
            ?>
        </div>
    </div>
    <!--Inicio del footer-->
    <?php include("html/footer.html"); ?>
    <!--Termina footer-->
</body>

</html>