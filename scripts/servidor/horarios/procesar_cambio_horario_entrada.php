<?php
    include("../conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");

    $idTrabajador = $_POST['caja_id_trabajador'];
    $lunes = $_POST['caja_lunes_entrada'];
    $martes = $_POST['caja_martes_entrada'];
    $miercoles = $_POST['caja_miercoles_entrada'];
    $jueves = $_POST['caja_jueves_entrada'];
    $viernes = $_POST['caja_viernes_entrada'];
    
    $sql = "UPDATE horarios_entrada SET lunes = ?, martes = ?, miercoles= ?, jueves = ?, viernes = ? WHERE id_trabajador = ?";

    $sentencia = $conexionPDO->prepare($sql);
    $sentencia->execute([$lunes, $martes, $miercoles, $jueves, $viernes, $idTrabajador]);
    
    header("Location: ../../../vista/paginas/menu_crud.php#/horarios");
?>