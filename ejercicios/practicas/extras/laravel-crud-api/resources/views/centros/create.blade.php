<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Centro</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <div class="container">
        <h1>Crear Nuevo Centro Cívico</h1>

        <form action="{{ route('centros.store') }}" method="POST">
            @csrf
            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Dirección:</label>
            <input type="text" name="direccion" required>

            <label>Teléfono:</label>
            <input type="text" name="telefono" required>

            <label>Horario:</label>
            <input type="text" name="horario" required>

            <button class="create-btn" type="submit">Guardar</button>
        </form>

        <a class="back-link" href="{{ route('centros.index') }}">Volver</a>
    </div>

</body>
</html>
