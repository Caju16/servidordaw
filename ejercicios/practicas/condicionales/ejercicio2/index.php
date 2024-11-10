<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $mes= 2;
        $anio= 2024;
        $dias= 0;

        switch($mes){
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                $dias = 31;
                echo "El mes " . $mes . " del año " . $anio ." tiene " . $dias , " dias";
                break;
            case 4:
            case 6:
            case 9:
            case 11:
                $dias = 30;
                echo "El mes " . $mes . " del año " . $anio ." tiene " . $dias , " dias";
                break;
            case 2:
                if (($anio % 4 == 0 && $anio % 100 != 0) || ($anio % 400 == 0)){
                    $dias = 29;
                    echo "El mes ". $mes . " del año " . $anio ." tiene " . $dias , " dias";
                } else {
                    $dias = 28;
                    echo "El mes " . $mes . " del año " . $anio ." tiene " . $dias , " dias";
                }
        }


    ?>
</body>
</html>