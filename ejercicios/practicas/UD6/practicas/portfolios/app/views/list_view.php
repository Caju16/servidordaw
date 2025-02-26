<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="https://kit.fontawesome.com/f0328b83ac.js" crossorigin="anonymous"></script>
</head>
<body class="bg-dark text-light">

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar borrado</h5>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro de querer borrar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Sí</a>
            </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../views/Navbar.php'; ?>

    <div class="container my-5">
        <h1 class="text-center mb-4">Portfolio de <span class="text-primary"> <?php echo $data['usuario']['nombre']; ?> </span></h1>


            <section class="mb-5">
                <h2 class="text-light text-center my-4">Trabajos</h2>

                <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', $_SERVER['REQUEST_URI'])[3]): ?>
                    <div class="text-center m-4">
                        <a href="/portfolios/crear/trabajo" class="btn btn-success">Añadir Trabajo</a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($data['trabajos'])): ?>

                <div class="row g-4 d-flex justify-content-center">
                    <?php 
                    $trabajosVisibles = array_filter($data['trabajos'], function($trabajo) {
                        return $trabajo['visible'] || (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', $_SERVER['REQUEST_URI'])[3]);
                    });

                    if (empty($trabajosVisibles)): ?>
                        <h3 class="text-center text-light">No hay trabajos disponibles</h3>
                    <?php else: 
                         foreach ($trabajosVisibles as $trabajo): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $trabajo['titulo']; ?></h5>
                                        <p class="card-text text-muted"> <strong>Descripción:</strong> <?php echo $trabajo['descripcion']; ?> </p>
                                        <p class="mb-1"><strong>Inicio:</strong> <?php echo $trabajo['fecha_inicio']; ?></p>
                                        <p class="mb-1"><strong>Final:</strong> <?php echo $trabajo['fecha_final']; ?></p>
                                        <p><strong>Logros:</strong></p>
                                        <ul>
                                            <?php foreach (explode(',', $trabajo['logros']) as $logro): ?>
                                                <li><?php echo htmlspecialchars(trim($logro)); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', $_SERVER['REQUEST_URI'])[3]): ?>
                                            <p><strong>Visibilidad:</strong> <?php echo $trabajo['visible'] ? 'Visible' : 'Oculto'; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', $_SERVER['REQUEST_URI'])[3]): ?>
                                    <div class="card-footer d-flex justify-content-between">
                                        <a href="/portfolios/edit/trabajo/<?php echo $trabajo['id']; ?>" class="btn btn-info btn-sm">Editar <i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="/portfolios/delete/trabajo/<?php echo $trabajo['id']; ?>" class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $trabajo['id']; ?>">Eliminar <i class="fa-regular fa-trash-can"></i></a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- Proyectos Section -->     
            <section class="mb-5">
                <h2 class="text-light text-center my-3">Proyectos</h2>
                <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', string: $_SERVER['REQUEST_URI'])[3]): ?>
                    <div class="text-center m-4">
                        <a href="/portfolios/crear/project" class="btn btn-success">Añadir Proyecto</a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($data['proyectos'])): ?>
                <div class="row g-4 d-flex justify-content-center">
                    <?php 
                    $proyectosVisibles = array_filter($data['proyectos'], function($proyecto) {
                        return $proyecto['visible'] || (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', $_SERVER['REQUEST_URI'])[3]);
                    });

                    if (empty($proyectosVisibles)): ?>
                        <h3 class="text-center text-light">No hay proyectos disponibles</h3>
                    <?php else: 
                        foreach ($data['proyectos'] as $proyecto): 
                            if ($proyecto['visible'] || (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', string: $_SERVER['REQUEST_URI'])[3])):?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $proyecto['titulo']; ?></h5>
                                        <p class="card-text text-muted"> <strong>Descripción:</strong> <?php echo $proyecto['descripcion']; ?> </p>
                                        <?php if (isset($proyecto['logo'])): ?>
                                            <img src="<?php echo '../../' . $proyecto['logo']; ?>" alt="Logo" class="img-fluid rounded mb-2" />
                                        <?php endif; ?>
                                        <p><strong>Tecnologías:</strong></p>
                                        <ul>
                                            <?php foreach (explode(',', $proyecto['tecnologias']) as $tec): ?>
                                                <li><?php echo htmlspecialchars(trim($tec)); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', string: $_SERVER['REQUEST_URI'])[3]): ?>
                                        <p><strong>Visibilidad:</strong> <?php echo $proyecto['visible'] ? 'Visible' : 'Oculto'; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', string: $_SERVER['REQUEST_URI'])[3]): ?>
                                    <div class="card-footer d-flex justify-content-between">
                                        <a href="/portfolios/edit/project/<?php echo $proyecto['id']; ?>" class="btn btn-info btn-sm">Editar <i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="/portfolios/delete/project/<?php echo $proyecto['id']; ?>" class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $proyecto['id']; ?>">Eliminar <i class="fa-regular fa-trash-can"></i></a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                    <?php endif; endforeach; 
                    endif; ?>
                </div>
                
            </section>
        <?php endif; ?>


        <!-- Habilidades Section -->
            <section class="mb-5">
                <h2 class="text-light text-center my-3">Habilidades</h2>
                <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', string: $_SERVER['REQUEST_URI'])[3]): ?>
                    <div class="text-center m-4">
                        <a href="/portfolios/crear/skill" class="btn btn-success">Añadir Habilidad</a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($data['habilidades'])): ?>

                <div class="row g-4 d-flex justify-content-center">
                    <?php 
                    $habilidadesVisibles = array_filter($data['habilidades'], function($habilidad) {
                        return $habilidad['visible'] || (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', $_SERVER['REQUEST_URI'])[3]);
                    });

                    if (empty($habilidadesVisibles)): ?>
                        <h3 class="text-center text-light">No hay habilidades disponibles</h3>
                    <?php else: 
                        foreach ($habilidadesVisibles as $habilidad): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $habilidad['habilidades']; ?></h5>
                                        <p class="card-text text-muted"><?php echo $habilidad['categorias_skills_categoria']; ?></p>
                                        <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', $_SERVER['REQUEST_URI'])[3]): ?>
                                        <span class="badge bg-<?php echo $habilidad['visible'] ? 'success' : 'secondary'; ?>">
                                            <?php echo $habilidad['visible'] ? 'Visible' : 'Oculto'; ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', $_SERVER['REQUEST_URI'])[3]): ?>
                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="/portfolios/edit/skill/<?php echo $habilidad['id']; ?>" class="btn btn-info btn-sm">Editar <i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="/portfolios/delete/skill/<?php echo $habilidad['id']; ?>" class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $habilidad['id']; ?>">Eliminar <i class="fa-regular fa-trash-can"></i></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>



        <!-- Redes Sociales Section -->
            <section class="mb-5">
                <h2 class="text-light text-center my-3">Redes sociales</h2>
                <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', string: $_SERVER['REQUEST_URI'])[3]): ?>
                    <div class="text-center m-4">
                        <a href="/portfolios/crear/rrss" class="btn btn-success">Añadir Red Social</a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($data['redes'])): ?>

                <div class="row g-4 d-flex justify-content-center">
                    <?php foreach ($data['redes'] as $red): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $red['redes_socialescol']; ?></h5>
                                    <p class="card-text text-muted"><a href="<?php echo $red['url']; ?>" target="_blank" class="text-decoration-none text-primary">Visitar url</a></p>
                                    <p class="text-muted">Actualizado: <?php echo $red['updated_at']; ?></p>
                                </div>
                                <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['id'] == explode('/', string: $_SERVER['REQUEST_URI'])[3]): ?>
                                    <div class="card-footer d-flex justify-content-between">
                                        <a href="/portfolios/edit/rrss/<?php echo $red['id']; ?>" class="btn btn-info btn-sm">Editar <i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="/portfolios/delete/rrss/<?php echo $red['id']; ?>" class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $red['id']; ?>">Eliminar <i class="fa-regular fa-trash-can"></i></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php 
        if(empty($data['trabajos']) && empty($data['proyectos']) && empty($data['habilidades']) && empty($data['redes'])): ?>
            <h3 class="text-center text-danger">No hay contenido disponible</h3>
        <?php endif; ?>
                

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const deleteUrl = this.getAttribute('href');
                    confirmDeleteBtn.setAttribute('href', deleteUrl);
                    confirmDeleteModal.show();
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
