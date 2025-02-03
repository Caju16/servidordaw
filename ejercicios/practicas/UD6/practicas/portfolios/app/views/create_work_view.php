<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo trabajo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>


    <?php include __DIR__ . '/../views/Navbar.php'; ?>


    <div class="container mt-5">
        <h2 class="text-center">Añadir nuevo trabajo</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $data['titulo']; ?>">
            <div class="text-danger"><?php echo $data['msjErrorTitulo']; ?></div>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo $data['descripcion']; ?></textarea>
            <div class="text-danger"><?php echo $data['msjErrorDescripcion']; ?></div>
        </div>
        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $data['fecha_inicio']; ?>">
            <div class="text-danger"><?php echo $data['msjErrorFechaInicio']; ?></div>
        </div>
        <div class="mb-3">
            <label for="fecha_final" class="form-label">Fecha Final</label>
            <input type="date" class="form-control" id="fecha_final" name="fecha_final" value="<?php echo $data['fecha_final']; ?>">
            <div class="text-danger"><?php echo $data['msjErrorFechaFinal']; ?></div>
        </div>
        <div class="mb-3">
            <label for="logros" class="form-label">Logros</label>
            <input type="text" class="form-control" id="logros" name="logros" value="<?php echo $data['logros']; ?>" placeholder="Logro 1, logro 2...">
            <div class="text-danger"><?php echo $data['msjErrorLogros']; ?></div>
        </div>
        <div class="mb-3">
            <label for="visible" class="form-label">Visible</label>
            <select class="form-control" id="visible" name="visible">
                <option value="1" <?php echo ($data['visible'] == 1) ? 'selected' : ''; ?>>Sí</option>
                <option value="0" <?php echo ($data['visible'] == 0) ? 'selected' : ''; ?>>No</option>
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>