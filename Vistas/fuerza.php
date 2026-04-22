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
        $this->angulo = $angulo;
    }

    public function getFx(): float
    {
        return $this->magnitud * cos(deg2rad($this->angulo));
    }

    public function getFy(): float
    {
        return $this->magnitud * sin(deg2rad($this->angulo));
    }
}

$resultado = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $magnitud = $_POST['magnitud'] ?? '';
    $angulo = $_POST['angulo'] ?? '';

    if (is_numeric($magnitud) && is_numeric($angulo)) {

        try {
            $fuerza = new Fuerza((float)$magnitud, (float)$angulo);

            $fx = round($fuerza->getFx(), 4);
            $fy = round($fuerza->getFy(), 4);

            $resultado = "Componente X (Fx): {$fx} N <br> Componente Y (Fy): {$fy} N";
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = "Por favor ingrese valores numéricos válidos.";
    }
}
?>

<h1 class="page-title">Calculadora de Fuerzas</h1>

<form method="POST">

    <div class="form-group">
        <label>Magnitud (N):</label>
        <input type="number" step="any" name="magnitud" required
            value="<?php echo htmlspecialchars($_POST['magnitud'] ?? ''); ?>">
    </div>

    <div class="form-group">
        <label>Ángulo (grados):</label>
        <input type="number" step="any" name="angulo" required
            value="<?php echo htmlspecialchars($_POST['angulo'] ?? ''); ?>">
    </div>

    <button type="submit" class="btn-submit">Calcular</button>

</form>

<?php if ($resultado): ?>
    <div class="resultado">
        <h3>Resultado:</h3>
        <p><?php echo $resultado; ?></p>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="error-msg">
        <p><strong>Error:</strong> <?php echo $error; ?></p>
    </div>
<?php endif; ?>