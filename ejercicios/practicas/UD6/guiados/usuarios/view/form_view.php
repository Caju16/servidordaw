<h1>CARGANDO VISTA DE <?php  echo $_SESSION['nombreUser']; ?></h1>
        
<div>
    <div>
        <?php

            echo "<h1>Listado de perros</h1><br/>";


            if(!$resultado){
                echo "Error en la consulta";
            }
            else {
                foreach ($resultado as $valor){
                    echo $valor['nombre'] . " ";
                    echo $valor['peso']." ";
                    echo $valor['raza']." ";
                    if(isset($_SESSION['admin']) && $_SESSION['admin']){
                        echo "<a href=\"borrar.php?id= ". $valor['id'] ."\">Eliminar</a>" ."<br/>";
                    } else {
                        echo "<br/>";
                    }
                }
            }
        ?>
    </div>

    <div>
        <?php
            echo "<h1>Listado de usuarios</h1><br/>";


            if(!$resultadoUsuario){
                echo "Error en la consulta";
            }
            else {
                foreach ($resultadoUsuario as $valor){
                    echo $valor['usuario'] . " ";
                    echo $valor['pass']." ";
                    echo $valor['nombre']." ";
                    if(isset($_SESSION['admin']) && $_SESSION['admin']){
                        echo "<a href=\"borrar.php?id= ". $valor['id'] ."\">Eliminar</a>" ."<br/>";
                    } else {
                        echo "<br/>";
                    }
                }
            }
        ?>
    </div>

    <form action="" method="post">


        Nombre o raza del perro <input type="text" name="datos" placeholder="Perro" value="<?php echo $valBusqueda ?>"/>

        <input type="submit" name="enviar">

    </form>

    <form action="nuevo.php" method="post">

        <?php if(isset($_SESSION['loggeado']) && $_SESSION['admin']){ ?>

        <input type="submit" name="anadir" value="Mas" />

        <?php } else {?>

        <input type="submit" name="anadir" value="Mas" disabled/>

        <?php  } ?>
        
    </form>

    <?php 
    if (isset($_SESSION['loggeado'])){
    ?>

    <a href="salir.php">Cerrar sesion</a>

    <?php  } ?>   
</div>  