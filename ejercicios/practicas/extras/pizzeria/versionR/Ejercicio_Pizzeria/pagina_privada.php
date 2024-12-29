<?php
session_start();
if ($_SESSION['usuario'] != "Administrador"){
    header("location: index.php");
}

if (isset($_POST['volver'])){
    header("location: index.php");
}

// Ruta de la carpeta donde se encuentran los archivos .txt // Cambia esto por la ruta de tu carpeta
$aPendientes = $aElaborados = "";
$directorio = "comandas/";
// Función para mover y renombrar los archivos
function completarComanda($archivo) {
    $directorio = "comandas/";
    // Generar el nuevo nombre del archivo (cambiar "pendiente" por "completada")
    $nuevoNombre = str_replace("pendiente", "completada", $archivo);

    // Renombrar el archivo
    if (rename($directorio . $archivo, $directorio . $nuevoNombre)) {
        echo "Comanda completada con éxito.";
    } else {
        echo "Hubo un error al completar la comanda.";
    }
}

// Si se recibe la acción para completar una comanda
if (isset($_GET['completar'])) {
    $comanda = $_GET['completar']; // Obtener el archivo a completar
    completarComanda($comanda); // Cambiar el estado de la comanda
}

// Obtener todos los archivos en la carpeta
$archivos = scandir($directorio);

// Filtrar los archivos para obtener solo los que terminan con ".txt"
$archivos_txt = array_filter($archivos, function($archivo) {
    return pathinfo($archivo, PATHINFO_EXTENSION) == 'txt';
});

// Mostrar los archivos encontrados
if (!empty($archivos_txt)) {
    foreach ($archivos_txt as $archivo) {
        $valor = explode("_", $archivo);
        if ($valor[2] == "pendiente.txt") {
            $aPendientes .= "<li><a href='?completar=" . $archivo . "'>" . $archivo . "</a></li>";
        } else {
            $aElaborados .= "<li>" . $archivo . "</li>";
        }
    }
} else {
    echo "No se encontraron archivos .txt en la carpeta.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de comandas</title>
</head>
<body>
    <h1>Comandas</h1>
    <h3>Comandas pendientes</h3>
    <ul>
        <?php echo $aPendientes; ?>
    </ul>

    <h3>Comandas elaboradas</h3>
    <ul>
        <?php echo $aElaborados; ?>
    </ul>
    <form action="" method="post">
        <button type="submit" name="volver">Volver a inicio</button>
    </form>
</body>
</html>
