<?php 
	include("../scripts/servidor/conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");

	$respuesta = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$cadena_json = file_get_contents('php://input'); //Recibe información por HTTP
		$datos = json_decode($cadena_json, true);

		$id = $datos['id_trabajador'];
        
        $consulta = "DELETE FROM trabajadores WHERE id_trabajador = ?";
        $sentencia = $conexionPDO->prepare($consulta);
        $sentencia->execute([$id]);

        $sqlUsuario = "DELETE FROM usuarios WHERE user = ?";
    
        $sentencia = $conexionPDO->prepare($sqlUsuario);
        $sentencia->execute([$id]);
        
		if ($sentencia) {
			$respuesta['exito'] = 1;
			$respuesta['msj'] = "Eliminacion correcta";
			echo json_encode($respuesta);
		} else {
			$respuesta['exito'] = 0;
			$respuesta['msj'] = "Error en la eliminacion";
			echo json_encode($respuesta);
		}
	}
 ?>