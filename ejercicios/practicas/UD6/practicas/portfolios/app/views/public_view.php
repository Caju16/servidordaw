<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <?php include __DIR__ . '/../views/Navbar.php'; ?>

    <div class="container text-center my-4">
        <h1>Esta es la vista pública</h1>

        <h2>Encontrar un usuario</h2>

        <form action="" method="post" class="d-flex flex-column align-items-center">
            <input type="text" name="nombre" id="nombre" value="<?php echo $data['userName'] ?>" placeholder="Nombre" class="mb-2">
            <input type="text" name="apellidos" id="apellidos" value="<?php echo $data['userLastName'] ?>" placeholder="Apellidos" class="mb-2">
            <input type="submit" value="Buscar" name="buscar" class="btn btn-primary">
        </form>
    </div>

    <br/>
    <?php
        if (empty($_POST) || empty($_POST['nombre'])) {
            echo '<div class="d-flex flex-wrap justify-content-evenly m-5">';
            foreach ($data['usuarios'] as $usuario) {
                ?>
                <div class="card mb-3" style="width: 18rem;">
                    <img src="<?php echo $usuario['foto']; ?>" class="card-img-top" alt="Foto de <?php echo $usuario['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $usuario['nombre'] . ' ' . $usuario['apellidos']; ?></h5>
                        <p class="card-text"><strong>Id:</strong> <?php echo $usuario['id']; ?></p>
                        <p class="card-text"><strong>Categoría Profesional:</strong> <?php echo $usuario['categoria_profesional']; ?></p>
                        <p class="card-text"><strong>Email:</strong> <?php echo $usuario['email']; ?></p>
                        <p class="card-text"><strong>Resumen del Perfil:</strong> <?php echo $usuario['resumen_perfil']; ?></p>
                        <p class="card-text"><strong>Visible:</strong> <?php echo $usuario['visible'] ? 'Sí' : 'No'; ?></p>
                        <p class="card-text"><strong>Cuenta Activa:</strong> <?php echo $usuario['cuenta_activa'] ? 'Sí' : 'No'; ?></p>
                        <a href="/portfolios/list/<?php echo $usuario['id']; ?>" class="btn btn-info">Ver Portfolio</a>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
        }
        
        if (!$data['encontrado']) {
            echo $data['ErrorNotFound'];
        } else {
            echo "Se ha encontrado el usuario: <br/>";
            echo '<div class="d-flex flex-wrap justify-content-around">';
            foreach ($data['encontrado'] as $usuarioEncontrado) {
                ?>
                <div class="card mb-3" style="width: 18rem;">
                    <img src="<?php echo $usuarioEncontrado['foto']; ?>" class="card-img-top" alt="Foto de <?php echo $usuarioEncontrado['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $usuarioEncontrado['nombre'] . ' ' . $usuarioEncontrado['apellidos']; ?></h5>
                        <p class="card-text"><strong>Categoría Profesional:</strong> <?php echo $usuarioEncontrado['categoria_profesional']; ?></p>
                        <p class="card-text"><strong>Email:</strong> <?php echo $usuarioEncontrado['email']; ?></p>
                        <p class="card-text"><strong>Resumen del Perfil:</strong> <?php echo $usuarioEncontrado['resumen_perfil']; ?></p>
                        <p class="card-text"><strong>Visible:</strong> <?php echo $usuarioEncontrado['visible'] ? 'Sí' : 'No'; ?></p>
                        <p class="card-text"><strong>Cuenta Activa:</strong> <?php echo $usuarioEncontrado['cuenta_activa'] ? 'Sí' : 'No'; ?></p>
                        <a href="/portfolios/list/<?php echo $usuarioEncontrado['id']; ?>" class="btn btn-info">Ver Portfolio</a>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
        }
            
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>