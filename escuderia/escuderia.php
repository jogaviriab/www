<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a DEPARTAMENTO (ESCUDERÍA)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="escuderia_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="paisOrigen" class="form-label">País de Origen</label>
            <input type="text" class="form-control" id="paisOrigen" name="paisOrigen" required>
        </div>

        <div class="mb-3">
            <label for="sede" class="form-label">Sede</label>
            <input type="text" class="form-control" id="sede" name="sede" required>
        </div>

        <div class="mb-3">
            <label for="presupuestoAnual" class="form-label">Presupuesto Anual</label>
            <input type="number" class="form-control" id="presupuestoAnual" name="presupuestoAnual" required>
        </div>

        <!-- Consultar la lista de escuderías y desplegarlos -->
        <div class="mb-3">
            <label for="motorista" class="form-label">Motorista</label>
            <select name="motorista" id="motorista" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../escuderia/escuderia_select.php");
                
                // Verificar si llegan datos
                if($resultadoEscuderia):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoEscuderia as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["codigo"]; ?>"><?= $fila["nombre"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("escuderia_select.php");

// Verificar si llegan datos
if($resultadoEscuderia and $resultadoEscuderia->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">País de Origen</th>
                <th scope="col" class="text-center">Sede</th>
                <th scope="col" class="text-center">Presupuesto Anual</th>
                <th scope="col" class="text-center">Motorista</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoEscuderia as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["paisOrigen"]; ?></td>
                <td class="text-center"><?= $fila["sede"]; ?></td>
                <td class="text-center">$<?= $fila["presupuestoAnual"]; ?></td>
                <td class="text-center"><?= $fila["motorista"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="escuderia_delete.php" method="post">
                        <input hidden type="text" name="codigoEliminar" value="<?= $fila["codigo"]; ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>

            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<?php
endif;

include "../includes/footer.php";
?>