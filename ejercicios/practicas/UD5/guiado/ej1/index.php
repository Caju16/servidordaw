<?php
/**
 * 
 * Probamos la clase Contador
 * @author Miguel
 */

 // Requerimos el contador
 require_once "Contador.php";

 $nInstancias = Contador::nInstancias();

 echo $nInstancias . "<br/>";

 // Creamos varios contadores
 $contador1 = new Contador();
 $contador2 = new Contador(100);
 $contador3 = new Contador();

 // Mostramos el valor de los contadores
 echo $contador1 . "<br/>";
 echo $contador2 . "<br/>";

 echo "<br/>";

 $contador1->contar();
 $contador1->contar();

 $contador2->contar();
 $contador2->contar();

 echo $contador1 . "<br/>";
 echo $contador2 . "<br/>";

 $nInstancias = Contador::nInstancias();
 echo "<br/>";
 echo $nInstancias . "<br/>";
 echo $contador1 . "<br/>";
 echo $contador2 . "<br/>";

?>