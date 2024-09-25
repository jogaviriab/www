<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a MECÁNICO (PILOTO)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="piloto_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="numPiloto" class="form-label">Número del Piloto</label>
            <input type="number" class="form-control" id="numPiloto" name="numPiloto" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
        </div>

        <div class="mb-3">
            <label for="nacionalidad" class="form-label">Nacionalidad</label>
            <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" required>
        </div>

        <div class="mb-3">
            <label for="alias" class="form-label">Alias (Apodo)</label>
            <input type="text" class="form-control" id="alias" name="alias" required>
        </div>

        <div class="mb-3">
            <label for="estiloCond" class="form-label">Estilo de Conducción</label>
            <input type="text" class="form-control" id="estiloCond" name="estiloCond" required>
        </div>

        <!-- Consultar la lista de escuderías y desplegarlas -->
        <div class="mb-3">
            <label for="escuderia" class="form-label">Escudería</label>
            <select name="escuderia" id="escuderia" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../empresa/empresa_select.php");
                
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

        <div class="mb-3">
            <label for="salario" class="form-label">Salario</label>
            <input type="number" class="form-control" id="salario" name="salario" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("piloto_select.php");

// Verificar si llegan datos
if($resultadoPiloto and $resultadoPiloto->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Número</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Fecha Nacimiento</th>
                <th scope="col" class="text-center">Nacionalidad</th>
                <th scope="col" class="text-center">Alias</th>
                <th scope="col" class="text-center">Estilo de Conducción</th>
                <th scope="col" class="text-center">Escudería</th>
                <th scope="col" class="text-center">Salario</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoPiloto as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["numPiloto"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["fechaNacimiento"]; ?></td>
                <td class="text-center"><?= $fila["nacionalidad"]; ?></td>
                <td class="text-center"><?= $fila["alias"]; ?></td>
                <td class="text-center"><?= $fila["estiloCond"]; ?></td>
                <td class="text-center"><?= $fila["escuderia"]; ?></td>
                <td class="text-center">$<?= $fila["salario"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="piloto_delete.php" method="post">
                        <input hidden type="text" name="numPilotoEliminar" value="<?= $fila["numPiloto"]; ?>">
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