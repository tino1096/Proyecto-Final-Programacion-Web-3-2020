<?php 
	session_start();
    if (! $_SESSION['activa'] == true) {
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
    <title>Inicio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../estilos/inicio.css">
    <link rel="stylesheet" href="../estilos/tablas.css">
    
    <!-- AngularJS Single Page Application-->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
    <script src="../../scripts/cliente/spa.js"></script>
    
    <style>
        
    </style>
</head>
<body ng-app="spa">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#inicio">INICIO</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="#perfil">Perfil</a></li>
                <li><a href="#horario">Horario</a></li>
                <li><a href="#registros">Registros</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../scripts/servidor/procesar_cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h3 class="my-4 tag">Datos del Trabajador</h3>
                <hr>
                <h4> <?php echo $usuario ?> </h4>
                <h4> <?php echo $row['nombre'] . " "; echo $row['primer_apellido'] . " "; echo $row['segundo_apellido'] . " "; ?> </h4>
                <h4> <?php echo $row['puesto']; ?> </h4>
                <hr>
                <?php
                    if ($_SESSION['tipo_usuario']=='Administrador') {
                        echo "<h4> Tipo de usuario: <a style='font-size: 17px;' class='btn' href='menu_crud.php' role='button'>" . $_SESSION['tipo_usuario'] . " </a> </h4>";
                    } else {
                        echo "<br><h4> Tipo de usuario: " . $_SESSION['tipo_usuario'] . " </h4>";
                    }
                ?>
                <script type="text/javascript">
                    var d = new Date();
                    document.write("<hr><h4 style='font-size: 50px;'>" + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + "</h4>");
                </script>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9" ng-view>
                
            </div>
            <!-- /.col-lg-9 -->

      </div>
    </div>
</body>
</html>