<?php

class Angulo
{
    // Variable privada para almacenar el ángulo en grados
    private $grados;

    /* Constructor que recibe el valor del ángulo y valida que sea numero*/
    public function __construct($grados)
    {
        // Quita el símbolo de grados si existe
        $grados = str_replace('°', '', $grados);

        // Validación: si no es número, lanza excepción
        if (!is_numeric($grados)) {
            throw new Exception("El valor del ángulo debe ser numérico.");
        }
        // Asigna el valor a la variable
        $this->grados = (float)$grados;
    }

    // Convierte grados a radianes
    public function getRadianes()
    {
        return deg2rad($this->grados);
    }

    // Calcula seno
    public function getSeno()
    {
        return sin($this->getRadianes());
    }

    // Calcula coseno
    public function getCoseno()
    {
        return cos($this->getRadianes());
    }

    // Calcula tangente
    public function getTangente()
    {
        return tan($this->getRadianes());
    }

    /* Determina el cuadrante del ángulo */
    public function getCuadrante()
    {
        // Para soportar los decimales
        $angulo = fmod($this->grados, 360);

        if ($angulo == 0 || $angulo == 90 || $angulo == 180 || $angulo == 270) {
            return "Eje";
        } elseif ($angulo > 0 && $angulo < 90) {
            return "I";
        } elseif ($angulo > 90 && $angulo < 180) {
            return "II";
        } elseif ($angulo > 180 && $angulo < 270) {
            return "III";
        } else {
            return "IV";
        }
    }
}

/* Manejo de datos y excepciones */
$resultado = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $anguloInput = $_POST["angulo"];
        $angulo = new Angulo($anguloInput);

        $resultado = [
            "grados"    => $anguloInput,
            "radianes"  => $angulo->getRadianes(),
            "seno"      => $angulo->getSeno(),
            "coseno"    => $angulo->getCoseno(),
            "tangente"  => $angulo->getTangente(),
            "cuadrante" => $angulo->getCuadrante()
        ];
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!-- Titulo -->
<h2 class="page-title">Cálculo de Ángulos</h2>

<!-- Inicia formulario -->
<?php include(__DIR__ . "/../html/formulario.html"); ?>
<!-- Termina formulario -->

<!-- Mensaje de error -->
<?php if (!empty($error)): ?>
    <div class="error-msg">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<!-- Resultados -->
<?php if ($resultado): ?>
    <div class="alert alert-success mt-3">
        <p><strong>Grados:</strong>    <?= htmlspecialchars($resultado["grados"]) ?></p>
        <p><strong>Radianes:</strong>  <?= round($resultado["radianes"], 4) ?></p>
        <p><strong>Sen:</strong>       <?= round($resultado["seno"],     4) ?></p>
        <p><strong>Cos:</strong>       <?= round($resultado["coseno"],   4) ?></p>
        <p><strong>Tan:</strong>       <?= round($resultado["tangente"], 4) ?></p>
        <p><strong>Cuadrante:</strong> <?= htmlspecialchars($resultado["cuadrante"]) ?></p>
    </div>
<?php endif; ?>