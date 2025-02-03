<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar skill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../css/styles.css">
</head>
<body>


    <?php include __DIR__ . '/../views/Navbar.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Editar habilidad</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="habilidades" class="form-label">Habilidades</label>
            <input type="text" class="form-control" id="nuevasHabilidades" name="nuevasHabilidades" value="<?php echo $data['habilidad'][0]['habilidades']; ?>">
            <div class="text-danger"><?php echo $data['msjErrorHabilidades']; ?></div>
        </div>
        <div class="mb-3">
            <label for="visible" class="form-label">Visible</label>
            <select class="form-select" id="visible" name="visible">
                <option value="1" <?php echo ($data['habilidad'][0]['visible'] == 1) ? 'selected' : ''; ?>>Sí</option>
                <option value="0" <?php echo ($data['habilidad'][0]['visible'] == 0) ? 'selected' : ''; ?>>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="categoriasD" class="form-label">Categorías disponibles</label>
            <select class="form-control" id="nuevasCategoriasD" name="nuevasCategoriasD">
                <option value="">Elegir categoría</option>
                <?php foreach ($data['categorias'] as $categoria): ?>
                    <option value="<?php echo $categoria['categoria']; ?>" <?php echo ($categoria['categoria'] == $data['habilidad'][0]['categorias_skills_categoria']) ? 'selected' : ''; ?>>
                        <?php echo $categoria['categoria']; ?>
                    </option>
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