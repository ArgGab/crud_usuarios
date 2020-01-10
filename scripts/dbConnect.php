<?php

    $dsn = "mysql:dbname=crud_total_control;host=localhost";
    $user = "root";
    $pass = "";

    try{

        $pdo = new PDO($dsn, $user, $pass);

    }catch(PDOExceptions $e){

        echo "ERRO: ".$e->getMessage();

    }

?>