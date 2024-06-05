<?php 

session_start();
session_destroy();
header("location:login.php");
echo "Salir o cerrar sesión...";

?>