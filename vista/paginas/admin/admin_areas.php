<?php 
	session_start();
    if (! $_SESSION['activa'] == true and $_SESSION['tipo_usuario']!="Administrador") {
        header("Location: ../../../index.html");
    } else {
        include("../../../scripts/servidor/conexion_PDO.php");
        $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
        
        //Vista de la base de datos
        $consulta = "SELECT * FROM areas";
                
        $sentencia = $conexionPDO->prepare($consulta);
        $sentencia->execute([]);
    }
?>

<div class="card mt-4">
    <div class="card-body">
        
        <label for="caja_id_trabajador" class="cols-sm-2 control-label">Buscar</label>
        <br>
        
        <h2> Areas </h2>
        <table>
            <thead>
                <tr>
                    <th>Área</th>
                    <th>Subarea</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) { 
                        echo "<tr>";
                        foreach ($row as $campo=>$dato) {
                            echo "<td>$dato</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

    </div>
</div>