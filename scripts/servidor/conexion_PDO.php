
<!-- PHP CON PDO para la conexion y manejo de BD.-->
<?php
    function conexionPDO($u, $p, $db) {
        $u = "id15799552_faustino";
        $p = "^w2N1Tp_TQH9}NW#";
        $db = "id15799552_bdsimapaj";
        try {
            $dsn = "mysql:host=localhost;dbname=" . $db;
            $connection = new PDO($dsn, $u, $p);
            return $connection;
        } catch (PDOException $pdoe) {
           error_log($pdoe->getMessage()); 
        }
    }
?>