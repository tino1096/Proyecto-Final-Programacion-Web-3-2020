<?php 
	session_start();
    if (! $_SESSION['activa'] == true) {
        header("Location: ../../index.html");
    } else {
        include("../../scripts/servidor/conexion_PDO.php");
        $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
                    
        $consultaEntrada = "SELECT lunes, martes, miercoles, jueves, viernes FROM horarios_entrada WHERE id_trabajador = ?";
        $consultaSalida = "SELECT lunes, martes, miercoles, jueves, viernes FROM horarios_salida WHERE id_trabajador = ?";
        
        $usuario = $_SESSION['usuario'];
                
        $sentenciaEntrada = $conexionPDO->prepare($consultaEntrada);
        $sentenciaEntrada->execute([$usuario]);
        
        $sentenciaSalida = $conexionPDO->prepare($consultaSalida);
        $sentenciaSalida->execute([$usuario]);

        $rowEntrada = $sentenciaEntrada->fetch(PDO::FETCH_ASSOC);
        $rowSalida = $sentenciaSalida->fetch(PDO::FETCH_ASSOC);
    }
?>

<div class="card mt-4 center">
    <div class="card-body">
        <h2> Horario Entrada</h2>
        <table>
            <thead>
                <tr>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                        if ($rowEntrada!=null) {
                            foreach ($rowEntrada as $campo=>$dato) {
                                echo "<td>$dato</td>";
                            }
                        }
                    ?>
                </tr>
            </tbody>
        </table>
        
        <h2> Horario Salida</h2>
        <table>
            <thead>
                <tr>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    
                        if ($rowEntrada!=null) {
                            foreach ($rowSalida as $campo=>$dato) {
                                echo "<td>$dato</td>";
                            }
                        }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

