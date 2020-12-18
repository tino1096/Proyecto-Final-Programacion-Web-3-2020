<?php 
	session_start();
    if (! $_SESSION['activa'] == true and $_SESSION['tipo_usuario']!="Administrador") {
        header("Location: ../../../index.html");
    } 
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Editar Horario de Salida</title>
    
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
            <h2>Editar horario de salida</h2>
            <form class="" method="post" action="../../../scripts/servidor/horarios/procesar_cambio_horario_salida.php">
                
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
                    <label for="caja_lunes" class="cols-sm-2 control-label">Lunes</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">Entrada</span>
                            <input type="time" class="form-control" name="caja_lunes_entrada" id="caja_lunes_entrada" required value="<?php echo $_GET['lunes_entrada']; ?>" readonly/>
                            <span class="input-group-addon">Salida</span>
                            <input type="time" class="form-control" name="caja_lunes_salida" id="caja_lunes_salida" required value="<?php echo $_GET['lunes_salida']; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caja_martes" class="cols-sm-2 control-label">Martes</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">Entrada</span>
                            <input type="time" class="form-control" name="caja_martes_entrada" id="caja_martes_entrada" required value="<?php echo $_GET['martes_entrada']; ?>" readonly/>
                            <span class="input-group-addon">Salida</span>
                            <input type="time" class="form-control" name="caja_martes_salida" id="caja_martes_salida" required value="<?php echo $_GET['martes_salida']; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caja_miercoles" class="cols-sm-2 control-label">Miercoles</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">Entrada</span>
                            <input type="time" class="form-control" name="caja_miercoles_entrada" id="caja_miercoles_entrada" required value="<?php echo $_GET['miercoles_entrada']; ?>" readonly/>
                            <span class="input-group-addon">Salida</span>
                            <input type="time" class="form-control" name="caja_miercoles_salida" id="caja_miercoles_salida" required value="<?php echo $_GET['miercoles_salida']; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caja_jueves" class="cols-sm-2 control-label">Jueves</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">Entrada</span>
                            <input type="time" class="form-control" name="caja_jueves_entrada" id="caja_jueves_entrada" required value="<?php echo $_GET['jueves_entrada']; ?>" readonly/>
                            <span class="input-group-addon">Salida</span>
                            <input type="time" class="form-control" name="caja_jueves_salida" id="caja_jueves_salida" required value="<?php echo $_GET['jueves_salida']; ?>"/>
                        </div>
                    </div>
                </div>              
                
                <div class="form-group">
                    <label for="caja_viernes" class="cols-sm-2 control-label">Viernes</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">Entrada</span>
                            <input type="time" class="form-control" name="caja_viernes_entrada" id="caja_viernes_entrada" required value="<?php echo $_GET['viernes_entrada']; ?>" readonly/>
                            <span class="input-group-addon">Salida</span>
                            <input type="time" class="form-control" name="caja_viernes_salida" id="caja_viernes_salida" required value="<?php echo $_GET['viernes_salida']; ?>"/>
                        </div>
                    </div>
                </div>
                
                <div class="form-group ">
                    <button type="submit" class="btn btn-sm btn-primary btn-agregar">MODIFICAR</button>
                    <a class="btn btn-lg btn-default" href="../menu_crud.php#/horarios" role="button" style="float: right;">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>