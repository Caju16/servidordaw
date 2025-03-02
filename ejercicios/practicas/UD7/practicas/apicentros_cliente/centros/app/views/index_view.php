<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centros Cívicos</title>
    <link rel="stylesheet" href="./styles/index_styles.css">
</head>
<body>
    <div id="auth-buttons">
        <button class="login-button" onclick="window.location.href='usuario/login'">Iniciar Sesión</button>
        <button class="login-button" onclick="window.location.href='usuario/register'">Registrarse</button>
        <button class="logout-button" id="logout-button" style="display:none;" onclick="cerrarSesion()">Cerrar Sesión</button>
        <button class="refresh-button" id="refresh-button" style="display:none;" onclick="refrescarToken()">Refrescar Token</button>
    </div>
    <div class="section" id="gestion-usuario" style="display:none;">
        <h2>Gestión de Usuario</h2>
        <div id="user-info" style="display:none;">
            <p><strong>Nombre:</strong> <span id="user-name"></span></p>
            <p><strong>Email:</strong> <span id="user-email"></span></p>
        </div>
        <button class="edit-button" onclick="window.location.href='usuario/edit'">Editar Usuario</button>
        <button class="refresh-button" onclick="refrescarToken()">Actualizar Token</button>
        <button class="logout-button" onclick="cerrarSesion()">Cerrar Sesión</button>
        <button class="delete-button" onclick="eliminarUsuario()">Eliminar Usuario</button>
    </div>
    <div class="section" id="gestion-reservas" style="display:none;">
        <h2>Gestión de Reservas</h2>
        <button class="new-reserva-button" onclick="window.location.href='reserva/create'">Nueva Reserva</button>
        <button class="mis-reservas-button" onclick="window.location.href='reservas/misreservas'">Mis Reservas</button>
    </div>
    <div class="section" id="gestion-inscripciones" style="display:none;">
        <h2>Gestión de Inscripciones</h2>
        <button class="new-inscripcion-button" onclick="window.location.href='inscripcion/create'">Nueva Inscripción</button>
        <button class="mis-inscripciones-button" onclick="window.location.href='inscripciones/misinscripciones'">Mis Inscripciones</button>
    </div>
    <h1>Información de Centros Cívicos</h1>
    <div class="container">
        <div class="section" id="search-section">
            <h2>Buscar Instalaciones y Actividades</h2>
            <form id="search-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="search-nombre-instalacion">Nombre Instalación:</label>
                        <input type="text" id="search-nombre-instalacion" name="nombreInstalacion" placeholder="Nombre Instalación...">
                    </div>
                    <div class="form-group">
                        <label for="search-nombre-actividad">Nombre Actividad:</label>
                        <input type="text" id="search-nombre-actividad" name="nombreActividad" placeholder="Nombre Actividad...">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="search-descripcion-instalacion">Descripción Instalación:</label>
                        <input type="text" id="search-descripcion-instalacion" name="descripcionInstalacion" placeholder="Descripción Instalación...">
                    </div>
                    <div class="form-group">
                        <label for="search-descripcion-actividad">Descripción Actividad:</label>
                        <input type="text" id="search-descripcion-actividad" name="descripcionActividad" placeholder="Descripción Actividad...">
                    </div>
                </div>
                <button type="submit" class="search-button">Buscar</button>
            </form>
        </div>
        <div class="content">
            <div class="section" id="centros-section">
                <h2>Centros Cívicos</h2>
                <ul id="centros-list"></ul>
            </div>
            <div class="section" id="listado-general">
                <h2>Listado General</h2>
                <div class="listado-columns">
                    <div class="listado-column">
                        <h3>Instalaciones</h3>
                        <ul id="instalaciones-list"></ul>
                    </div>
                    <div class="listado-column">
                        <h3>Actividades</h3>
                        <ul id="actividades-list"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jwt-decode/build/jwt-decode.min.js"></script>
    <script src="./scripts/index_script.js"></script>

</body>
</html>