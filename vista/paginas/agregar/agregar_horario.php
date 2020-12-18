<?php 
	session_start();
    if (! $_SESSION['activa'] == true and $_SESSION['tipo_usuario']!="Administrador") {
        header("Location: ../../../index.html");
    } else {
        include("../../../scripts/servidor/conexion_PDO.php");
        $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
        
        $consulta = "SELECT id_trabajador FROM trabajadores";
                
        $sentencia = $conexionPDO->prepare($consulta);
        $sentencia->execute([]);
    }
?>   

<div class="container">
    <div class="row main">
        <div class="main-login main-center">
            <h5>Ingrese el horario del trabajador </h5>
            <form class="" method="post" action="../../scripts/servidor/horarios/procesar_alta_horarios.php">
                
                <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Id Trabajador</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <select name="select_id_trabajadores" id="select_id_trabajadores" class="form-control">
                                <?php
                                    while ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) { 
                                        $consultaHE = "SELECT COUNT(*) AS numero_registros FROM horarios_entrada WHERE id_trabajador = ?";
                                        $sentenciaHE = $conexionPDO->prepare($consultaHE);
                                        $sentenciaHE->execute([$row['id_trabajador']]);
                                        $rowHE = $sentenciaHE->fetch(PDO::FETCH_ASSOC);
                                        
                                        $consultaHS = "SELECT COUNT(*) AS numero_registros FROM horarios_salida WHERE id_trabajador = ?";
                                        $sentenciaHS = $conexionPDO->prepare($consultaHS);
                                        $sentenciaHS->execute([$row['id_trabajador']]);
                                        $rowHS = $sentenciaHS->fetch(PDO::FETCH_ASSOC);
                                        
                                        if ($rowHE['numero_registros']==0 and $rowHS['numero_registros']==0) {
                                            echo "<option value='" . $row['id_trabajador'] .  "'> " . $row['id_trabajador'] . " </option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="caja_lunes" class="cols-sm-2 control-label">Lunes</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">Entrada</span>
                            <input type="time" class="form-control" name="caja_lunes_entrada" id="caja_lunes_entrada" required/>
                            <span class="input-group-addon">Salida</span>
                            <input type="time" class="form-control" name="caja_lunes_salida" id="caja_lunes_salida" required/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caja_martes" class="cols-sm-2 control-label">Martes</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">Entrada</span>
                            <input type="time" class="form-control" name="caja_martes_entrada" id="caja_martes_entrada" required/>
                            <span class="input-group-addon">Salida</span>
                            <input type="time" class="form-control" name="caja_martes_salida" id="caja_martes_salida" required/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caja_miercoles" class="cols-sm-2 control-label">Miercoles</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">Entrada</span>
                            <input type="time" class="form-control" name="caja_miercoles_entrada" id="caja_miercoles_entrada" required/>
                            <span class="input-group-addon">Salida</span>
                            <input type="time" class="form-control" name="caja_miercoles_salida" id="caja_miercoles_salida" required/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caja_jueves" class="cols-sm-2 control-label">Jueves</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">Entrada</span>
                            <input type="time" class="form-control" name="caja_jueves_entrada" id="caja_jueves_entrada" required/>
                            <span class="input-group-addon">Salida</span>
                            <input type="time" class="form-control" name="caja_jueves_salida" id="caja_jueves_salida" required/>
                        </div>
                    </div>
                </div>              
                
                <div class="form-group">
                    <label for="caja_viernes" class="cols-sm-2 control-label">Viernes</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">Entrada</span>
                            <input type="time" class="form-control" name="caja_viernes_entrada" id="caja_viernes_entrada" required/>
                            <span class="input-group-addon">Salida</span>
                            <input type="time" class="form-control" name="caja_viernes_salida" id="caja_viernes_salida" required/>
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group ">
                    <button type="submit" class="btn btn-sm btn-primary btn-agregar">AGREGAR</button>
                </div>

            </form>
        </div>
    </div>
</div>
