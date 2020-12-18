<?php
    include("../conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");

    $idTrabajador = $_POST['select_id_trabajadores'];
    $lunesEntrada = $_POST['caja_lunes_entrada'];
    $lunesSalida = $_POST['caja_lunes_salida'];
    $martesEntrada = $_POST['caja_martes_entrada'];
    $martesSalida = $_POST['caja_martes_salida'];
    $miercolesEntrada = $_POST['caja_miercoles_entrada'];
    $miercolesSalida = $_POST['caja_miercoles_salida'];
    $juevesEntrada = $_POST['caja_jueves_entrada'];
    $juevesSalida = $_POST['caja_jueves_salida'];
    $viernesEntrada = $_POST['caja_viernes_entrada'];
    $viernesSalida = $_POST['caja_viernes_salida'];
   
    
    $sqlEntrada = "INSERT INTO horarios_entrada VALUES (?, ?, ?, ?, ?, ?)";
    $sqlSalida = "INSERT INTO horarios_salida VALUES (?, ?, ?, ?, ?, ?)";

    $sentenciaEntrada = $conexionPDO->prepare($sqlEntrada);
    $sentenciaEntrada->execute([$idTrabajador, $lunesEntrada, $martesEntrada, $miercolesEntrada, $juevesEntrada, $viernesEntrada]);

    $sentenciaSalida = $conexionPDO->prepare($sqlSalida);
    $sentenciaSalida->execute([$idTrabajador, $lunesSalida, $martesSalida, $miercolesSalida, $juevesSalida, $viernesSalida]);
    
    header("Location: ../../../vista/paginas/menu_crud.php#/horarios");
?>