<?php 
    $num = 0;
    $suma = 0; 
    
    for ($num; $num <= 10; $num++){
        if ($num <= 3) {
            $suma += $num;
        }
        echo $num, " ";
    }

    echo "<br>Suma de los primeros 3 números: ", $suma;
?>
