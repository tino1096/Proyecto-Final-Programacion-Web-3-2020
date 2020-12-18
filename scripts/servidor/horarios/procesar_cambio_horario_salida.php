<?php
    include("../conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");

    $idTrabajador = $_POST['caja_id_trabajador'];
    $lunes = $_POST['caja_lunes_salida'];
    $martes = $_POST['caja_martes_salida'];
    $miercoles = $_POST['caja_miercoles_salida'];
    $jueves = $_POST['caja_jueves_salida'];
    $viernes = $_POST['caja_viernes_salida'];
    
    $sql = "UPDATE horarios_salida SET lunes = ?, martes = ?, miercoles= ?, jueves = ?, viernes = ? WHERE id_trabajador = ?";

    $sentencia = $conexionPDO->prepare($sql);
    $sentencia->execute([$lunes, $martes, $miercoles, $jueves, $viernes, $idTrabajador]);
    
    header("Location: ../../../vista/paginas/menu_crud.php#/horarios");
?>