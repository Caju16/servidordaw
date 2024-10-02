<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php 

    // DECLARAMOS LAS VARIABLES

    $num1 = 20;
    $num2 = 10;
    $num3 = 10;

    // COMPARACIÓN DE NÚMEROS:

    // SI EL NUM1 ES MÁS PEQUEÑO QUE NUM2 Y 3, ENTRA

    if ($num1 <= $num2 && $num1 <= $num3) {
        if ($num2 <= $num3) {
            echo "$num1, $num2, $num3";
        } else {
            echo "$num1, $num3, $num2";
        }
    } 

    // SI EL NUM2 ES MÁS PEQUEÑO O IGUAL QUE NUM1 Y QUE NUM3, ENTRA

    elseif ($num2 <= $num1 && $num2 <= $num3) {
        if ($num1 <= $num3) {
            echo "$num2, $num1, $num3";
        } else {
            echo "$num2, $num3, $num1";
        }
    } 
    
    // SI NO SE CUMPLE NINGUNO, ENTRA AQUÍ
    
    else {
        if ($num1 <= $num2) {
            echo "$num3, $num1, $num2";
        } else {
            echo "$num3, $num2, $num1";
        }
    }

    
    ?>

</body>
</html>