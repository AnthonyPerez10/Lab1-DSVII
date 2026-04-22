<?php
/* CLASE MASA */
class Masa { 

    // ATRIBUTOS
    // Variable privada que almacena el valor numérico ingresado
    private $valor;

    // Variable pública que almacena el tipo de conversión seleccionada
    public $tipo;

    /*
    Constructor que recibe el valor y el tipo de conversión
    Se ejecuta automáticamente al crear el objeto
    */
    public function __construct($valor, $tipo) {

        // Validación: verifica que el valor sea numérico
        if (!is_numeric($valor)) {
            throw new Exception("El valor debe ser numérico.");
        }

        // Asigna valores a los atributos de la clase
        $this->valor = $valor;
        $this->tipo = $tipo;
    }

    /*
    Convierte libras a gramos
    */
    public function librasAGramos() {
        return $this->valor * 453.592;
    }

    /*
    Convierte kilogramos a onzas
    */
    public function kgAOnzas() {
        return $this->valor * 35.274;
    }

    /*
    Método general que decide qué conversión ejecutar
    */
    public function convertir() {

        if ($this->tipo == "libras_gramos") {
            return $this->librasAGramos() . " gramos";
        } else {
            return $this->kgAOnzas() . " onzas";
        }
    }
}

/*
 MANEJO DE DATOS 
*/

// Variable para guardar resultado
$resultado = null;

// Variable para errores
$error = "";

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        // Captura los datos del formulario
        $valor = $_POST["valor"];
        $tipo = $_POST["tipo"];

        // Validación: número mayor que 0
        if (!is_numeric($valor) || $valor <= 0) {
            throw new Exception("El valor debe ser mayor que 0");
        }

        // Creación del objeto (POO)
        $masa = new Masa($valor, $tipo);

        // Uso de método para obtener resultado
        $resultado = $masa->convertir();

    } catch (Exception $e) {
        // Guarda el mensaje de error
        $error = $e->getMessage();
    }
}
?>

<!-- INTERFAZ -->

<div class="main-content container mt-4">

    <!-- Tarjeta principal -->
    <div class="card p-4 shadow">

        <!-- Título -->
        <h1 class="page-title text-center mb-4">Conversión de Masa</h1>


        <!-- Formulario -->
        <form method="POST" action="">

            <div class="form-group mb-3">
                <!-- VALOR -->
                <label class="form-label"><b>Ingrese el valor:</b></label>

                <input 
                    type="number" 
                    step="any" 
                    name="valor" 
                    class="form-control"
                    placeholder="Ej: 5.5"
                    required
                    value="<?php echo isset($_POST['valor']) ? $_POST['valor'] : ''; ?>"
                >

                <!-- AVISO -->
                <small class="text-muted">Solo números mayores a 0</small>
            </div>

            <div class="form-group mb-3">
                <!-- TIPO -->
                <label class="form-label"><b>Tipo de conversión:</b></label>

                <select name="tipo" class="form-select">
                    <option value="libras_gramos" <?php if(isset($_POST['tipo']) && $_POST['tipo']=="libras_gramos") echo "selected"; ?>>
                        Libras a gramos
                    </option>
                    <option value="kg_onzas" <?php if(isset($_POST['tipo']) && $_POST['tipo']=="kg_onzas") echo "selected"; ?>>
                        Kilogramos a onzas
                    </option>
                </select>
            </div>

            <!-- BOTONES -->
            <button type="submit" class="btn-submit btn btn-primary">
                Convertir
            </button>

            <button type="button" class="btn-clear btn"
                onclick="window.location.href='?pagina=masa'">
                Limpiar
            </button>

        </form>

        <!-- Mensaje de error -->
        <?php if ($error): ?>
            <div class="error-msg alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <!-- Resultado -->
        <?php if ($resultado): ?>
            <div class="resultado alert alert-success mt-3">
                <strong>Resultado:</strong> <?= $resultado ?>
            </div>
        <?php endif; ?>

    </div>
</div>