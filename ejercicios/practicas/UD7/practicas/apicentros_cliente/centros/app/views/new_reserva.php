<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Reserva</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #1e1e1e; }
        .reserva-container { background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        input, select, button { display: block; width: 100%; margin: 10px 0; padding: 10px; }
        .volver-button { background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; text-align: center; font-size: 16px; }
        .volver-button:hover { background: #5a6268; }
        .text-danger { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="reserva-container">
        <h2>Crear Reserva</h2>
        <form id="new-reserva-form" method="post" action="">
            <div class="form-group">
                <label for="nombre">Nombre del Solicitante:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>">
                <div class="text-danger"><?php echo $data['msjErrorNombre']; ?></div>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $data['telefono']; ?>">
                <div class="text-danger"><?php echo $data['msjErrorTelefono']; ?></div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $data['email']; ?>">
                <div class="text-danger"><?php echo $data['msjErrorEmail']; ?></div>
            </div>
            <div class="form-group">
                <label for="instalacion">Instalación:</label>
                <select id="instalacion" name="instalacion">
                    <option value="">Seleccione una instalación</option>
                </select>
                <div class="text-danger"><?php echo $data['msjErrorInstalacion']; ?></div>
            </div>
            <div class="form-group">
                <label for="fecha_hora_inicio">Fecha y Hora de Inicio:</label>
                <input type="datetime-local" id="fecha_hora_inicio" name="fecha_hora_inicio">
                <div class="text-danger"><?php echo $data['msjErrorFechaHoraInicio']; ?></div>
            </div>
            <div class="form-group">
                <label for="fecha_hora_final">Fecha y Hora de Final:</label>
                <input type="datetime-local" id="fecha_hora_final" name="fecha_hora_final">
                <div class="text-danger"><?php echo $data['msjErrorFechaHoraFinal']; ?></div>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado">
                    <option value="Pendiente">Pendiente</option>
                    <option value="Confirmada">Confirmada</option>
                </select>
                <div class="text-danger"><?php echo $data['msjErrorEstado']; ?></div>
            </div>
            <button type="submit">Crear Reserva</button>
        </form>
        <button class="volver-button" onclick="window.location.href='/'">Volver</button>
    </div>
     <script src="../scripts/new_reserva.js"></script>
</body>
</html>