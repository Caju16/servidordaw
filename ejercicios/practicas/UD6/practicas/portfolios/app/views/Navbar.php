<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Portfolios</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav d-flex align-items-center justify-content-around w-100">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Zona pública</a>
                </li>
                <?php if (!isset($_SESSION['usuario'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/usuario/login">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/usuario/register">Register</a>
                    </li>
                <?php endif; ?>    
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/usuario/logout">Cerrar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/usuario/system">
                            <img src="../../../<?php echo $_SESSION['usuario']['foto']; ?>" alt="foto" style="width: 60px; height: 60px; border-radius: 50%;">
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>