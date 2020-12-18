<?php 
	session_start();
    if (! $_SESSION['activa'] == true) {
        header("Location: ../../index.html");
    } else {
        include("../../scripts/servidor/conexion_PDO.php");
        $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
                    
        $consulta = "SELECT * FROM registros_trabajadores WHERE id_trabajador = ?";
        
        $usuario = $_SESSION['usuario'];
                
        $sentencia = $conexionPDO->prepare($consulta);
        $sentencia->execute([$usuario]);

        $row = $sentencia->fetch(PDO::FETCH_ASSOC);
    }
?>

<div class="card mt-4">
    <div class="card-body">
        <h2> Perfil </h2>
        <form class="form" action="" method="POST">
            <div class="form-group">
                <label for="caja_id_trabajador" class="cols-sm-2 control-label">ID </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_id_trabajador" id="caja_id_trabajador" value="<?php echo $row['id_trabajador']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="caja_nombre" class="cols-sm-2 control-label">Nombre </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_nombre" id="caja_nombre" value="<?php echo $row['nombre']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="caja_primer_ap" class="cols-sm-2 control-label">Primer apellido </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_primer_ap" id="caja_primer_ap" value="<?php echo $row['primer_apellido']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="caja_segundo_ap" class="cols-sm-2 control-label">Segundo apellido </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_segundo_ap" id="caja_segundo_ap" value="<?php echo $row['segundo_apellido']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="caja_sexo" class="cols-sm-2 control-label">Sexo </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_sexo" id="caja_sexo" value="<?php echo $row['sexo']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="caja_fecha_nac" class="cols-sm-2 control-label">Fecha de Nacimiento </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_fecha_nac" id="caja_fecha_nac" value="<?php echo $row['fecha_nacimiento']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="caja_calle" class="cols-sm-2 control-label">Calle </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_calle" id="caja_calle" value="<?php echo $row['calle']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="caja_numero" class="cols-sm-2 control-label">Numero </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_numero" id="caja_numero" value="<?php echo $row['numero']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="caja_colonia" class="cols-sm-2 control-label">Colonia </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_colonia" id="caja_colonia" value="<?php echo $row['colonia']; ?>" readonly/>
                </div>
            </div>
            
            <div class="form-group">
                <label for="caja_codigo_postal" class="cols-sm-2 control-label">Código postal </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_codigo_postal" id="caja_codigo_postal" value="<?php echo $row['codigo_postal']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="caja_ciudad" class="cols-sm-2 control-label">Ciudad </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_ciudad" id="caja_ciudad" value="<?php echo $row['ciudad']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="caja_puesto" class="cols-sm-2 control-label">Puesto </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_puesto" id="caja_puesto" value="<?php echo $row['puesto']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="caja_area" class="cols-sm-2 control-label">Area </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_area" id="caja_area" value="<?php echo $row['area']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="caja_subarea" class="cols-sm-2 control-label">Subarea </label>
                <div class="cols-sm-4">
                    <input type="text" class="form-control" name="caja_subarea" id="caja_subarea" value="<?php echo $row['subarea']; ?>" readonly/>
                </div>
            </div>
        </form>

    </div>
</div>
