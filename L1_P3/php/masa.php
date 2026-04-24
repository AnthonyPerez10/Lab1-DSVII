<?php
class Masa
{
    // Variable privada que almacena el valor numérico ingresado
    private $valor;

    // Variable pública que almacena el tipo de conversión seleccionada
    public $tipo;

    /* Constructor que recibe el valor y el tipo de conversión */
    public function __construct($valor, $tipo)
    {
        // Validación: verifica que el valor sea numérico
        if (!is_numeric($valor)) {
            throw new Exception("El valor debe ser numérico.");
        }

        $this->valor = $valor;
        $this->tipo  = $tipo;
    }

    /* Convierte libras a gramos */
    public function librasAGramos()
    {
        return $this->valor * 453.592;
    }

    /* Convierte kilogramos a onzas */
    public function kgAOnzas()
    {
        return $this->valor * 35.274;
    }

    /* Método general que decide qué conversión ejecutar */
    public function convertir()
    {
        if ($this->tipo == "libras_gramos") {
            return round($this->librasAGramos(), 4) . " gramos";
        } else {
            return round($this->kgAOnzas(), 4) . " onzas";
        }
    }
}

/* MANEJO DE DATOS */
$resultado = null;
$error     = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $valor = $_POST["valor"];
        $tipo  = $_POST["tipo"];

        // Validación: número mayor que 0
        if (!is_numeric($valor) || $valor <= 0) {
            throw new Exception("El valor debe ser mayor que 0.");
        }

        // Creación del objeto
        $masa = new Masa($valor, $tipo);

        // Resultado
        $resultado = $masa->convertir();

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!-- Titulo -->
<h2 class="page-title">Conversión de Masa</h2>

<!-- Formulario -->
<?php include(__DIR__ . "/../html/masa_form.html"); ?>

<!-- Mensaje de error -->
<?php if (!empty($error)): ?>
    <div class="error-msg">
        <p><strong>Error:</strong> <?= htmlspecialchars($error) ?></p>
    </div>
<?php endif; ?>

<!-- Resultado -->
<?php if ($resultado): ?>
    <div class="alert alert-success mt-3">
        <p><strong>Resultado:</strong> <?= htmlspecialchars($resultado) ?></p>
    </div>
<?php endif; ?>