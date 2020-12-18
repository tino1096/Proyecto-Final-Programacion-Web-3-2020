<?php 
	session_start();
    if (! $_SESSION['activa'] == true and $_SESSION['tipo_usuario']!="Administrador") {
        header("Location: ../../index.html");
    } else {
        include("../../scripts/servidor/conexion_PDO.php");
        $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");

        $consulta = "SELECT nombre, primer_apellido, segundo_apellido, puesto FROM trabajadores WHERE id_trabajador = ?";

        $usuario = $_SESSION['usuario'];

        $sentencia = $conexionPDO->prepare($consulta);
        $sentencia->execute([$usuario]);

        $row = $sentencia->fetch(PDO::FETCH_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Administración del Sistema</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../estilos/inicio.css">
    <link rel="stylesheet" href="../estilos/admin.css">
    <link rel="stylesheet" href="../estilos/tablas.css">
    
    <!-- AngularJS Single Page Application-->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
    <script src="../../scripts/cliente/spa_admin.js"></script>
    <script src="../../scripts/cliente/busqueda.js"></script>
    
    <style>
        
    </style>
</head>
<body ng-app="admin">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#admin">ADMIN</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="#trabajadores">Trabajadores</a></li>
                <li><a href="#areas">Areas</a></li>
                <li><a href="#horarios">Horarios</a></li>
                <li><a href="#registros">Registros</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../scripts/servidor/procesar_cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 tbjr">
                <h3 class="my-4 tag">Datos del Administrador</h3>
                <hr>
                <h4> <?php echo $usuario ?> </h4>
                <h4> <?php echo $row['nombre'] . " "; echo $row['primer_apellido'] . " "; echo $row['segundo_apellido'] . " "; ?> </h4>
                <h4> <?php echo $row['puesto']; ?> </h4>
                <hr>
                <?php
                    echo "<br><h4> Tipo de usuario: " . $_SESSION['tipo_usuario'] . " </h4>";  
                ?>
                <script type="text/javascript">
                    var d = new Date();
                    document.write("<hr><h4 style='font-size: 50px;'>" + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + "</h4>");
                </script>
                <a class="btn btn-default boton" href="inicio.php" role="button">Regresar</a>

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9" ng-view>
                
            </div>
            <!-- /.col-lg-9 -->

      </div>
    </div>
</body>
</html>