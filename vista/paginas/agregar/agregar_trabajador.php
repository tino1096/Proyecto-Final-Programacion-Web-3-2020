<?php 
	session_start();
    if (! $_SESSION['activa'] == true and $_SESSION['tipo_usuario']!="Administrador") {
        header("Location: ../../../index.html");
    } else {
        include("../../../scripts/servidor/conexion_PDO.php");
        $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
        
        $consultaColonia = "SELECT colonia FROM colonias";
        $consultaCiudad = "SELECT ciudad FROM ciudades";
                
        $sentenciaColonia = $conexionPDO->prepare($consultaColonia);
        $sentenciaColonia->execute([]);
        
        $sentenciaCiudad = $conexionPDO->prepare($consultaCiudad);
        $sentenciaCiudad->execute([]);
    }
?>

<div class="container">
    <div class="row main">
        <div class="main-login main-center">
            <h2>Ingrese los datos del trabajador</h2>
            <form method="post" action="../../scripts/servidor/trabajadores/procesar_alta_trabajador.php">
                
                <div class="form-group">
                    <label for="caja_id_trabajador" class="cols-sm-2 control-label">Id del Trabajador</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_id_trabajador" id="caja_id_trabajador" required placeholder="ej. TB01"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caja_nombre" class="cols-sm-2 control-label">Nombre</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_nombre" id="caja_nombre" required placeholder="ej. Faustino"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caja_primer_ap" class="cols-sm-2 control-label">Primer Apellido</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_primer_ap" id="caja_primer_ap" required placeholder="ej. Hidalgo"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caja_segundo_ap" class="cols-sm-2 control-label">Segundo Apellido</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_segundo_ap" id="caja_segundo_ap" required placeholder="ej. Calderon"/>
                        </div>
                    </div>
                </div>              
                
                <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Sexo</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <label for="radio_hombre" class="checkbox-inline">
                                <input type="radio"  name="radio_sexo" id="radio_hombre" value="Hombre" required> Hombre
                            </label>
                            <label for="radio_mujer" class="checkbox-inline">
                                <input type="radio" name="radio_sexo" id="radio_mujer" value="Mujer"> Mujer
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="caja_fecha_nac" class="cols-sm-2 control-label">Fecha de Nacimiento</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="date" name="caja_fecha_nac" id="caja_fecha_nac" class="form-control form-control-sm" value="" required="required" title="date">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="caja_calle" class="cols-sm-2 control-label">Calle</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_calle" id="caja_calle" required placeholder="ej. Mina"/>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="caja_numero" class="cols-sm-2 control-label">Numero</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_numero" id="caja_numero" required placeholder="ej. 26"/>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Colonia </label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <select name="select_colonia" class="form-control">
                                <option value="NULL"> Seleccione una colonia </option>
                                <?php
                                    while ($rowColonia = $sentenciaColonia->fetch(PDO::FETCH_ASSOC)) { 
                                        echo "<option value='" . $rowColonia['colonia'] .  "'> " . $rowColonia['colonia'] . " </option>";

                                    }
                                ?>
                            </select>
                            
                            <span class="input-group-addon">Otra </span>
                            <input type="text" class="form-control" name="caja_colonia" id="caja_colonia" placeholder="Escribe tu colonia aquí"/>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="caja_codigo_postal" class="cols-sm-2 control-label">Código postal</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_codigo_postal" id="caja_codigo_postal" required placeholder="ej. 99300"/>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Ciudad </label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <select name="select_ciudad" class="form-control">
                                <option value="NULL"> Seleccione una ciudad </option>
                                <?php
                                    while ($rowCiudad = $sentenciaCiudad->fetch(PDO::FETCH_ASSOC)) { 
                                        echo "<option value='" . $rowCiudad['ciudad'] .  "'> " . $rowCiudad['ciudad'] . " </option>";

                                    }
                                ?>
                            </select>
                            
                            <span class="input-group-addon">Otra </span>
                            <input type="text" class="form-control" name="caja_ciudad" id="caja_ciudad" placeholder="Escribe tu ciudad aquí"/>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Puesto</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <select name="select_puesto" class="form-control">
                                <option value="Empleado">Empleado</option>
                                <option value="Recepcionista">Recepcionista</option>
                                <option value="Operativa">Operativa</option>
                                <option value="Pozero">Pozero</option>
                                <option value="Jefe de Departamento">Jefe de departamento</option>
                                <option value="Director Simapaj">Director Simapaj</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Área</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <select name="select_area" id="select_area" class="form-control">
                                <option value="Operativa">Operativa</option>
                                <option value="Departamento">Departamento</option>
                                <option value="Direccion">Direccion</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Subarea</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <select name="select_subarea" id="select_subarea" class="form-control">
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <h2>Usuario</h2>
                
                <div class="form-group">
                    <label for="caja_password" class="cols-sm-2 control-label">Ingrese contraseña por defecto</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_password" id="caja_password" required placeholder=""/>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Tipo de usuario</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <select name="select_tipo_usuario" id="select_tipo_usuario" class="form-control">
                                <option value="Simple">Simple</option>
                                <option value="Administrador">Administrador</option>
                            </select>
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
    <!-- /.card -->
    
<script>
    var options = {
        Operativa : ["Fugas", "Pozos", "Recepcionista", "Empleado"],
        Departamento : ["Finanzas", "Materiales"],
        Direccion : ["Jefe de departamento", "Subdirector", "Director Simapaj"]
    }

    $(function() {
        var fillSecondary = function() {
            var selected = $('#select_area').val();
            $('#select_subarea').empty();
            options[selected].forEach(function(element,index){
                $('#select_subarea').append('<option value="'+element+'">'+element+'</option>');
            });
        }
        $('#select_area').change(fillSecondary);
        fillSecondary();
    });
</script>
