<?php 
/**
 * Vista de usuario y/o admin
 */

 session_start();

 if ($_SESSION["tipo"] != "user" && $_SESSION["tipo"] != "admin") {
     header("Location: ../ej2.php");
 }

echo "<h1>Bienvenido ".$_SESSION["usuario"]."</h1>";
echo "Zona para usuarios y o adminsitradores.";
echo "<button onclick='history.go(-1);'>Volver</button>";