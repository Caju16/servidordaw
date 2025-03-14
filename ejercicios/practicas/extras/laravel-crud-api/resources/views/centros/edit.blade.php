<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Centro</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <div class="container">
        <h1>Editar Centro Cívico</h1>

        <form action="{{ route('centros.update', $centro->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{ $centro->nombre }}" required>

            <label>Dirección:</label>
            <input type="text" name="direccion" value="{{ $centro->direccion }}" required>

            <label>Teléfono:</label>
            <input type="text" name="telefono" value="{{ $centro->telefono }}" required>

            <label>Horario:</label>
            <input type="text" name="horario" value="{{ $centro->horario }}" required>

            <button class="update-btn" type="submit">Actualizar</button>
        </form>

        <a class="back-link" href="{{ route('centros.index') }}">Volver</a>
    </div>

</body>
</html>
