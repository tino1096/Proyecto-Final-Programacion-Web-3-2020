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
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Editar Trabajadores</title>
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
    <style>  
        body {
            border-top: 50px solid #5e2129;
        }
        
        .container {
            width: 70%;
            padding: 0 10%;
        }
        
        .btn-agregar {
            padding: 10px 10px 10px 10px;
            font-size: 15px;
        }
    </style>
</head>
    
<body>
<div class="container">
    <div class="row main">
        <div class="main-login main-center">
            <h2>Editar trabajador</h2>
            <form class="" method="post" action="../../../scripts/servidor/trabajadores/procesar_cambio_trabajador.php">
                
                <div class="form-group">
                    <label for="caja_id_trabajador" class="cols-sm-2 control-label">Id del Trabajador</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_id_trabajador" id="caja_id_trabajador" required value="<?php echo $_GET['id']; ?>" readonly/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caja_nombre" class="cols-sm-2 control-label">Nombre</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_nombre" id="caja_nombre" required value="<?php echo $_GET['nombre']; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caja_primer_ap" class="cols-sm-2 control-label">Primer Apellido</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_primer_ap" id="caja_primer_ap" required value="<?php echo $_GET['primer_ap']; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caja_segundo_ap" class="cols-sm-2 control-label">Segundo Apellido</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_segundo_ap" id="caja_segundo_ap" required value="<?php echo $_GET['segundo_ap']; ?>"/>
                        </div>
                    </div>
                </div>              
                
                <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Sexo</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <?php
                                $sexo = array("radio_hombre"=> "Hombre",
                                                  "radio_mujer"=> "Mujer");

                                foreach ($sexo as $clave => $valor) {
                                    echo "<label for='" . $clave . "' class='checkbox-inline'>";
                                        echo "<input type='radio'  name='radio_sexo' id='" . $clave . "' value='" . $valor . "' required ";
                                        if ($_GET['sexo']==$valor) {
                                            echo "checked";
                                        }
                                        echo ">" . $valor;
                                    echo "</label>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="caja_fecha_nac" class="cols-sm-2 control-label">Fecha de Nacimiento</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="date" name="caja_fecha_nac" id="caja_fecha_nac" class="form-control form-control-sm" value="<?php echo $_GET['fecha_nac']; ?>" required="required" title="date">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="caja_calle" class="cols-sm-2 control-label">Calle</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_calle" id="caja_calle" required value="<?php echo $_GET['calle']; ?>"/>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="caja_numero" class="cols-sm-2 control-label">Numero</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" name="caja_numero" id="caja_numero" required value="<?php echo $_GET['numero']; ?>"/>
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
                                        echo "<option value='" . $rowColonia['colonia'] .  "' "; 
                                        if ($_GET['colonia']==$rowColonia['colonia']) {
                                            echo "selected";
                                        }
                                        echo "> " . $rowColonia['colonia'] . " </option>";
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
                            <input type="text" class="form-control" name="caja_codigo_postal" id="caja_codigo_postal" required value="<?php echo $_GET['codigo_postal']; ?>"/>
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
                                        echo "<option value='" . $rowCiudad['ciudad'] .  "' ";
                                        if ($_GET['ciudad']==$rowCiudad['ciudad']) {
                                            echo "selected";
                                        }
                                        echo "> " . $rowCiudad['ciudad'] . " </option>";
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
                                <?php
                                    $puestos = array("Empleado"=> "Empleado",
                                                      "Recepcionista"=> "Recepcionista",
                                                      "Operativa"=> "Operativa",
                                                      "Pozero"=> "Pozero",
                                                      "Jefe de departamento"=> "Jefe de departamento",
                                                      "Director Simapaj"=> "Director Simapaj");
                                
                                    foreach ($puestos as $clave => $valor) {
                                        echo "<option value='" . $valor . "' ";
                                        if ($_GET['puesto'] == $valor) { 
                                            echo "selected";
                                        }
                                        echo ">" . $clave . "</option>";
                                    }
                                ?>
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
                                <?php
                                    $areas = array("Operativa"=> "Operativa",
                                                      "Departamento"=> "Departamento",
                                                      "Direccion"=> "Direccion");
                                
                                    foreach ($areas as $clave => $valor) {
                                        echo "<option value='" . $valor . "' ";
                                        if ($_GET['area'] == $valor) { 
                                            echo "selected";
                                        }
                                        echo ">" . $clave . "</option>";
                                    }
                                ?>
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
                
                <div class="form-group ">
                    <button type="submit" class="btn btn-sm btn-primary btn-agregar">MODIFICAR</button>
                    <a class="btn btn-lg btn-default" href="../menu_crud.php#/trabajadores" role="button" style="float: right;">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
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
</body>
</html>