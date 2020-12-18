<?php 
	session_start();
    if (! $_SESSION['activa'] == true and $_SESSION['tipo_usuario']!="Administrador") {
        header("Location: ../../../index.html");
    } else {
        include("../../../scripts/servidor/conexion_PDO.php");
        $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
        
        //Vista de la base de datos
        $consultaEntrada = "SELECT * FROM vista_registros_entrada";
        $consultaSalida = "SELECT * FROM vista_registros_salida";
                
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
        
        <label class="cols-sm-2 control-label">Buscar registros</label>
        <input class="form-control" id="caja_busqueda" type="text" placeholder="Escriba el atributo del registro">
        <br>
        
        <h2> Registros de entrada </h2>
        <table>
            <thead>
                <tr>
                    <th>ID Trabajador</th>
                    <th>Nombre</th>
                    <th>Primer apellido</th>
                    <th>Segundo apellido</th>
                    <th>Hora</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id="registros">
                <?php
                    while ($rowEntrada = $sentenciaEntrada->fetch(PDO::FETCH_ASSOC)) { 
                        echo "<tr>";
                        foreach ($rowEntrada as $campo=>$dato) {
                            echo "<td>$dato</td>";
                        }

                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <br>
        <hr>
        <br>
        
        <h2> Registros de Salida </h2>
        <table>
            <thead>
                <tr>
                    <th>ID Trabajador</th>
                    <th>Nombre</th>
                    <th>Primer apellido</th>
                    <th>Segundo apellido</th>
                    <th>Hora</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id="registros">
                <?php
                    while ($rowSalida = $sentenciaSalida->fetch(PDO::FETCH_ASSOC)) { 
                        echo "<tr>";
                        foreach ($rowSalida as $campo=>$dato) {
                            echo "<td>$dato</td>";
                        }
                        
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <br>

    </div>
</div>