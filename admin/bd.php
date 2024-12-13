<?php

$servidor="localhost";
$baseDatos="restaurante";
$usuario="root";
$contrasenia="";

try{

    $conexion= new PDO("mysql:host=$servidor; dbname=$baseDatos", $usuario, $contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $error){
    echo 'Error: ', $error->getMessage();
}

?>