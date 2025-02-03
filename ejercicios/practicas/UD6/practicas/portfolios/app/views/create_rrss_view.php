<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva rrss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>


    <?php include __DIR__ . '/../views/Navbar.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Añadir nueva RRSS</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="redes_socialescol" class="form-label">Red social</label>
            <input type="text" class="form-control" id="redes_socialescol" name="redes_socialescol" value="<?php echo $data['redes_socialescol']; ?>">
            <div class="text-danger"><?php echo $data['msjErrorRrssName']; ?></div>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">Url</label>
            <input type="text" class="form-control" id="url" name="url" value="<?php echo $data['url']; ?>">
            <div class="text-danger"><?php echo $data['msjErrorUrl']; ?></div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>