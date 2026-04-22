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
    if (
        filter_var($magnitud, FILTER_VALIDATE_FLOAT) !== false &&
        filter_var($angulo, FILTER_VALIDATE_FLOAT) !== false
    ) {

        try {
            $fuerza = new Fuerza((float)$magnitud, (float)$angulo);

            $fx = round($fuerza->EntradagetFx(), 4);
            $fy = round($fuerza->EntradagetFy(), 4);
            $rad = round($fuerza->getRadianes(), 4);
            // Se prepara el resultado para mostrarlo en pantalla
            $resultado = "
                    <strong>F (Magnitud):</strong> {$magnitud} N <br>
                    <strong>Ángulo en grados:</strong> {$angulo}° <br>
                    <strong>Ángulo en radianes:</strong> {$rad} rad <br>
                    <strong>Componente X (Fx = F·cosθ):</strong> {$fx} N <br>
                    <strong>Componente Y (Fy = F·senθ):</strong> {$fy} N
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

<?php include("html/fuerza_form.html"); ?> <!--Se incluye el formulario de Fuerzas --->

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