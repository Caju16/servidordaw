<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Perfiles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <?php include __DIR__ . '/../views/Navbar.php'; ?>

    <div class="container text-center my-5">
        <h1 class="mb-4">🔍 Buscador de Perfiles</h1>
        
        <div class="search-box bg-secondary">
            <h2 class="mb-3">Encuentra un Usuario</h2>
            <form action="http://portfolios.local/" method="get" class="d-flex flex-column align-items-center">
                <input type="text" name="nombre" id="nombre" value="<?php echo $_GET['nombre'] ?? ''; ?>" placeholder="Nombre" class="form-control mb-2 w-75 text-center">
                <input type="submit" value="Buscar" class="btn btn-primary w-50">
            </form>
        </div>
    </div>

    <?php if (!empty($data['ErrorNotFound'])): ?>
        <h3 class="text-center text-danger mt-4">⚠️ <?php echo $data['ErrorNotFound']; ?></h3>
    <?php endif; ?>

    <div class="container">
        <div class="row justify-content-center">
            <?php foreach ($data['encontrado'] as $usuarioEncontrado): ?>
                <div class="col-md-4 mb-4">
                    <div class="card ">
                        <img src="<?php echo $usuarioEncontrado['foto']; ?>" class="card-img-top" alt="Foto de <?php echo $usuarioEncontrado['nombre']; ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $usuarioEncontrado['nombre'] . ' ' . $usuarioEncontrado['apellidos']; ?></h5>
                            <p class="text-muted">👨‍💼 <?php echo $usuarioEncontrado['categoria_profesional']; ?></p>
                            <p><strong>Email:</strong> <?php echo $usuarioEncontrado['email']; ?></p>
                            <p><strong>Categoría:</strong> <?php echo $usuarioEncontrado['categoria_profesional']; ?></p>
                            <p><strong>Resumen:</strong> <?php echo $usuarioEncontrado['resumen_perfil']; ?></p>
                            <p><strong>🔵 Visible:</strong> <?php echo $usuarioEncontrado['visible'] ? 'Sí' : 'No'; ?></p>
                            <p><strong>✅ Cuenta Activa:</strong> <?php echo $usuarioEncontrado['cuenta_activa'] ? 'Sí' : 'No'; ?></p>
                            <a href="/portfolios/list/<?php echo $usuarioEncontrado['id']; ?>" class="btn btn-info">Ver Portfolio</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>