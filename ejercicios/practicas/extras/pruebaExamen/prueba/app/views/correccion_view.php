<style>
    .correcta {
        color: green;
        font-weight: bold;
    }
    .incorrecta {
        color: red;
        font-weight: bold;
    }
</style>

<h1>Corrección del Examen</h1>

<p>Tu nota final: <strong><?php echo $data['nota']; ?></strong></p>

<?php foreach ($data['preguntas'] as $pregunta): ?>
    <h3><?php echo $pregunta['enunciado']; ?></h3>
    <ul>
        <li <?php echo ($data['correcciones'][$pregunta['id']] ? 'class="correcta"' : 'class="incorrecta"'); ?>>
            <?php echo "Respuesta correcta: " . $pregunta['respuesta_correcta']; ?>
        </li>
    </ul>
<?php endforeach; ?>

<a href="/">Volver al inicio</a>