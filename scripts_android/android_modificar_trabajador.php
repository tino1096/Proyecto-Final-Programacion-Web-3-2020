<?php 
	include("../scripts/servidor/conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");

	$respuesta = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$cadena_json = file_get_contents('php://input'); //Recibe información por HTTP
		$datos = json_decode($cadena_json, true);

		$id = $datos['id_trabajador'];
		$nombre = $datos['nombre'];
		$primerAp = $datos['primer_ap'];
		$segundoAp = $datos['segundo_ap'];
		$sexo = $datos['sexo'];
		$fechaNac = $datos['fecha_nac'];
		$calle = $datos['calle'];
		$numero = $datos['numero'];
		$colonia = $datos['colonia'];
		$codigoPostal = $datos['codigo_postal'];
		$ciudad = $datos['ciudad'];
		$puesto = $datos['puesto'];
		$area = $datos['area'];
		$subarea = $datos['subarea'];
        
        $consultaColonia = "SELECT * FROM colonias";
        $sentenciaColonia = $conexionPDO->prepare($consultaColonia);
        $sentenciaColonia->execute([]);
        
        while ($rowColonia = $sentenciaColonia->fetch(PDO::FETCH_ASSOC)) {
            if ($rowColonia['colonia']==$colonia) {
                $idColonia = $rowColonia['id_colonia']; //La colonia del trabajador se encontró en el catalogo de colonias, por tanto, no se agregará otra vez
                break;
            } else {
                $idColonia = null;
            }
        }
        
        if ($idColonia==null) {
            $sql = "INSERT INTO colonias(colonia) VALUES (?)";
            $sentencia = $conexionPDO->prepare($sql);
            $sentencia->execute([$colonia]);

            $consultaColonia = "SELECT id_colonia FROM colonias WHERE colonia = ?";
            $sentenciaColonia = $conexionPDO->prepare($consultaColonia);
            $sentenciaColonia->execute([$colonia]);
            $rowColonia = $sentenciaColonia->fetch(PDO::FETCH_ASSOC);

            $idColonia = $rowColonia['id_colonia'];
        }
        
        $consultaCiudad = "SELECT * FROM ciudades";
        $sentenciaCiudad = $conexionPDO->prepare($consultaCiudad);
        $sentenciaCiudad->execute([]);

        while ($rowCiudad = $sentenciaCiudad->fetch(PDO::FETCH_ASSOC)) {
            if ($rowCiudad['ciudad']==$ciudad) {
                $idCiudad = $rowCiudad['id_ciudad']; //La ciudad del trabajador se encontró en el catalogo de ciudad, por tanto, no se agregará otra vez
                break;
            } else {
                $idCiudad = null;
            }
        }

        if ($idCiudad==null) {
            $sql = "INSERT INTO ciudades(ciudad) VALUES (?)";
            $sentencia = $conexionPDO->prepare($sql);
            $sentencia->execute([$ciudad]);

            $consultaCiudad = "SELECT id_ciudad FROM ciudades WHERE ciudad = ?";
            $sentenciaCiudad = $conexionPDO->prepare($consultaCiudad);
            $sentenciaCiudad->execute([$ciudad]);
            $rowCiudad = $sentenciaCiudad->fetch(PDO::FETCH_ASSOC);

            $idCiudad = $rowCiudad['id_ciudad'];
        } 
        
        $sql = "UPDATE trabajadores SET nombre = ?, primer_apellido = ?, segundo_apellido = ?, sexo = ?, fecha_nacimiento = ?, calle = ?, numero = ?, id_colonia = ?, codigo_postal = ?, id_ciudad = ?, puesto = ?, area = ?, subarea = ? WHERE id_trabajador = ?";
    
        $sentencia = $conexionPDO->prepare($sql);
        $sentencia->execute([$nombre, $primerAp, $segundoAp, $sexo, $fechaNac, $calle, $numero, $idColonia, $codigoPostal, $idCiudad, $puesto, $area, $subarea, $id]);

		if ($sentencia) {
			$respuesta['exito'] = 1;
			$respuesta['msj'] = "Modificacion correcta";
			echo json_encode($respuesta);
		} else {
			$respuesta['exito'] = 0;
			$respuesta['msj'] = "Error en la modificacion";
			echo json_encode($respuesta);
		}
        
        $sentencia = null;
	}
 ?>