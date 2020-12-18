<?php
    session_start();
    include("conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
    $consulta = "SELECT * FROM usuarios WHERE user = ? AND password = SHA(?)";
    
    $user = $_POST['caja_user'];
    $password = $_POST['caja_password'];

    $sentencia = $conexionPDO->prepare($consulta);
    $sentencia->execute([$user, $password]);

    if (empty($user) or empty($password)) {
        header("Location: ../../index.html");
    } else {
        $row = $sentencia->fetch(PDO::FETCH_ASSOC);
        if ($user==$row['user'] and sha1($password)==$row['password']) {
            $_SESSION['activa'] = true;
            $_SESSION['usuario'] = $user;
            $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
            header("Location: ../../vista/paginas/inicio.php");
        } else {
            header("Location: ../../index.html");
        }
    }

    $sentencia = null;
?>