<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mascotas</title>
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
        <h1>Estamos en la vista</h1>
        <a href="./mascotas/add">Añadir mascota</a>
        <?php
            foreach ($data['mascotas'] as $mascota) {
                echo "<p>Nombre:" . $mascota['nombre'] . "</p>";
                echo "<p>Peso:" . $mascota['peso'] . "</p>";
                echo "<p>Raza:" . $mascota['raza'] . "</p>";
                echo "<a href ='/mascotas/edit?id=" . $mascota['id'] . "'>Editar</a><br/>";
                echo "<a href ='/mascotas/delete?id=". $mascota['id'] . "'>Borrar</a>";
                echo "<hr>";
            }
        ?>
    </body>
</html>