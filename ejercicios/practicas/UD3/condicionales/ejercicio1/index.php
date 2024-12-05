<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php 
    /**
     *
     *  ORDENAR NUMEROS DEL MAS GRANDE AL MAS PEQUEÑO
     *  @author Miguel Carmona
     * 
    */

    // DECLARAMOS LAS VARIABLES

    $num1 = 20;
    $num2 = 10;
    $num3 = 10;

    // COMPARACIÓN DE NÚMEROS:

    if ($num1 >= $num2 && $num1 >= $num3){
        if ($num2 >= $num3){
            echo "1: " . $num1 . " . 2: " . $num2 . " . 3: " . $num3;
        } else {
            echo "1: " . $num1  . " . 3: "  . $num3 . " . 2: "  . $num2;
        }
    }

    elseif ($num2 >= $num1 && $num2 >= $num3){
        if ($num1 >= $num3){
            echo "2: " . $num2 . " . 1: " . $num1 . " . 3: " . $num3;
        } else {
            echo "2: " . $num2  . " . 3: "  . $num3 . " . 1: "  . $num1;
        }
    }

    elseif ($num3 >= $num1 && $num3 >= $num2){
        if ($num1 >= $num2){
            echo "3: " . $num3 . " . 1: " . $num1 . " . 2: " . $num2;
        } else {
            echo "3: " . $num3  . " . 2: "  . $num2 . " . 1: "  . $num1;
        }
    }

    
    ?>

</body>
</html>