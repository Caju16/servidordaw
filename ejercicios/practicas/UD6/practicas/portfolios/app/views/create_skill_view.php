<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva skill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>


    <?php include __DIR__ . '/../views/Navbar.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Añadir nueva habilidad</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="habilidades" class="form-label">Habilidades</label>
            <input type="text" class="form-control" id="habilidades" name="habilidades" value="<?php echo $data['habilidades']; ?>">
            <div class="text-danger"><?php echo $data['msjErrorHabilidades']; ?></div>
        </div>
        <div class="mb-3">
            <label for="visible" class="form-label">Visible</label>
            <select class="form-control" id="visible" name="visible">
                <option value="1" <?php echo ($data['visible'] == 1) ? 'selected' : ''; ?>>Sí</option>
                <option value="0" <?php echo ($data['visible'] == 0) ? 'selected' : ''; ?>>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="categoriasD" class="form-label">Categorías disponibles</label>
            <select class="form-control" id="categoriasD" name="categoriasD">
                <option value="">Elegir categoría</option>
                <?php foreach ($data['categorias'] as $categoria): ?>
                    <option value="<?php echo $categoria['categoria']; ?>"><?php echo $categoria['categoria']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="text-danger"><?php echo $data['msjErrorCategoriasD']; ?></div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>