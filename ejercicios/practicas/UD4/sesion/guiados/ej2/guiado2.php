<?php
session_start();

if (!isset($_SESSION['clicks'])) {
    $_SESSION['clicks'] = 0;
    $_SESSION['inicioTime'] = time();
}


$intervaloTime = 1; 
$tiempo_transcurrido = time();
$tiempo_maximo = $_SESSION['inicioTime'] + ($intervaloTime * 60);

if ($tiempo_transcurrido > $tiempo_maximo) {
    header("Location: salir.php");

}

 $contador=$_SESSION['clicks']++;
 $_SESSION['inicioTime'] = time(); 


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sesión con contador</title>
</head>
<body>

<h2>Contador de clicks: <?php echo $contador; ?></h2>



</body>
</html>