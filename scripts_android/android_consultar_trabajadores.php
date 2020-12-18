<?php 
    include("../scripts/servidor/conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");

    $consulta = "SELECT * FROM registros_trabajadores";

    $sentencia = $conexionPDO->prepare($consulta);
    $sentencia->execute([]);
            
    $respuesta['trabajadores'] = array();
    while ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) { 
        $trabajador = array();

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

        array_push($respuesta['trabajadores'], $trabajador);
		
    }

    echo json_encode($respuesta);
 ?>