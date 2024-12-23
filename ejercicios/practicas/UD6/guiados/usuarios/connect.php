<?php
function conectaDB()
{
    try{
        $dsn = 'mysql:host=localhost;dbname=bd_mascotas';
        $db = new PDO($dsn, 'mascotasAdmin', '1234');

        $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');

        return($db);
    }
    catch (PDOException $e){
        echo "Error conexión";
        exit();
    }

}


function clearData($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
 }

?>