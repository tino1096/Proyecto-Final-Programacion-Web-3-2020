<?php 
    include("../scripts/servidor/conexion_PDO.php");
    $conexionPDO = conexionPDO("Faustino", "1tino1", "bdsimapaj");
            
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$cadena_json = file_get_contents('php://input'); //Recibe información por HTTP
		$datos = json_decode($cadena_json, true);

		$user = $datos['user'];
		$password = $datos['password'];

        $consulta = "SELECT * FROM usuarios WHERE user = ? AND password = SHA(?);";

        $sentencia = $conexionPDO->prepare($consulta);
        $sentencia->execute([$user, $password]);
        
        $respuesta['usuario'] = array();

        $usuario = array();
        
        $row = $sentencia->fetch(PDO::FETCH_ASSOC);
        if ($user==$row['user'] and sha1($password)==$row['password']) {
            $usuario['user'] = $row['user'];
            $usuario['password'] = $password;
            $usuario['tipo_usuario'] = $row['tipo_usuario'];
            $respuesta['exito'] = true;
        } else {
            $usuario['user'] = $row['user'];
            $usuario['password'] = $row['password'];
            $respuesta['exito'] = false;
        }

        array_push($respuesta['usuario'], $usuario);

        echo json_encode($respuesta);
    }
 ?>