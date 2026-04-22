<!DOCTYPE html>
<html>
<head>
    <title>Conversion de Masa</title>
</head>

<body> <!-- Aquí está todo el contenido de la página, sería como el contenedor principal -->

<div class="main-content">
    <div class="card">

        <h2 class="page-title">Conversión de Masa</h2> <!-- Este es el título que ve el usuario -->

        <form method="POST" action=""> <!-- Este es el formulario donde el usuario ingresa los datos -->

            <div class="form-group">
                <!-- VALOR -->
                <label><b>Ingrese el valor:</b></label><br> <!-- Le indicamos al usuario qué debe escribir -->
                
                <input 
                    type="number" 
                    step="any" 
                    name="valor" 
                    placeholder="Ej: 5.5"
                    required
                    value="<?php echo isset($_POST['valor']) ? $_POST['valor'] : ''; ?>"
                >
                <!-- Campo donde el usuario escribe el número que quiere convertir -->
                
                <br>

                <!-- AVISO -->
                <small>Solo números mayores a 0</small> 
                <!-- Mensaje pequeño para orientar al usuario -->
            </div>

            <div class="form-group">
                <!-- TIPO -->
                <label><b>Tipo de conversión:</b></label><br> <!-- Se le pide elegir el tipo de conversión -->
                
                <select name="tipo">
                    <option value="libras_gramos" <?php if(isset($_POST['tipo']) && $_POST['tipo']=="libras_gramos") echo "selected"; ?>>
                        Libras a gramos
                    </option>
                    <option value="kg_onzas" <?php if(isset($_POST['tipo']) && $_POST['tipo']=="kg_onzas") echo "selected"; ?>>
                        Kilogramos a onzas
                    </option>
                </select>
                <!-- Lista desplegable donde el usuario escoge qué conversión quiere hacer -->
            </div>
            <br><br>

            <!-- BOTONES -->
            <button type="submit" class="btn-submit">Convertir</button>
            <!-- Botón principal que envía los datos para hacer el cálculo -->

            <a href="?pagina=masa" class="link-reset">Nuevo cálculo</a>
            <!-- Este enlace sirve para limpiar y empezar de nuevo -->

        </form>

        <?php
            // Clase donde se hacen las conversiones
            class Masa {
                public function librasAGramos($libras) {
                    return $libras * 453.592; // Convierte libras a gramos
                }
                public function kgAOnzas($kg) {
                    return $kg * 35.274; // Convierte kilogramos a onzas
                }
            }

            // Verificamos si el usuario envió el formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                try {
                    $valor = $_POST["valor"]; // Guardamos el valor ingresado
                    $tipo = $_POST["tipo"]; // Guardamos el tipo de conversión elegido

                    // Validamos que el valor sea número y mayor que 0
                    if (!is_numeric($valor) || $valor <= 0) {
                        throw new Exception("El valor debe ser mayor que 0");
                    }

                    $masa = new Masa(); // Creamos el objeto para usar las conversiones

                    // Dependiendo de lo que el usuario eligió, hacemos la conversión
                    if ($tipo == "libras_gramos") {
                        $resultado = $masa->librasAGramos($valor);
                        echo "<div class='resultado'><b>Resultado:</b> $resultado gramos</div>";
                        // Mostramos el resultado en pantalla
                    } else {
                        $resultado = $masa->kgAOnzas($valor);
                        echo "<div class='resultado'><b>Resultado:</b> $resultado onzas</div>";
                        // Mostramos el resultado en pantalla
                    }

                } catch (Exception $e) {
                    // Si hay error (por ejemplo número inválido), lo mostramos aquí
                    echo "<div class='error-msg'><b>Error:</b> " . $e->getMessage() . "</div>";
                }
            }
        ?>
        </div>
    </div>

</body>
</html>