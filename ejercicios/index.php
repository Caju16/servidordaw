<?php
// index.php

// Cargar la configuración desde config.php
$estructura = require __DIR__ . '/conf/config.php';

// Función para determinar la clase CSS según el tipo de archivo o carpeta
function determinarClase($item) {
    if (isset($item['contenido'])) {
        return 'carpeta';
    }
    $ext = pathinfo($item['nombre'], PATHINFO_EXTENSION);
    switch ($ext) {
        case 'html':
            return 'archivo-html';
        case 'css':
            return 'archivo-css';
        case 'php':
            return 'archivo-php';
        case 'js':
            return 'archivo-js';
        default:
            return 'archivo-otros';
    }
}

// Función para mostrar iconos junto al texto
function insertarIcono($clase) {
    switch ($clase) {
        case 'carpeta':
            return '<span class="icono">📁</span>';
        case 'archivo-html':
            return '<span class="icono">🌐</span>';
        case 'archivo-css':
            return '<span class="icono">🎨</span>';
        case 'archivo-php':
            return '<span class="icono">🐘</span>';
        case 'archivo-js':
            return '<span class="icono">📜</span>';
        default:
            return '<span class="icono">❓</span>';
    }
}

// Función para mostrar la estructura en forma de árbol
function mostrarEstructura($estructura) {
    echo '<ul>';
    foreach ($estructura as $item) {
        $clase = determinarClase($item);
        $icono = insertarIcono($clase); // Obtener icono asociado
        echo '<li class="' . htmlspecialchars($clase) . '" data-ruta="' . htmlspecialchars($item['ruta']) . '">';
        if (isset($item['contenido'])) {
            // Carpeta: Mostrar nombre con icono y contenido oculto
            echo $icono . htmlspecialchars($item['nombre']);
            echo '<div class="contenido-oculto">'; // Contenido inicial oculto
            mostrarEstructura($item['contenido']);
            echo '</div>';
        } else {
            // Archivo: Mostrar nombre con icono
            echo $icono . htmlspecialchars($item['nombre']);
        }
        echo '</li>';
    }
    echo '</ul>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios Indexados</title>
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<body>
    <h1>Directorio de Ejercicios</h1>
    <?php
    // Mostrar la estructura indexada
    mostrarEstructura($estructura);
    ?>

    <!-- JavaScript para manejar la interacción -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Seleccionar todos los elementos <li>
            const elementos = document.querySelectorAll('li');

            elementos.forEach(li => {
                li.addEventListener('click', function(e) {
                    // Evitar propagación de clics a niveles superiores
                    e.stopPropagation();

                    const ruta = this.getAttribute('data-ruta');

                    if (this.classList.contains('carpeta')) {
                        // Expandir o colapsar carpetas
                        this.classList.toggle('expandido');

                        const contenido = this.querySelector('.contenido-oculto');
                        if (contenido) {
                            contenido.style.display = contenido.style.display === 'block' ? 'none' : 'block';
                        }
                    } else if (ruta) {
                        // Abrir archivos en una nueva pestaña
                        window.open('/' + ruta, '_blank');
                    }
                });
            });
        });
    </script>
</body>
</html>
