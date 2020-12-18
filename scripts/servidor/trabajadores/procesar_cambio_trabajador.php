<?php
    include("../conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");

    $idTrabajador = $_POST['caja_id_trabajador'];
    $nombre = $_POST['caja_nombre'];
    $primerAp = $_POST['caja_primer_ap'];
    $segundoAp = $_POST['caja_segundo_ap'];
    $sexo = $_POST['radio_sexo'];
    $fechaNac = $_POST['caja_fecha_nac'];
    $calle = $_POST['caja_calle'];
    $numero = $_POST['caja_numero'];
    
    $colonia = $_POST['select_colonia']; 
    $cajaColonia = $_POST['caja_colonia'];

    $codigoPostal = $_POST['caja_codigo_postal'];
    
    $ciudad = $_POST['select_ciudad'];
    $cajaCiudad = $_POST['caja_ciudad'];

    $puesto = $_POST['select_puesto'];
    $area = $_POST['select_area'];
    $subarea = $_POST['select_subarea'];

    $consultaColonia = "SELECT * FROM colonias";
    $sentenciaColonia = $conexionPDO->prepare($consultaColonia);
    $sentenciaColonia->execute([]);

    if ($cajaColonia!="" or $cajaColonia!=null) {
        while ($rowColonia = $sentenciaColonia->fetch(PDO::FETCH_ASSOC)) {
            if ($rowColonia['colonia']==$cajaColonia) {
                $idColonia = $rowColonia['id_colonia']; //Si la colonia del trabajador se encuentra en la tabla de colonias, no se agregará otra vez
                break;
            } else {
                $idColonia = null;
            }
        }
    } else {
        while ($rowColonia = $sentenciaColonia->fetch(PDO::FETCH_ASSOC)) {
            if ($rowColonia['colonia']==$colonia) {
                $idColonia = $rowColonia['id_colonia']; 
            }
        }
    }

    if ($idColonia==null) {
        $sql = "INSERT INTO colonias(colonia) VALUES (?)";
        $sentencia = $conexionPDO->prepare($sql);
        $sentencia->execute([$cajaColonia]);
        
        $consultaColonia = "SELECT id_colonia FROM colonias WHERE colonia = ?";
        $sentenciaColonia = $conexionPDO->prepare($consultaColonia);
        $sentenciaColonia->execute([$cajaColonia]);
        $rowColonia = $sentenciaColonia->fetch(PDO::FETCH_ASSOC);
        
        $idColonia = $rowColonia['id_colonia'];
    }

    $consultaCiudad = "SELECT * FROM ciudades";
    $sentenciaCiudad = $conexionPDO->prepare($consultaCiudad);
    $sentenciaCiudad->execute([]);

    if ($cajaCiudad!="" or $cajaCiudad!=null) {
        while ($rowCiudad = $sentenciaCiudad->fetch(PDO::FETCH_ASSOC)) {
            if ($rowCiudad['ciudad']==$cajaCiudad) {
                $idCiudad = $rowCiudad['id_ciudad']; //Si la ciudad del trabajador se encuentra en el en la tabla de la ciudad, por tanto, no se agregará otra vez.
                break;
            } else {
                $idCiudad = null;
            }
        }
    } else {
        while ($rowCiudad = $sentenciaCiudad->fetch(PDO::FETCH_ASSOC)) {
            if ($rowCiudad['ciudad']==$ciudad) {
                $idCiudad = $rowCiudad['id_ciudad']; 
            }
        }
    }
    
    if ($idCiudad==null) {
        $sql = "INSERT INTO ciudades(ciudad) VALUES (?)";
        $sentencia = $conexionPDO->prepare($sql);
        $sentencia->execute([$cajaCiudad]);
        
        $consultaCiudad = "SELECT id_ciudad FROM ciudades WHERE ciudad = ?";
        $sentenciaCiudad = $conexionPDO->prepare($consultaCiudad);
        $sentenciaCiudad->execute([$cajaCiudad]);
        $rowCiudad = $sentenciaCiudad->fetch(PDO::FETCH_ASSOC);
        
        $idCiudad = $rowCiudad['id_ciudad'];
    } 
    
    $sql = "UPDATE trabajadores SET nombre = ?, primer_apellido = ?, segundo_apellido = ?, sexo = ?, fecha_nacimiento = ?, calle = ?, numero = ?, id_colonia = ?, codigo_postal = ?, id_ciudad = ?, puesto = ?, area = ?, subarea = ? WHERE id_trabajador = ?";
    
    $sentencia = $conexionPDO->prepare($sql);
    $sentencia->execute([$nombre, $primerAp, $segundoAp, $sexo, $fechaNac, $calle, $numero, $idColonia, $codigoPostal, $idCiudad, $puesto, $area, $subarea, $idTrabajador]);

    $sentencia = null;
    header("Location: ../../../vista/paginas/menu_crud.php#/trabajadores");
?>