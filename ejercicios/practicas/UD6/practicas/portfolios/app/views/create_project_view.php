<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nuevo Proyecto</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<?php include __DIR__ . '/../views/Navbar.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Añadir nuevo proyecto</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $data['titulo']; ?>">
            <div class="text-danger"><?php echo $data['msjErrorTitulo']; ?></div>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion"><?php echo $data['descripcion']; ?></textarea>
            <div class="text-danger"><?php echo $data['msjErrorDescripcion']; ?></div>
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" class="form-control" id="logo" name="logo"/>
            <div class="text-danger"><?php echo $data['msjErrorLogo']; ?></div>
        </div>
        <div class="mb-3">
            <label for="tecnologias" class="form-label">Tecnologías</label>
            <input type="text" class="form-control" id="tecnologias" name="tecnologias" value="<?php echo $data['tecnologias']; ?>">
            <div class="text-danger"><?php echo $data['msjErrorTecnologias']; ?></div>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>