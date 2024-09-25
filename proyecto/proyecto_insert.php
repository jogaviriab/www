<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$fecha = $_POST["fecha"];
$distancia = $_POST["distancia"];
$realizadaPor = $_POST["realizadaPor"];
$analizadaPor = $_POST["analizadaPor"];

// Comprobación: realizadaPor debe ser distinto de analizadaPor
if ($realizadaPor !== $analizadaPor) {
    // Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
    $query = "INSERT INTO `prueba`(`codigo`, `fecha`, `distancia`, `realizadaPor`, `analizadaPor`) 
              VALUES ('$codigo', '$fecha', '$distancia', '$realizadaPor', '$analizadaPor')";

    // Ejecutar consulta
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    // Redirigir al usuario a la misma página
    if ($result) {
        // Si fue exitosa, redirigirse de nuevo a la página de la entidad
        header("Location: proyecto.php");
    } else {
        echo "Ha ocurrido un error al crear la prueba.";
    }
} else {
    // Si realizadaPor es igual a analizadaPor, mostrar un error
    echo "La persona que realiza la prueba no puede ser la misma que la que la analiza.";
}

mysqli_close($conn);