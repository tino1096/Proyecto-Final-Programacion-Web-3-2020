<?php
    function conexionPDO($u, $p, $db) {
        try {
            $dsn = "mysql:host=localhost;dbname=" . $db;
            $connection = new PDO($dsn, $u, $p);
            return $connection;
        } catch (PDOException $pdoe) {
           error_log($pdeo->getMessage()); 
        }
    }
?>