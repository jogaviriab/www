<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 2</h1>

<p class="mt-3">
    Dado el código de una escudería. Se debe mostrar, para el piloto de mayor salario adscrito
    a esa escudería, todos los datos de todas las pruebas que ese piloto analizó.
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda2.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código de la Escudería</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $codigo = $_POST["codigo"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query = "SELECT prue.*
                FROM prueba prue
                WHERE prue.analizadaPor IN (
                    SELECT pio.numPiloto
                    FROM piloto pio
                    WHERE pio.escuderia = '$codigo'
                    AND pio.salario = (
                        SELECT MAX(pio2.salario)
                        FROM piloto pio2
                        WHERE pio2.escuderia = '$codigo'
                    )
                );";

    // Ejecutar la consulta
    $resultadoB2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB2 and $resultadoB2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Distancia</th>
                <th scope="col" class="text-center">Fecha</th>
                <th scope="col" class="text-center">Realizada Por</th>
                <th scope="col" class="text-center">Analizada Por</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["distancia"]; ?> km</td>
                <td class="text-center"><?= $fila["fecha"]; ?></td>
                <td class="text-center"><?= $fila["realizadaPor"]; ?></td>
                <td class="text-center"><?= $fila["analizadaPor"]; ?></td>
            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<!-- Mensaje de error si no hay resultados -->
<?php
else:
?>

<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta consulta
</div>

<?php
    endif;
endif;

include "../includes/footer.php";
?>