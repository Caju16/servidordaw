<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Inscripción</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #1e1e1e; }
        .inscripcion-container { background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        input, select, button { display: block; width: 100%; margin: 10px 0; padding: 10px; }
        .volver-button { background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; text-align: center; font-size: 16px; }
        .volver-button:hover { background: #5a6268; }
        .text-danger { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="inscripcion-container">
        <h2>Crear Inscripción</h2>
        <div id="msjErrorGeneral" class="text-danger"></div>
        <form id="new-inscripcion-form" method="post" action="">
            <div class="form-group">
                <label for="nombre">Nombre del Solicitante:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>">
                <div class="text-danger" id="msjErrorNombre"><?php echo $data['msjErrorNombre']; ?></div>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $data['telefono']; ?>">
                <div class="text-danger" id="msjErrorTelefono"><?php echo $data['msjErrorTelefono']; ?></div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $data['email']; ?>">
                <div class="text-danger" id="msjErrorEmail"><?php echo $data['msjErrorEmail']; ?></div>
            </div>
            <div class="form-group">
                <label for="actividad">Actividad:</label>
                <select id="actividad" name="actividad">
                    <option value="">Seleccione una actividad</option>
                </select>
                <div class="text-danger" id="msjErrorActividad"><?php echo $data['msjErrorActividad']; ?></div>
            </div>
            <div class="form-group">
                <label for="fecha_inscripcion">Fecha de Inscripción:</label>
                <input type="date" id="fecha_inscripcion" name="fecha_inscripcion">
                <div class="text-danger" id="msjErrorFechaInscripcion"><?php echo $data['msjErrorFechaInscripcion']; ?></div>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado">
                    <option value="Aceptada">Aceptada</option>
                    <option value="Lista de espera">Lista de espera</option>
                    <option value="Rechazada">Rechazada</option>
                </select>
                <div class="text-danger" id="msjErrorEstado"><?php echo $data['msjErrorEstado']; ?></div>
            </div>
            <button type="submit">Crear Inscripción</button>
        </form>
        <button class="volver-button" onclick="window.location.href='/'">Volver</button>
    </div>
    <script src="../scripts/new_inscripcion.js"></script>
</body>
</html>