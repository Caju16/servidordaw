<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #1e1e1e; }
        .register-container { background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        input, button { display: block; width: 100%; margin: 10px 0; padding: 5px; }
        .volver-button { background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; text-align: center; font-size: 16px; }
        .volver-button:hover { background: #5a6268; }
        .text-danger { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registrarse</h2>
        <form id="register-form" method="post" action="">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $data['nombre']; ?>" >
            <div class="text-danger"><?php echo $data['msjErrorNombre']; ?></div>
            <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $data['email']; ?>" >
            <div class="text-danger"><?php echo $data['msjErrorEmail']; ?></div>
            <input type="password" name="password" id="password" placeholder="Contraseña" value="<?php echo $data['password']; ?>" >
            <div class="text-danger"><?php echo $data['msjErrorPassword']; ?></div>
            <input type="password" name="repassword" id="repassword" placeholder="Repetir Contraseña" value="<?php echo $data['repassword']; ?>" >
            <div class="text-danger"><?php echo $data['msjErrorRepassword']; ?></div>
            
            <button type="submit">Registrarse</button>
        </form>
        <button class="volver-button" onclick="window.location.href='/'">Volver</button>
    </div>
</body>
</html>