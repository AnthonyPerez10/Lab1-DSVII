<?php
class Fuerza
{
    private float $magnitud;
    private float $angulo;

    public function __construct(float $magnitud, float $angulo)
    {
        if ($magnitud < 0) {
            throw new InvalidArgumentException("La magnitud no puede ser negativa.");
        }
        $this->magnitud = $magnitud;
        $this->angulo   = $angulo;
    }

    // Componente X
    public function EntradagetFx(): float
    {
        return $this->magnitud * cos(deg2rad($this->angulo));
    }

    // Componente Y
    public function EntradagetFy(): float
    {
        return $this->magnitud * sin(deg2rad($this->angulo));
    }

    // Radianes
    public function getRadianes(): float
    {
        return deg2rad($this->angulo);
    }
}

// Variables globales
$resultado = null;
$error     = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $magnitud = $_POST['magnitud'] ?? '';
    $angulo   = $_POST['angulo']   ?? '';

    if (
        filter_var($magnitud, FILTER_VALIDATE_FLOAT) !== false &&
        filter_var($angulo,   FILTER_VALIDATE_FLOAT) !== false
    ) {
        try {
            $fuerza = new Fuerza((float)$magnitud, (float)$angulo);

            $fx  = round($fuerza->EntradagetFx(),  4);
            $fy  = round($fuerza->EntradagetFy(),  4);
            $rad = round($fuerza->getRadianes(),    4);

            $resultado = [
                "magnitud" => $magnitud,
                "angulo"   => $angulo,
                "rad"      => $rad,
                "fx"       => $fx,
                "fy"       => $fy,
            ];
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = "Por favor ingrese valores numéricos válidos.";
    }
}
?>

<!-- Titulo -->
<h2 class="page-title">Cálculo de Fuerzas</h2>

<!-- Formulario -->
<?php include(__DIR__ . "/../html/fuerza_form.html"); ?>

<!-- Mensaje de error -->
<?php if (!empty($error)): ?>
    <div class="error-msg">
        <p><strong>Error:</strong> <?= htmlspecialchars($error) ?></p>
    </div>
<?php endif; ?>

<!-- Resultados -->
<?php if ($resultado): ?>
    <div class="alert alert-success mt-3">
        <p><strong>F (Magnitud):</strong>            <?= htmlspecialchars($resultado["magnitud"]) ?> N</p>
        <p><strong>Ángulo en grados:</strong>        <?= htmlspecialchars($resultado["angulo"]) ?>°</p>
        <p><strong>Ángulo en radianes:</strong>      <?= $resultado["rad"] ?> rad</p>
        <p><strong>Componente X (Fx = F·cosθ):</strong> <?= $resultado["fx"] ?> N</p>
        <p><strong>Componente Y (Fy = F·senθ):</strong> <?= $resultado["fy"] ?> N</p>
    </div>
<?php endif; ?>