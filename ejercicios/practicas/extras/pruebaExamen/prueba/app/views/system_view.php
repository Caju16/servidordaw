<style>
    body {
        background-color:#1f1f1f;
        font-family: Arial, sans-serif;
        color: #fff;
    }

    a{
        color: white;
    }

    ul {
        list-style-type: none;
        padding-left: 20px;
    }

</style>


<h1>ZONA PRIVADA</h1>


<a href="/logout">Logout</a>
<a href="/">Inicio</a>


<?php if(empty($_SESSION['idExamen']) || empty($data)): ?>

<form action="" method="post">
    <button type="submit" name="empezar">Empezar examen</button>
</form>

<?php else: ?>

<h2><?php echo $data['examen']['titulo']; ?></h2>


<form action="" method="post">


<?php foreach($data['preguntas'] as $pregunta): ?>
    <h3><?php echo $pregunta['enunciado']; ?></h3>
    <ul>
        <li>A<input type="radio" name="respuesta<?php echo $pregunta['id']; ?>" value="A"> <?php echo $pregunta['opcion_a']; ?></li>
        <li>B<input type="radio" name="respuesta<?php echo $pregunta['id']; ?>" value="B"> <?php echo $pregunta['opcion_b']; ?></li>
        <li>C<input type="radio" name="respuesta<?php echo $pregunta['id']; ?>" value="C"> <?php echo $pregunta['opcion_c']; ?></li>
        <li>D<input type="radio" name="respuesta<?php echo $pregunta['id']; ?>" value="D"> <?php echo $pregunta['opcion_d']; ?></li>
    </ul>
    <input type="hidden" name="preguntas[]" value="<?php echo $pregunta['id']; ?>">
    <?php var_dump($pregunta['respuesta_correcta']); ?>
<?php endforeach; ?>

    <button type="submit" name="finalizar">Finalizar examen</button>
</form>

<?php endif; ?>