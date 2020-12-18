<?php 
	session_start();
    if (! $_SESSION['activa'] == true) {
        header("Location: ../../index.html");
    } else {
        include("../../scripts/servidor/conexion_PDO.php");
        $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
        
        $consultaEntrada = "SELECT hora, fecha FROM registros_entrada WHERE id_trabajador = ?";
        $consultaSalida = "SELECT hora, fecha FROM registros_salida WHERE id_trabajador = ?";
        
        $usuario = $_SESSION['usuario'];
                
        $sentenciaEntrada = $conexionPDO->prepare($consultaEntrada);
        $sentenciaEntrada->execute([$usuario]);
        
        $sentenciaSalida = $conexionPDO->prepare($consultaSalida);
        $sentenciaSalida->execute([$usuario]);
    }
?>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../../../scripts/cliente/busqueda.js"></script>

<div class="card mt-4 center">
    <div class="card-body">
        
        <label class="cols-sm-2 control-label">Buscar registros</label>
        <input class="form-control" id="caja_busqueda" type="text" placeholder="Escriba el atributo del registro">
        <br>
        
        <h2> Registros Entrada</h2>
        <table>
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id="registros">
                <?php
                    while($rowEntrada = $sentenciaEntrada->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        foreach ($rowEntrada as $campo=>$dato) {
                            echo "<td>$dato</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        
        <h2> Registros Salida</h2>
        <table>
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id="registros">
                <?php
                    while($rowSalida = $sentenciaSalida->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        foreach ($rowSalida as $campo=>$dato) {
                            echo "<td>$dato</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

    </div>
</div>
<!-- /.card -->
