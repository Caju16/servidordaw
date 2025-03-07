<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>MULTAS</h1>

    <table>
        <tr>
        <?php if($_SESSION['user'][0]['perfil'] != 'conductor'): ?>
            <th>Conductor</th>
        <?php endif; ?>
            <th>Matricula</th>
            <th>Descripcion</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
        <?php foreach($data['multas'] as $multa): ?>
            <tr>
                <td><?php echo $multa['matricula']; ?></td>
                <td><?php echo $multa['descripcion']; ?></td>
                <td><?php echo $multa['fecha']; ?></td>
                <td><?php echo $multa['estado']; ?></td>
                <?php if($multa['estado'] == 'Pendiente' && $_SESSION['user'][0]['perfil'] == 'conductor'): ?>
                    <td><a href="/multas/pagar/<?php echo $multa['id']; ?>">Pagar</a></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>

        <?php if($_SESSION['user'][0]['perfil'] != 'conductor'): ?>
            <?php foreach($data['todas'] as $multa): ?>
                <tr>
                    <td><?php echo $multa['id_conductor']; ?></td>
                    <td><?php echo $multa['matricula']; ?></td>
                    <td><?php echo $multa['descripcion']; ?></td>
                    <td><?php echo $multa['fecha']; ?></td>
                    <td><?php echo $multa['estado']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

    <a href="/logout">Logout</a><br/>

    <a href="/">Volver</a><br/>

    <?php if($_SESSION['user'][0]['perfil'] == 'agente'): ?>
        <a href="/acciones/multar">Multar</a>
    <?php endif; ?>
    
</body>
</html>