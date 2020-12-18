<?php 
    include("../scripts/servidor/conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
            
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$cadena_json = file_get_contents('php://input'); //Recibe información por HTTP
		$datos = json_decode($cadena_json, true);

		$id = $datos['id_trabajador'];

        $consultaEntrada = "SELECT * FROM registros_horarios_entrada WHERE id_trabajador = ?";
        $consultaSalida = "SELECT * FROM registros_horarios_salida WHERE id_trabajador = ?";

        $sentenciaEntrada = $conexionPDO->prepare($consultaEntrada);
        $sentenciaEntrada->execute([$id]);
        
        $sentenciaSalida = $conexionPDO->prepare($consultaSalida);
        $sentenciaSalida->execute([$id]);
        
        $respuesta['horarioEntrada'] = array();
        $respuesta['horarioSalida'] = array();

        $horarioEntrada = array();
        $horarioSalida = array();
        
        $rowEntrada = $sentenciaEntrada->fetch(PDO::FETCH_ASSOC);
        $rowSalida = $sentenciaSalida->fetch(PDO::FETCH_ASSOC);
        
        $horarioEntrada['id'] = $rowEntrada['id_trabajador'];
        $horarioEntrada['nombre'] = $rowEntrada['nombre'];
        $horarioEntrada['primer_ap'] = $rowEntrada['primer_apellido'];
        $horarioEntrada['segundo_ap'] = $rowEntrada['segundo_apellido'];
        $horarioEntrada['lunes'] = $rowEntrada['lunes'];
        $horarioEntrada['martes'] = $rowEntrada['martes'];
        $horarioEntrada['miercoles'] = $rowEntrada['miercoles'];
        $horarioEntrada['jueves'] = $rowEntrada['jueves'];
        $horarioEntrada['viernes'] = $rowEntrada['viernes'];
        
        array_push($respuesta['horarioEntrada'], $horarioEntrada);
        
        $horarioSalida['id'] = $rowSalida['id_trabajador'];
        $horarioSalida['nombre'] = $rowSalida['nombre'];
        $horarioSalida['primer_ap'] = $rowSalida['primer_apellido'];
        $horarioSalida['segundo_ap'] = $rowSalida['segundo_apellido'];
        $horarioSalida['lunes'] = $rowSalida['lunes'];
        $horarioSalida['martes'] = $rowSalida['martes'];
        $horarioSalida['miercoles'] = $rowSalida['miercoles'];
        $horarioSalida['jueves'] = $rowSalida['jueves'];
        $horarioSalida['viernes'] = $rowSalida['viernes'];
        
        array_push($respuesta['horarioSalida'], $horarioSalida);

        echo json_encode($respuesta);
    }
 ?>