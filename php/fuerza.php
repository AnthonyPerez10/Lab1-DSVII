<?php

/*Inicio de la clase para realizar los calculos de Operacion de fuerza*/
class Fuerza
{
    private float $magnitud; /* Variable de entrada de magnitud de  la fuerza */
    private float $angulo; /*Variable de angulo del eje en grados  */

    // Inicio del constructor
    public function __construct(float $magnitud, float $angulo)
    {
        // Validación de magnitud no puede ser menor a cero ni negativa
        if ($magnitud < 0) {
            /* Resultado si ocurre */
            throw new InvalidArgumentException("La magnitud no puede ser negativa.");
        }
        // Asignacion de los valores a las propiedades del objecto
        $this->magnitud = $magnitud;
        $this->angulo = $angulo;
    }

    //Metodo para calcular la componente X de la fuerza
    public function EntradagetFx(): float
    {
        return $this->magnitud * cos(deg2rad($this->angulo));
    }
    //Metodo para calcular la componente en Y 
    public function EntradagetFy(): float
    {
        return $this->magnitud * sin(deg2rad($this->angulo));
    }

    // Metodo para calcular radianes
    public function getRadianes(): float
    {
        return deg2rad($this->angulo);
    }
} // Fin de la calse de calculos de fuerza 

// Variables globales para mostrar resultado y error de Try-Cath
$resultado = null;
$error = null;

// Detectar si se presionó el botón limpiar
if (isset($_POST['limpiar'])) {
    $_POST['magnitud'] = '';
    $_POST['angulo'] = '';
    $resultado = null;
    $error = null;
}

// Verifica si el formulario fue enviado. 
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Obtiene los datos ingresados
    $magnitud = $_POST['magnitud'] ?? '';
    $angulo = $_POST['angulo'] ?? '';

    //Validacion de ambos valores debesn ser de tipo numerico
    if (is_numeric($magnitud) && is_numeric($angulo)) {

        try {
            $fuerza = new Fuerza((float)$magnitud, (float)$angulo);

            $fx = round($fuerza->EntradagetFx(), 4);
            $fy = round($fuerza->EntradagetFy(), 4);
            $rad = round($fuerza->getRadianes(), 4);
            // Se prepara el resultado para mostrarlo en pantalla
            $resultado = "
                        F (Magnitud): {$magnitud} N <br>
                        Ángulo en grados: {$angulo}° <br>
                        Ángulo en radianes: {$rad} rad <br>
                        Componente X (Fx = F·cosθ): {$fx} N <br>
                        Componente Y (Fy = F·senθ): {$fy} N
                        ";
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        // Captura una excepcion si los valores no son validos
        $error = "Por favor ingrese valores numéricos válidos.";
    }
}
?>

<!--Parte visual del formulario-->

<!--Titulo del formulario-->
<h1 class="page-title">Calculadora de Fuerzas</h1>

<!--Formulario en HTML-->
<form method="POST">

    <div class="form-group">
        <label>Magnitud (N):</label>
        <input type="number" step="any" name="magnitud" required
            placeholder="Ingrese datos tipo numerico. ejm: 10 (Newton)."
            value="<?php echo htmlspecialchars($_POST['magnitud'] ?? ''); ?>">
    </div>

    <div class="form-group">
        <label>Ángulo (grados):</label>
        <input type="number" step="any" name="angulo" required
            placeholder="Ingrese de datos de tipo numerico. ejm: 30 (Grados)."
            value="<?php echo htmlspecialchars($_POST['angulo'] ?? ''); ?>">
    </div>

    <button type="submit" class="btn-submit">Calcular</button>

    <button type="submit" name="limpiar" class="btn-clear">
        Limpiar
    </button>

</form>

<!--Mostrar los resultado si existe-->
<?php if ($resultado): ?>
    <div class="resultado">
        <h3>Resultado:</h3>
        <p><?php echo $resultado; ?></p>
    </div>
<?php endif; ?>

<!--Mostrar los resultado si existe-->
<?php if ($error): ?>
    <div class="error-msg">
        <p><strong>Error:</strong> <?php echo $error; ?></p>
    </div>
<?php endif; ?>