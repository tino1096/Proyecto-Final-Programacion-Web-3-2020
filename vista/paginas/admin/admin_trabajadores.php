<?php 
	session_start();
    if (! $_SESSION['activa'] == true and $_SESSION['tipo_usuario']!="Administrador") {
        header("Location: ../../../index.html");
    } else {
        include("../../../scripts/servidor/conexion_PDO.php");
        $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
        
        //Vista de la base de datos
        $consulta = "SELECT * FROM registros_trabajadores";
                
        $sentencia = $conexionPDO->prepare($consulta);
        $sentencia->execute([]);
    }
?>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../../../scripts/cliente/busqueda.js"></script>
    
<div class="card mt-4">
    <div class="card-body">
        
        <label class="cols-sm-2 control-label">Buscar</label>
        <input class="form-control" id="caja_busqueda" type="text" placeholder="Escriba el atributo del trabajador">
        <br>
        
        <h2> Trabajadores </h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Primer apellido</th>
                    <th>Segundo apellido</th>
                    <th>Sexo</th>
                    <th>Fecha de nacimiento</th>
                    <th>Calle</th>
                    <th>#</th>
                    <th>Colonia</th>
                    <th>Código postal</th>
                    <th>Ciudad</th>
                    <th>Puesto</th>
                    <th>Área</th>
                    <th>Subarea</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="registros">
                <?php
                    while ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) { 
                        echo "<tr>";
                        foreach ($row as $campo=>$dato) {
                            echo "<td>$dato</td>";
                        }

                        $cadenaGet = "?id=" . $row['id_trabajador'] . "&nombre=" . $row['nombre'] . "&primer_ap=" . $row['primer_apellido'] . "&segundo_ap=" . $row['segundo_apellido'] . "&sexo=" . $row['sexo'] . "&fecha_nac=" . $row['fecha_nacimiento'] . "&calle=" . $row['calle'] . "&numero=" . $row['numero'] . "&colonia=" . $row['colonia'] . "&codigo_postal=" . $row['codigo_postal'] . "&ciudad=" . $row['ciudad'] . "&puesto=" . $row['puesto'] . "&area=" . $row['area'] . "&subarea=" . $row['subarea'];
                        
                        echo "<td> <a href='editar/editar_trabajador.php" . $cadenaGet . "' style = 'color:blue'><i class='fas fa-edit'></i></a> </td>";
                        echo "<td> <a href='../../scripts/servidor/trabajadores/procesar_baja_trabajador.php?id=" . $row['id_trabajador'] . "' style = 'color:red' onclick='return confirm(\"¿Estas seguro de que quieres eliminar este registro?\");'><i class='fas fa-minus-circle'></i></a> </td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <br>
        <a class="btn btn-primary btn-agregar" href="#agregar_trabajador" role="button">AÑADIR TRABAJADOR</a>

    </div>
</div>