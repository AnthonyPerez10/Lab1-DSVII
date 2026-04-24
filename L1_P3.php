<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Matemáticas</title>

        <!-- Bootstrap -->
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- css propio -->
    <link rel="stylesheet" href="L1_P3/css/style.css">
</head>

<body>

    <!-- Nav global -->
    <?php include("L1_P3/html/menu_principal.html"); ?>

    <!-- Submenu interno de L1_P3 -->
    <?php $pagina = $_GET['pagina'] ?? 'angulos'; ?>
    <div class="submenu-interno">
        <a href="L1_P3.php?pagina=angulos" 
           class="submenu-link <?= $pagina === 'angulos' ? 'active' : '' ?>">
            Ángulos
        </a>
        <a href="L1_P3.php?pagina=fuerza"  
           class="submenu-link <?= $pagina === 'fuerza'  ? 'active' : '' ?>">
             Fuerza
        </a>
        <a href="L1_P3.php?pagina=masa"    
           class="submenu-link <?= $pagina === 'masa'    ? 'active' : '' ?>">
            Masa
        </a>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="card">
            <?php
            switch ($pagina) {
                case 'angulos':
                    include __DIR__ . '/L1_P3/php/angulos.php';
                    break;
                case 'fuerza':
                    include __DIR__ . '/L1_P3/php/fuerza.php';
                    break;
                case 'masa':
                    include __DIR__ . '/L1_P3/php/masa.php';
                    break;
                default:
                    echo "<h1 class='page-title'>Error 404</h1><p>Página no encontrada.</p>";
            }
            ?>
        </div>
    </div>
 <!-- Footer -->
    <?php include("L1_P3/html/footer.html"); ?>

</body>
</html>