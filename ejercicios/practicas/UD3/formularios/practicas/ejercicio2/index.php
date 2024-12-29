<?php

    $provincias = array("Cádiz", "Almería", "Jaén", "Córdoba", "Sevilla", "Huelva", "Málaga", "Granada");
    $selected = '';



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum</title>
    <style>
        body {
            background:#1c1c1c;
            color: white;
            padding:0;
            margin: 0;
            text-align:center;
        }

        .container{
            display:flex;
            align-items:center;
            flex-wrap:wrap;
            justify-content:space-evenly;
        }

        .izq{
            display:flex;
            flex-direction:column;
            align-items:center;
        }

        .der{
           display:flex;
           flex-direction:column;
           align-items:center;
        }

        .footer{
            display:flex;
            align-items:center;
            margin: 50px;
            justify-content: space-evenly;
        }

        .sombreado{
            padding: 10px;
            background: rgba(255,255,255,0.5);
            border: 2px solid white;
            border-radius: 5px;
        }

        input::placeholder{
            color:black;
        }

        select{
            background:rgba(255,255,255,0.5);
            color:black;
            border: none;
            padding:5px;
            border-radius:5px;
        }

        .inputs{
            display:flex;
            flex-direction: column;
            align-items:center;
        }
    </style>
</head>
<body>
    <h1>Creación de CV</h1>

    <form action="procesaCv.php" method="post">


    <div class="container">
        <div class="izq">
            <input class="sombreado" type="text" name="nombre"  placeholder="Nombre"><br/>
            <input class="sombreado" type="text" name="apellidos" placeholder="Apellidos"><br/>
            <input class="sombreado" type="text" name="edad" placeholder="dd/mm/yyyy"><br/>
            <input class="sombreado" type="text" name="email" id="" placeholder="Email"><br/>

            <br/>

            <select name="provincias" id="">
                <?php
                    foreach ($provincias as $provincia){
                        if ($provincia == "Córdoba"){
                            $selected = 'selected';
                        } else{
                            $selected = '';
                        }
                        echo "<option value='$provincia' $selected>" . $provincia . "</option>";
                    }
                ?>
            </select>

            <div class="inputs">
                <h2>Tecnologías conocidas</h2>
                <span>HTML <input type="checkbox" name="html" id=""></span> 
                <span>CSS <input type="checkbox" name="css" id=""></span> 
                <span>JavaScript <input type="checkbox" name="JavaScript" id=""></span>     
                <span>React <input type="checkbox" name="React" id=""></span> 
                <span>Laravel <input type="checkbox" name="Laravel" id=""></span> 
                <span>PHP <input type="checkbox" name="PHP" id=""></span> 
            </div>
        

        </div>

        <div class="der">
            <h2>Disponibilidad horaria</h2>
            <span>Total: <input type="radio" name="disponible" id=""></span>
            <span>Parcial: <input type="radio" name="disponible" id=""></span>

            <h2>Foto:</h2>
            <input type="file" name="foto" id="">
        </div>



    </div>
    <div class="footer">

        <input type="submit" value="Enviar" name="enviar">
        <input type="submit" value="Reset" name="limpiar">    

    </div>
    </form>
</body>
</html>