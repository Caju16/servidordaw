
<div id="resultado">


    <?php 

        if(isset($data)){
            foreach ($data as $animal) {
                echo "<p>Nombre: ".$animal['nombre']."</p>";
                echo "<p>Raza: ".$animal['raza']."</p>";
                echo "<p>Categoria: ".$animal['categoria_id']."</p>";
                echo "<img src='".$animal['foto']."' alt=''>";
            }
        }


    ?>

</div>