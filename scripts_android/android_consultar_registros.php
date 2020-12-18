<?php 
    include("../scripts/servidor/conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
            
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$cadena_json = file_get_contents('php://input'); //Recibe información por HTTP
		$datos = json_decode($cadena_json, true);

		$id = $datos['id_trabajador'];

        $consultaEntrada = "SELECT * FROM vista_registros_entrada WHERE id_trabajador = ?";
        $consultaSalida = "SELECT * FROM vista_registros_salida WHERE id_trabajador = ?";

        $sentenciaEntrada = $conexionPDO->prepare($consultaEntrada);
        $sentenciaEntrada->execute([$id]);
        
        $sentenciaSalida = $conexionPDO->prepare($consultaSalida);
        $sentenciaSalida->execute([$id]);
        
        $respuesta['registrosEntrada'] = array();
        $respuesta['registrosSalida'] = array();

        $registrosEntrada = array();
        $registrosSalida = array();
        
        while ($rowEntrada = $sentenciaEntrada->fetch(PDO::FETCH_ASSOC)) {
            $registrosEntrada['id'] = $rowEntrada['id_trabajador'];
            $registrosEntrada['nombre'] = $rowEntrada['nombre'];
            $registrosEntrada['primer_ap'] = $rowEntrada['primer_apellido'];
            $registrosEntrada['segundo_ap'] = $rowEntrada['segundo_apellido'];
            $registrosEntrada['hora'] = $rowEntrada['hora'];
            $registrosEntrada['fecha'] = $rowEntrada['fecha'];
            
            array_push($respuesta['registrosEntrada'], $registrosEntrada);
        }
        
        while ($rowSalida = $sentenciaSalida->fetch(PDO::FETCH_ASSOC)) {
            $registrosSalida['id'] = $rowSalida['id_trabajador'];
            $registrosSalida['nombre'] = $rowSalida['nombre'];
            $registrosSalida['primer_ap'] = $rowSalida['primer_apellido'];
            $registrosSalida['segundo_ap'] = $rowSalida['segundo_apellido'];
            $registrosSalida['hora'] = $rowSalida['hora'];
            $registrosSalida['fecha'] = $rowSalida['fecha'];
            
            array_push($respuesta['registrosSalida'], $registrosSalida);
        }

        echo json_encode($respuesta);
    }
 ?>