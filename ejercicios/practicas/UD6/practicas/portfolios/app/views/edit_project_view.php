<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../css/styles.css">
</head>
<body>


    <?php include __DIR__ . '/../views/Navbar.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Editar proyecto</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="nuevoTitulo" name="nuevoTitulo" value="<?php echo $data['proyecto'][0]['titulo']; ?>">
                    <div class="text-danger"><?php echo $data['msjErrorTitulo']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="nuevaDescripcion" name="nuevaDescripcion"><?php echo $data['proyecto'][0]['descripcion']; ?></textarea>
                    <div class="text-danger"><?php echo $data['msjErrorDescripcion']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" class="form-control" id="nuevoLogo" name="nuevoLogo"/>
                    <div class="text-danger"><?php echo $data['msjErrorLogo']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="tecnologias" class="form-label">Tecnologías</label>
                    <input type="text" class="form-control" id="nuevaTecnologias" name="nuevaTecnologias" value="<?php echo $data['proyecto'][0]['tecnologias']; ?>">
                    <div class="text-danger"><?php echo $data['msjErrorTecnologias']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="visible" class="form-label">Visible</label>
                    <select class="form-select" id="visible" name="visible">
                        <option value="1" <?php echo ($data['proyecto'][0]['visible'] == 1) ? 'selected' : ''; ?>>Sí</option>
                        <option value="0" <?php echo ($data['proyecto'][0]['visible'] == 0) ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>