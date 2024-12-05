<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Subida de archivos</h3>    
    <form action="archivo.php" method="post" enctype="multipart/form-data">
        <label for="file">Filename:</label>
        <input type="file" name="file" id="file"><br/>
        <input type="submit" name="submit" value="Submit">
    </form>
    <?php
        $directorio = 'upload';
        $imagenes = glob($directorio . "/*.{jpg,jpeg,png,gif}", GLOB_BRACE);

        if (isset($_GET['borrar'])) {
            $imagenABorrar = $_GET['borrar'];
            unlink($imagenABorrar);
            echo "Imagen eliminada: " . basename($imagenABorrar) . "<br>";
        }

        foreach ($imagenes as $imagen) {
            echo "<img src='$imagen' alt='Imagen' style='width: 200px; height: auto; margin: 10px;'>";
            echo "<a href='?borrar=" . urlencode($imagen) . "'>Borrar</a><br>";
        }
    ?>
    <a href="mostrar.php"></a>
</body>
</html>