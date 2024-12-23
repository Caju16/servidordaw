<?php
// Verificar si se pasó el nombre del archivo como parámetro
if (isset($_GET['archivo'])) {
    // Obtener el nombre del archivo
    $archivo = $_GET['archivo'];
    $ruta_archivo = "tickets/" . $archivo;

    // Verificar si el archivo existe
    if (file_exists($ruta_archivo)) {
        // Establecer los encabezados adecuados para la descarga
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream'); // Tipo de contenido para forzar la descarga
        header('Content-Disposition: attachment; filename="' . basename($ruta_archivo) . '"'); // Nombre del archivo para la descarga
        header('Content-Length: ' . filesize($ruta_archivo)); // Longitud del archivo
        header('Pragma: public');
        header('Cache-Control: must-revalidate');
        header('Expires: 0');

        // Limpiar cualquier salida previa
        ob_clean();
        flush();

        // Leer el archivo y enviarlo al navegador
        readfile($ruta_archivo);
        exit;
    } else {
        // Si el archivo no existe
        echo "El archivo no existe.";
    }
} else {
    echo "No se especificó un archivo.";
}
?>
