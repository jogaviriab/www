<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$numPiloto = $_POST["numPiloto"];
$nombre = $_POST["nombre"];
$fechaNacimiento = $_POST["fechaNacimiento"];
$nacionalidad = $_POST["nacionalidad"];
$alias = $_POST["alias"];
$estiloCond = $_POST["estiloCond"];
$escuderia = $_POST["escuderia"];
$salario = $_POST["salario"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `piloto`(`numPiloto`,`nombre`, `fechaNacimiento`, `nacionalidad`, `alias`, `estiloCond`, `escuderia`, `salario`) VALUES ('$numPiloto', '$nombre', '$fechaNacimiento', '$nacionalidad', '$alias', '$estiloCond', '$escuderia', '$salario')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: cliente.php");
else:
	echo "Ha ocurrido un error al crear el piloto";
endif;

mysqli_close($conn);