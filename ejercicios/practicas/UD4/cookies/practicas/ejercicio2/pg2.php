<?php

if (isset($_COOKIE['miCookie'])){
    echo "Esta página tiene cookies activadas. " . htmlspecialchars($_COOKIE['miCookie']);
} else {
    echo "No hay cookies en esta página o el navegador no las permite.";
}


?>