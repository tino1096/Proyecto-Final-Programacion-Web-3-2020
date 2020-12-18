<?php
    session_start();
    include("../conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");


    $idTrabajador = $_SESSION['usuario'];
    
    //numero de registros de entrada 
    $consultaEntrda = "SELECT COUNT(*) AS numero_registros_entrada FROM registros_entrada WHERE id_trabajador = ?";
    $sentenciaEntrda = $conexionPDO->prepare($consultaEntrda);
    $sentenciaEntrda->execute([$idTrabajador]); 

    //numero de registros de salida 
    $consultaSalida = "SELECT COUNT(*) AS numero_registros_salida FROM registros_salida WHERE id_trabajador = ?";
    $sentenciaSalida = $conexionPDO->prepare($consultaSalida);
    $sentenciaSalida->execute([$idTrabajador]);
    
    $rowEntrada = $sentenciaEntrda->fetch(PDO::FETCH_ASSOC);
    $rowSalida = $sentenciaSalida->fetch(PDO::FETCH_ASSOC);

    if ($rowEntrada['numero_registros_entrada'] == $rowSalida['numero_registros_salida']) {
        $sql = "INSERT INTO registros_entrada VALUES (?, TIME(NOW()), CURDATE());";
    } else {
        $sql = "INSERT INTO registros_salida VALUES (?, TIME(NOW()), CURDATE())";
    }

    $sentencia = $conexionPDO->prepare($sql);
    $sentencia->execute([$idTrabajador]);
    
    header("Location: ../../../vista/paginas/inicio.php#/registros");
?>