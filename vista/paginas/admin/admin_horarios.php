<?php 
	session_start();
    if (! $_SESSION['activa'] == true and $_SESSION['tipo_usuario']!="Administrador") {
        header("Location: ../../../index.html");
    } else {
        include("../../../scripts/servidor/conexion_PDO.php");
        $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
        
        //Vista de la base de datos
        $consultaEntrada = "SELECT * FROM registros_horarios_entrada";
        $consultaSalida = "SELECT * FROM registros_horarios_salida";
                
        $sentenciaEntrada = $conexionPDO->prepare($consultaEntrada);
        $sentenciaEntrada->execute([]);
        
        $sentenciaSalida = $conexionPDO->prepare($consultaSalida);
        $sentenciaSalida->execute([]);
    }
?>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../../../scripts/cliente/busqueda.js"></script>

<div class="card mt-4">
    <div class="card-body">
        
        <label class="cols-sm-2 control-label">Buscar horario</label>
        <input class="form-control" id="caja_busqueda" type="text" placeholder="Escriba el atributo del horario">
        <br>
        
        <h2> Horarios de entrada: </h2>
        <table>
            <thead>
                <tr>
                    <th>ID Trabajador</th>
                    <th>Nombre</th>
                    <th>Primer apellido</th>
                    <th>Segundo apellido</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="registros">
                <?php
                    while ($rowEntrada = $sentenciaEntrada->fetch(PDO::FETCH_ASSOC)) { 
                        echo "<tr>";
                        foreach ($rowEntrada as $campo=>$dato) {
                            echo "<td>$dato</td>";
                        }

                        $cadenaGetEntrada = "?id=" . $rowEntrada['id_trabajador'] . "&lunes_entrada=" . $rowEntrada['lunes'] . "&martes_entrada=" . $rowEntrada['martes'] . "&miercoles_entrada=" . $rowEntrada['miercoles'] . "&jueves_entrada=" . $rowEntrada['jueves'] . "&viernes_entrada=" . $rowEntrada['viernes'];
                        
                        echo "<td> <a href='editar/editar_horario_entrada.php" . $cadenaGetEntrada . "' style = 'color:blue'><i class='fas fa-edit'></i></a> </td>";
                        echo "<td> <a href='../../scripts/servidor/horarios/procesar_baja_horarios.php?id=" . $rowEntrada['id_trabajador'] . "' onclick='return confirm(\"¿Estas seguro de que quieres eliminar este registro?. También se eliminará el horario de salida correspondiente\");' style = 'color:red'><i class='fas fa-minus-circle'></i></a> </td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <br>
        <hr>
        <br>
        
        <h2> Horarios de Salida: </h2>
        <table>
            <thead>
                <tr>
                    <th>ID Trabajador</th>
                    <th>Nombre</th>
                    <th>Primer apellido</th>
                    <th>Segundo apellido</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="registros">
                <?php
                    while ($rowSalida = $sentenciaSalida->fetch(PDO::FETCH_ASSOC)) { 
                        echo "<tr>";
                        foreach ($rowSalida as $campo=>$dato) {
                            echo "<td>$dato</td>";
                        }

                        $cadenaGetSalida = "?id=" . $rowSalida['id_trabajador'] . "&lunes_salida=" . $rowSalida['lunes'] . "&martes_salida=" . $rowSalida['martes'] . "&miercoles_salida=" . $rowSalida['miercoles'] . "&jueves_salida=" . $rowSalida['jueves'] . "&viernes_salida=" . $rowSalida['viernes'];
                        
                        echo "<td> <a href='editar/editar_horario_salida.php" . $cadenaGetSalida . "' style = 'color:blue'><i class='fas fa-edit'></i></a> </td>";
                        echo "<td> <a href='../../scripts/servidor/horarios/procesar_baja_horarios.php?id=" . $rowSalida['id_trabajador'] . "' onclick='return confirm(\"¿Estas seguro de que quieres eliminar este registro?. También se eliminará el horario de entrada correspondiente\");' style = 'color:red'><i class='fas fa-minus-circle'></i></a> </td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <br>
        <a class="btn btn-primary btn-agregar" href="#agregar_horario" role="button">AÑADIR HORARIO</a>

    </div>
</div>