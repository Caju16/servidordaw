<?php
/**
 * 
 * 
 */
include 'conf/config.php';

if(!isset($_POST["enviar"])){
    header("Location:test3.php");
}

// SUBIDA FICHERO CSV

$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
    if (( $_FILES["file"]["size"] < MAXSIZE) &&
            in_array($_FILES["file"]["type"],$allowedFormat) && in_array($extension, $allowedExts)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/>";
    }
    else {
        $filename = $_FILES["file"]["name"];
        /* Conviene renombrar la imagen bien con el id de una base de datos
        o con un identificador único*/
        $filename = uniqid().'.'.pathinfo($filename,PATHINFO_EXTENSION);
            if (file_exists(DIRUPLOAD .$filename )) {
                echo $_FILES["file"]["name"] . " already exists. ";
            }
            else {
                move_uploaded_file($_FILES["file"]["tmp_name"], DIRUPLOAD . $filename);
            }
        echo "<br/>";
        echo '<a href="javascript:history.back()">Volver</a>'; // Mejor.
    }
}
else {
echo "Invalid file";
}

$grupo = $_POST['grupo'];
$curso = $_POST['curso'];
$formato = $_POST['formato'];

echo $grupo . '<br/>';
echo $curso . '<br/>';
echo $formato . '<br/>';

?>