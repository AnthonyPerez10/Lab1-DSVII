<?php
/*
L1P3 - MÓDULO MATEMÁTICAS
Autor: Grupo 3*/

// Captura la opción seleccionada en el menú
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'inicio';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo Matemáticas - L1P3</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- DE NAVEGACIÓN -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

        <a class="navbar-brand" href="index.php">L1P3 - Matemáticas</a>

        <ul class="navbar-nav">

            <!-- Opción Ángulos -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?pagina=angulos">Ángulos</a>
            </li>

            <!-- Opción Fuerzas -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?pagina=fuerzas">Fuerzas</a>
            </li>

            <!-- Opción Masa -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?pagina=masa">Masa</a>
            </li>

        </ul>
    </div>
</nav>

<!-- CONTENEDOR PRINCIPAL -->
<div class="container mt-4">

<?php
/*
Menu
*/
switch ($pagina) {

    case 'angulos':
        include("angulos.php"); // Brandom
        break;

    case 'fuerzas':
        include("fuerzas.php"); //Anthony
        break;

    case 'masa':
        include("masa.php"); // Alexandra y Luis
        break;

    default:
        // Pantalla inicial
        echo "
        <div class='text-center'>
            <h2>Bienvenido al módulo de Matemáticas</h2>
            <p>Seleccione una opción del menú para comenzar</p>
        </div>
        ";
        break;
}
?>

</div>

<!--FOOTER  -->
<footer class="bg-dark text-white text-center p-3 mt-5">
    <p>Grupo 3 - L1P3 Matemáticas</p>
</footer>

</body>
</html>