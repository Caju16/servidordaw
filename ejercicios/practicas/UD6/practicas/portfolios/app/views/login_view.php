<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

    <?php include __DIR__ . '/../views/Navbar.php'; ?>  

    <div id="formulario" class="d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h1>Login</h1>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>" />
                    <div class="text-danger"><?php echo $data['msjErrorEmail']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $data['password']; ?>" />
                    <div class="text-danger"><?php echo $data['msjErrorPassword']; ?></div>
                </div>
                <button type="submit" class="btn btn-primary" id="save" name="enviar">Enviar</button>
            </form>
            <br/>
            <div><?php echo $data['EstadoLogin']; ?></div>
        </div>
    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    
</body>
</html>