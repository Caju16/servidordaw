<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="/styles/index_styles.css">
    <style>
        .volver-button { background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; text-align: center; font-size: 16px; }
        .volver-button:hover { background: #5a6268; }
        .cancel-button { background: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer; text-align: center; font-size: 16px; margin-top: 10px; }
        .cancel-button:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mis Reservas</h1>
        <div class="section">
            <h2>Reservas Actuales</h2>
            <ul id="reservas-list"></ul>
        </div>
        <button class="volver-button" onclick="window.location.href='/'">Volver</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jwt-decode/build/jwt-decode.min.js"></script>

    <script src="/scripts/mis_reservas.js"></script>

</body>
</html>