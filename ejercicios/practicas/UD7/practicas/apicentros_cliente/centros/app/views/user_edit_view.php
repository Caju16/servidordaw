<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #1e1e1e; }
        .edit-container { background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        input, button { display: block; width: 100%; margin: 10px 0; padding: 10px; }
        .volver-button { background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; text-align: center; font-size: 16px; }
        .volver-button:hover { background: #5a6268; }
        .text-danger { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="edit-container">
        <h2>Editar Usuario</h2>
        <form id="edit-user-form" method="post" action="">
            <div class="form-group">
                <label for="nombre">Nuevo Nombre:</label>
                <input type="text" id="nombre" name="nombre">
                <div class="text-danger"><?php echo $data['msjErrorNombre']; ?></div>
            </div>
            <div class="form-group">
                <label for="email">Nuevo Email:</label>
                <input type="email" id="email" name="email">
                <div class="text-danger"><?php echo $data['msjErrorEmail']; ?></div>
            </div>
            <div class="form-group">
                <label for="password">Nueva Contraseña:</label>
                <input type="password" id="password" name="password">
                <div class="text-danger"><?php echo $data['msjErrorPassword']; ?></div>
            </div>
            <div class="form-group">
                <label for="repassword">Repetir Nueva Contraseña:</label>
                <input type="password" id="repassword" name="repassword">
                <div class="text-danger"><?php echo $data['msjErrorRepassword']; ?> </div>
            </div>
            <button type="submit">Guardar Cambios</button>
        </form>
        <button class="volver-button" onclick="window.location.href='/'">Volver</button>
    </div>
    
    <!-- <script src="./scripts/edit_user_script.js"></script> -->

</body>
</html>