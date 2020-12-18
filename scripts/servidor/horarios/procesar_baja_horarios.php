<?php
    session_start();
    include("../conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
    
    $idTrabajador = $_GET['id'];

	$sqlHE = "DELETE FROM horarios_entrada WHERE id_trabajador = ?";
	$sqlHS = "DELETE FROM horarios_salida WHERE id_trabajador = ?";
    
    $sentenciaHE = $conexionPDO->prepare($sqlHE);
    $sentenciaHE->execute([$idTrabajador]);

    $sentenciaHS = $conexionPDO->prepare($sqlHS);
    $sentenciaHS->execute([$idTrabajador]);

    header("Location: ../../../vista/paginas/menu_crud.php#/horarios");
?>