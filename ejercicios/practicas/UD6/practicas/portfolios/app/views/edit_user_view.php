<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<?php include __DIR__ . '/../views/Navbar.php'; ?>

    <div class="form-container d-flex align-items-center flex-column mt-5">
        <h1>Edición de usuario</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="d-flex flex-wrap justify-content-center">
                <div class="mx-3 my-2">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nuevo nombre:</label>
                        <input type="text" class="form-control" id="nuevoNombre" name="nuevoNombre" value="<?php echo $data['usuario']['nombre']; ?>" />
                        <div class="text-danger"><?php echo $data['msjErrorNombre']; ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Nuevos apellidos:</label>
                        <input type="text" class="form-control" id="nuevosApellidos" name="nuevosApellidos" value="<?php echo $data['usuario']['apellidos']; ?>" />
                        <div class="text-danger"><?php echo $data['msjErrorApellidos']; ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Nuevo Email:</label>
                        <input type="email" class="form-control" id="nuevoEmail" name="nuevoEmail" value="<?php echo $data['usuario']['email']; ?>" />
                        <div class="text-danger"><?php echo $data['msjErrorEmail']; ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva contraseña:</label>
                        <input type="password" class="form-control" id="nuevaPassword" name="nuevaPassword" value="<?php echo $data['usuario']['password']; ?>" />
                        <div class="text-danger"><?php echo $data['msjErrorPassword']; ?></div>
                    </div>
                </div>
                <div class="border-end border-1 mx-3" style="height: auto;"></div>
                <div class="mx-3 my-2">
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Nueva categoría profesional:</label>
                        <input type="text" class="form-control" id="nuevaCategoria" name="nuevaCategoria" value="<?php echo $data['usuario']['categoria_profesional']; ?>" />
                        <div class="text-danger"><?php echo $data['msjErrorCategoria']; ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="resumen" class="form-label">Nuevo resumen de tu perfil:</label>
                        <textarea class="form-control" id="nuevoResumen" name="nuevoResumen"><?php echo $data['usuario']['resumen_perfil']; ?></textarea>
                        <div class="text-danger"><?php echo $data['msjErrorResumen']; ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="pic" class="form-label">Nueva Foto:</label>
                        <input type="file" class="form-control" id="nuevaPic" name="nuevaPic"/>
                        <div class="text-danger"><?php echo $data['msjErrorPic']; ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="visible" class="form-label">¿Perfil visible?</label>
                        <select class="form-select" id="visible" name="visible">
                            <option value="1" <?php echo ($data['usuario']['visible'] == 1) ? 'selected' : ''; ?>>Sí</option>
                            <option value="0" <?php echo ($data['usuario']['visible'] == 0) ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="submit-button d-flex justify-content-center my-3">
                <button type="submit" class="btn btn-primary" id="save" name="enviar">Enviar</button>
            </div>
        </form>
        <div><?php echo $data['EstadoRegistro']; ?></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>