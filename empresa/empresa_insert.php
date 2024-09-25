<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$paisOrigen = $_POST["paisOrigen"];
$sede = $_POST["sede"];
$presupuestoAnual = $_POST["presupuestoAnual"];
$motorista = $_POST["motorista"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `escuderia`(`codigo`,`nombre`, `paisOrigen`, `sede`, `presupuestoAnual`, `motorista`) VALUES ('$codigo', '$nombre', '$paisOrigen', '$sede', '$presupuestoAnual', '$motorista')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: empresa.php");
else:
	echo "Ha ocurrido un error al crear la escuderia";
endif;

mysqli_close($conn);