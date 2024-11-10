<?php
// Definir el rol: puede ser 'usuario' o 'admin'
$rol = "admin"; 

$enlaces_usuario = [
    "Enlace de usuario 1",
    "Enlace de usuario 2"
];

$enlaces_admin = [
    "Enlace de admin 1",
    "Enlace de admin 2",
    "Enlace de admin 3",
    "Enlace de admin 4"
];

if ($rol == "admin") {
    echo "<h1>Bienvenido $rol</h1>";
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
    echo "<h1>Bienvenido $rol</h1>";
    echo "<h2>Enlaces de usuario</h2>";
    echo "<ul>";
    foreach ($enlaces_usuario as $enlace) {
        echo "<li><a href='#'>$enlace</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>Rol no válido.</p>";
}
?>
