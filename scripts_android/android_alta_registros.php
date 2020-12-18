<?php
    include("../scripts/servidor/conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
    
    /* Para agregar un registro de entrada/salida, 
    se verificará el NUMERO DE REGISTROS de las entradas 
    y de las salidas, si es IGUAL entonces ha completado 
    su entrada y salida por lo tanto AGREGARÁ UNA ENTRADA,
    si NO ES IGUAL, AREGARÁ UNA SALIDA para completar el registro*/

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_json = file_get_contents('php://input'); //Recibe información por HTTP
		$datos = json_decode($cadena_json, true);

		$id = $datos['id_trabajador'];
        
        //numero de registros de entrada 
        $consultaEntrda = "SELECT COUNT(*) AS numero_registros_entrada FROM registros_entrada WHERE id_trabajador = ?";
        $sentenciaEntrda = $conexionPDO->prepare($consultaEntrda);
        $sentenciaEntrda->execute([$id]); 

        //numero de registros de salida 
        $consultaSalida = "SELECT COUNT(*) AS numero_registros_salida FROM registros_salida WHERE id_trabajador = ?";
        $sentenciaSalida = $conexionPDO->prepare($consultaSalida);
        $sentenciaSalida->execute([$id]);

        $rowEntrada = $sentenciaEntrda->fetch(PDO::FETCH_ASSOC);
        $rowSalida = $sentenciaSalida->fetch(PDO::FETCH_ASSOC);
        
        $respuesta['registrar'] = array();
        $registrar = array();
        
        if ($rowEntrada['numero_registros_entrada'] == $rowSalida['numero_registros_salida']) {
            $sql = "INSERT INTO registros_entrada VALUES (?, TIME(NOW()), CURDATE())";
            $registrar['entrada'] = true;
            $registrar['salida'] = false;
            array_push($respuesta['registrar'], $registrar);
            echo json_encode($respuesta);
        } else {
            $sql = "INSERT INTO registros_salida VALUES (?, TIME(NOW()), CURDATE())";
            $registrar['entrada'] = false;
            $registrar['salida'] = true;
            array_push($respuesta['registrar'], $registrar);
            echo json_encode($respuesta);
        }

        $sentencia = $conexionPDO->prepare($sql);
        $sentencia->execute([$id]);
    }
    
?>