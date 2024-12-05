<?php 


session_start();
if (!isset($_SESSION['nombre'])) {
    $_SESSION['nombre'] = 'Miguel';
    $_SESSION['apellidos'] = 'Carmona';
}



?>