<?php 
    include("../scripts/servidor/conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
            
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$cadena_json = file_get_contents('php://input'); //Recibe información por HTTP
		$datos = json_decode($cadena_json, true);

		$id = $datos['id_trabajador'];

        $consulta = "SELECT * FROM registros_trabajadores WHERE id_trabajador = ?";

        $sentencia = $conexionPDO->prepare($consulta);
        $sentencia->execute([$id]);
        
        $respuesta['perfil'] = array();

        $trabajador = array();
        
        $row = $sentencia->fetch(PDO::FETCH_ASSOC);
        
        $trabajador['id'] = $row['id_trabajador'];
        $trabajador['nombre'] = $row['nombre'];
        $trabajador['primer_ap'] = $row['primer_apellido'];
        $trabajador['segundo_ap'] = $row['segundo_apellido'];
        $trabajador['sexo'] = $row['sexo'];
        $trabajador['fecha_nac'] = $row['fecha_nacimiento'];
        $trabajador['calle'] = $row['calle'];
        $trabajador['numero'] = $row['numero'];
        $trabajador['colonia'] = $row['colonia'];
        $trabajador['codigo_postal'] = $row['codigo_postal'];
        $trabajador['ciudad'] = $row['ciudad'];
        $trabajador['puesto'] = $row['puesto'];
        $trabajador['area'] = $row['area'];
        $trabajador['subarea'] = $row['subarea'];
        
        array_push($respuesta['perfil'], $trabajador);

        echo json_encode($respuesta);
    }
 ?>