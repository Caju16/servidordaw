<?php
// conf/config.php

function indexarCarpetas($directorioBase, $rutaBase = '') {
    // Array donde se almacenarán todas las carpetas y archivos.
    $indexado = [];

    // Recorrer el directorio base.
    $archivos = scandir($directorioBase);
    foreach ($archivos as $archivo) {
        // Ignorar los directorios "." y "..".
        if ($archivo === '.' || $archivo === '..') {
            continue;
        }

        $rutaCompleta = $directorioBase . DIRECTORY_SEPARATOR . $archivo;
        $rutaRelativa = ltrim($rutaBase . '/' . $archivo, '/'); // Eliminar la duplicación de ruta base.

        if (is_dir($rutaCompleta)) {
            // Si es una carpeta, indexar recursivamente.
            $indexado[] = [
                'nombre' => $archivo,
                'ruta' => $rutaRelativa,
                'contenido' => indexarCarpetas($rutaCompleta, $rutaRelativa)
            ];
        } else {
            // Si es un archivo, añadirlo al array.
            $indexado[] = [
                'nombre' => $archivo,
                'ruta' => $rutaRelativa
            ];
        }
    }

    return $indexado;
}

// Ruta base (ajusta esta ruta según tu servidor)
$directorioBase = __DIR__ . '/../';
$rutaBase = 'ejercicios'; // Ruta relativa desde el navegador.

// Indexar todas las carpetas y archivos en "ejercicios".
$estructura = indexarCarpetas($directorioBase, $rutaBase);

// Retornar el array para su uso en otros archivos.
return $estructura;
