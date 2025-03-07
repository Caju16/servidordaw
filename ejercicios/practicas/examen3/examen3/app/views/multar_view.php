<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multar</title>
</head>
<body>
    
    <h1>Multas del agente <?php echo $_SESSION['user'][0]['usuario']; ?></h1>

    <a href="/">Inicio</a><br/>
    <a href="/logout">Logout</a><br/>
    <a href="/listado">Volver</a><br/>

    <table border="1">
        <thead>
            <tr>
                <th>Conductor</th>
                <th>Matricula</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Importe</th>
                <th>Descuento</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['sanciones'] as $multa ): ?>
                <tr>
                    <td><?php echo $data['usuarios'][0]['usuario']; ?></td>
                    <td><?php echo $multa['matricula']; ?></td>
                    <td><?php echo $multa['descripcion']; ?></td>
                    <td><?php echo $multa['fecha']; ?></td>
                    <td><?php echo $multa['importe']; ?></td>
                    <td><?php echo $multa['descuento']; ?></td>
                    <td><?php echo $multa['estado']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="/acciones/nuevaMulta">Nueva multa</a>


</body>
</html>