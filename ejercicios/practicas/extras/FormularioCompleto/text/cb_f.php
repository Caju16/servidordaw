<?php

/**
 * 
 * @author Miguel
 * 
 */

 $nums = $numError = $check = $numero = "";
 $procesaform = $e_Validacion = false;
 $valor = array();
 $nums = array("1","22","3");

 if (isset($_POST["enviar"])){
    $procesaform = true;
    

    if(isset($_POST['cb'])){
        $valor = $_POST['cb'];
        foreach($valor as $numero){
            echo $numero . " ";
        }
    } else {
        echo "Se tiene que rellenar mínimo un campo";
    }


 }

?>


<form action="" method="post">

    <?php 
        foreach ($nums as $num){
            if(in_array($num, $valor)){
                $check = 'checked';
            } else {
                $check = '';
            }
            echo "<input type='checkbox' name='cb[]' value='$num' $check> $num";
        }
    ?>

    <input type="submit" name="enviar" value="Enviar">
</form>

<?php

?>