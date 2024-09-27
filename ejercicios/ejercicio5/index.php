<?php
// Definir el rol: puede ser 'usuario' o 'admin'
$rol = "admin"; // Puedes cambiar esto a "usuario" para probar la otra opción

// Mostrar el mensaje de bienvenida
echo "<h1>Bienvenido $rol</h1>";

// Lista de enlaces de usuario
$enlaces_usuario = [
    "Enlace de usuario 1",
    "Enlace de usuario 2"
];

// Lista de enlaces de admin
$enlaces_admin = [
    "Enlace de admin 1",
    "Enlace de admin 2",
    "Enlace de admin 3",
    "Enlace de admin 4"
];

// Mostrar enlaces según el rol
if ($rol == "admin") {
    // Mostrar enlaces de admin y de usuario
    echo "<h2>Enlaces de admin</h2>";
    echo "<ul>";
    foreach ($enlaces_admin as $enlace) {
        echo "<li><a href='#'>$enlace</a></li>";
    }
    echo "</ul>";

    echo "<h2>Enlaces de usuario</h2>";
    echo "<ul>";
    foreach ($enlaces_usuario as $enlace) {
        echo "<li><a href='#'>$enlace</a></li>";
    }
    echo "</ul>";
} elseif ($rol == "usuario") {
    // Solo mostrar enlaces de usuario
    echo "<h2>Enlaces de usuario</h2>";
    echo "<ul>";
    foreach ($enlaces_usuario as $enlace) {
        echo "<li><a href='#'>$enlace</a></li>";
    }
    echo "</ul>";
} else {
    // Si el rol no es válido
    echo "<p>Rol no válido.</p>";
}
?>
