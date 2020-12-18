<?php
    session_start();
    include("../conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
    
    $idTrabajador = $_GET["id"];
	$sqlTrabajador = "DELETE FROM trabajadores WHERE id_trabajador = ?";
    
    $sentencia = $conexionPDO->prepare($sqlTrabajador);
    $sentencia->execute([$idTrabajador]);

    $sqlUsuario = "DELETE FROM usuarios WHERE user = ?";
    
    $sentencia = $conexionPDO->prepare($sqlUsuario);
    $sentencia->execute([$idTrabajador]);

    $sentencia = null;
    header("Location: ../../../vista/paginas/menu_crud.php#/trabajadores");	
?>