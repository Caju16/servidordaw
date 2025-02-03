<?php


    // var_dump(session_id());
    // var_dump($_SESSION);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar borrado</h5>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                Esta acción es irreversible, ¿Seguro que quieres borrar tu cuenta?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Sí</a>
            </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../views/Navbar.php'; ?>

    <div class="container d-flex justify-content-center align-items-center" style="height: calc(100vh - 56px); padding-top: 56px;">
        <div class="text-center">
            <h1>Esta es la vista del sistema</h1>
            <p>Bienvenido: <?php echo $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellidos'];?></p>

            <img src="../<?php echo $_SESSION['usuario']['foto'] ; ?>" alt="foto" style="width: 100px; height: 100px; border-radius: 50%;">

            <?php if($_SESSION['usuario']['cuenta_activa'] == 0): ?>
                <p>La cuenta no está activa</p>
            <?php else: ?>
                <p>La cuenta está activa</p>
                <!-- <a href="/portfolios/crear/trabajo" class="btn btn-primary my-2">Añadir trabajo</a>
                <br/>
                <a href="/portfolios/crear/skill" class="btn btn-success my-2">Añadir habilidad</a>
                <br/>
                <a href="/portfolios/crear/rrss" class="btn btn-warning my-2">Añadir RRSS</a>
                <br/>
                <a href="/portfolios/crear/project" class="btn btn-danger my-2">Añadir proyecto</a>
                <br/> -->
                <a href="/portfolios/list/<?php echo $_SESSION['usuario']['id']; ?>" class="btn btn-info my-2">Ver portfolio</a>
                <br/>
            <?php endif; ?>
            <a href="/usuario/editar" class="btn btn-warning my-2">Editar usuario</a>
            <br/>
            <a href="/usuario/delete" class="btn btn-danger my-2 delete-btn" data-id="<?php echo $_SESSION['usuario']['id']; ?>">Eliminar cuenta<i class="fa-regular fa-trash-can"></i></a>
            <br/>
        </div>
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