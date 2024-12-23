<?php
function clearData($data){
    $data = trim($data); // Para quitar los espacios
    $data = stripslashes($data);
    $data = htmlspecialchars($data); // Para quitar los caracteres html speciales
    return $data;
}