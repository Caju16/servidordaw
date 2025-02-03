<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <style>
        body{
            background: #1c1c1c;
            color: white;
        }

        a{
            color: white;
        }
    </style>
</head>
<body>
    
    <h1>Vista de edición</h1>

    <?php


                $mascota = $data['mascotas']; // Accede directamente al registro único
                echo $mascota['nombre'] . " || " . $mascota['peso'] . " || " . $mascota['raza'];


                echo '<form method="post" action="/mascotas/edit?id=' . $data['mascotas']['id'] . '"><br/>';
                echo '<label>Nuevo nombre:</label>';
                echo '<input type="text" id="nombre" name="nombre" value="" placeholder="' . $mascota['nombre'] . '" />' . $data['msjErrorNombre'] . '<br/><br/>';
                echo '<label>Nueva raza:</label>';
                echo '<input type="text" id="raza" name="raza" value="" placeholder="' . $mascota['raza'] . '" />' . $data['msjErrorRaza'] . '<br/><br/>';
                echo '<label>Nuevo peso:</label>';
                echo '<input type="text" id="peso" name="peso" value="" placeholder="' . $mascota['peso'] . '" />' . $data['msjErrorPeso'] . '<br/><br/>';
                echo '<div class="col text-center">';
                echo '<input type="submit" id="save" name="save" value ="Enviar">';			
                echo '</div>';                    
                echo '</form>';
            




    ?>

</body>
</html>