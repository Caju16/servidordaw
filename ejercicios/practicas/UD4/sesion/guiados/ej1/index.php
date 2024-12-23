<?php

session_start();

$imagenesSuperiores = array(
    "piezas/1.JPG",
    "piezas/2.JPG",
    "piezas/3.JPG",
    "piezas/7.JPG",
    "piezas/8.JPG",
    "piezas/9.JPG"
);

$imagenesInferiores = array(
    "piezas/4.JPG",
    "piezas/5.JPG",
    "piezas/10.JPG",
    "piezas/11.JPG",
    "piezas/12.JPG",
    "piezas/Captura.JPG"
);

$correctas = array(
    $imagenesSuperiores[0] => $imagenesInferiores[1],
    $imagenesSuperiores[1] => $imagenesInferiores[5],
    $imagenesSuperiores[2] => $imagenesInferiores[0],
    $imagenesSuperiores[3] => $imagenesInferiores[4],
    $imagenesSuperiores[4] => $imagenesInferiores[2],
    $imagenesSuperiores[5] => $imagenesInferiores[3]
);




// Inicializar los índices de las imágenes si no están definidos

if(!isset($_SESSION['superior']) || !isset($_SESSION['inferior'])){
    $imagenInferiorRandom = $imagenesInferiores[array_rand($imagenesInferiores)];
    $imagenSuperiorRandom = $imagenesSuperiores[array_rand($imagenesSuperiores)];

    $_SESSION['superior'] = $imagenSuperiorRandom;
    $_SESSION['inferior'] = $imagenInferiorRandom;
}


if(isset($_POST['superior'])){
    $imagenSuperiorRandom = $imagenesSuperiores[array_rand($imagenesSuperiores)];
    $_SESSION['superior'] = $imagenSuperiorRandom;
}

if(isset($_POST['inferior'])){
    $imagenInferiorRandom = $imagenesInferiores[array_rand($imagenesInferiores)];
    $_SESSION['inferior'] = $imagenInferiorRandom;
}

if(!isset($_SESSION['aciertos'])){
    $_SESSION['aciertos'] = 0;
}

if(!isset($_SESSION['intentos'])){
    $_SESSION['intentos'] = 0;
}


if (isset($_POST['resolver'])){
    foreach($correctas as $clave => $valor){
        if($clave == $_SESSION['superior'] && $valor == $_SESSION['inferior']){
            $_SESSION['aciertos'] += 1;
        }
    }


    $imagenSuperiorRandom = $imagenesSuperiores[array_rand($imagenesSuperiores)];
    $_SESSION['superior'] = $imagenSuperiorRandom;
    $imagenInferiorRandom = $imagenesInferiores[array_rand($imagenesInferiores)];
    $_SESSION['inferior'] = $imagenInferiorRandom;
    
    $_SESSION['intentos'] += 1;

}

if(isset($_POST['reiniciar'])){
    $imagenSuperiorRandom = $imagenesSuperiores[array_rand($imagenesSuperiores)];
    $_SESSION['superior'] = $imagenSuperiorRandom;
    $imagenInferiorRandom = $imagenesInferiores[array_rand($imagenesInferiores)];
    $_SESSION['inferior'] = $imagenInferiorRandom;
}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background: #1c1c1c;
            color: white;
        }
    </style>
</head>
<body>
    <form action="" method="post">

        <button name="superior"><img src="<?php echo $_SESSION['superior'];?>"></button><br/>
        <button name="inferior"><img src="<?php echo $_SESSION['inferior'];?>"></button><br/>

        <button type="submit" value="Resolver" name="resolver">Resolver</button>
        <button type="submit" value="Reiniciar" name="reiniciar">Reiniciar</button>

    </form>


    <p>Aciertos: <?php echo $_SESSION['aciertos']; ?></p>
    <p>Intentos: <?php echo $_SESSION['intentos']; ?></p>
    <a href="cerrar.php">Cerrar sesion</a>

</body>
</html>