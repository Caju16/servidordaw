<?php

    if(!$_POST["enviar"]){
        header('Location: index.php');
    } 

    if (!$_POST['email']){
        $_POST['email']= "miguelcarmonacicchetti@gmail.com";
    }
    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        echo "El email no tiene un formato válido. <br/>";
        echo '<a href="javascript:history.back()">Volver</a>';
    } else {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $edad = $_POST['edad'];
        $email = $_POST['email'];
        $provincia = $_POST['provincias'];
        $tecnologias = ['html', 'css', 'javascript', 'react', 'laravel', 'php'];
        $img = $_POST['foto'];
    
        if(!$edad){
            $edad = "16/08/2000";
        }
    
        if(!$fecha_nacimiento_convert = DateTime::createFromFormat('d/m/Y', $edad)){
            echo "error en la fecha, debe ser dia/mes/anio <br/>";
            echo '<a href="javascript:history.back()">Volver</a>';
        } else {
            $fecha_actual = new DateTime();
            $diferencia = $fecha_actual->diff($fecha_nacimiento_convert);
            $edadFinal = $diferencia->y;
            echo $nombre . "<br/>";
            echo $apellidos . "<br/>";
            echo "Fecha de nacimiento: ", $edad, "<br>";
            echo $edadFinal . "<br/>";       
            echo $email . "<br/>";
            echo $provincia . "<br/>";
    
            if (isset($_POST['PHP'])){
                    echo "<li>" . $_POST['html'] . "</li>";
            } 
    
           
            if(!isset($_POST['disponible'])){
                echo "No se ha seleccionado disponibilidad";
            } else {
                $dispon = $_POST['disponible'];
                echo $dispon;
            }
    
            echo $img;
            }
        }

?>