<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centros Cívicos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f9f9f9; }
        .container { display: flex; gap: 20px; }
        .section { flex: 1; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); padding: 15px; }
        h1 { text-align: center; color: #333; }
        h2 { background: #007bff; color: white; padding: 10px; border-radius: 5px; text-align: center; }
        h3 { margin-top: 15px; color: #007bff; }
        ul { list-style: none; padding: 0; }
        li { background: #f4f4f4; margin: 5px 0; padding: 10px; border-radius: 5px; }
        .info { font-size: 14px; color: #555; }
    </style>
</head>
<body>
    <h1>Información de Centros Cívicos</h1>
    <div class="container">
        <div class="section" id="centros-section">
            <h2>Centros Cívicos</h2>
            <ul id="centros-list"></ul>
        </div>
        <div class="section">
            <h2>Listado General</h2>
            <h3>Instalaciones</h3>
            <ul id="instalaciones-list"></ul>
            <h3>Actividades</h3>
            <ul id="actividades-list"></ul>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            cargarCentros();
            cargarInstalaciones();
            cargarActividades();
        });

        function cargarCentros() {
            fetch("http://apicentros.local/api/centros")
                .then(response => response.json())
                .then(centros => {
                    let lista = document.getElementById("centros-list");
                    centros.forEach(centro => {
                        let li = document.createElement("li");
                        li.innerHTML = `<strong>${centro.nombre}</strong><br>
                                        <span class="info">📍 ${centro.direccion}<br>
                                        📞 Teléfono: ${centro.telefono}<br>
                                        ⏰ Horario: ${centro.horario}</span>`;
                        
                        let sublista = document.createElement("ul");
                        cargarInstalacionesCentro(centro.id, sublista);
                        cargarActividadesCentro(centro.id, sublista);
                        li.appendChild(sublista);
                        lista.appendChild(li);
                    });
                })
                .catch(error => console.error("Error cargando centros:", error));
        }

        function cargarInstalacionesCentro(id, lista) {
            fetch(`http://apicentros.local/api/centros/${id}/instalaciones`)
                .then(response => response.json())
                .then(instalaciones => {
                    instalaciones.forEach(instalacion => {
                        let li = document.createElement("li");
                        li.innerHTML = `<strong>🏛️ ${instalacion.nombre}</strong><br>
                                        <span class="info">📌 Descripción: ${instalacion.descripcion}<br>
                                        👥 Capacidad Máxima: ${instalacion.capacidad_maxima}</span>`;
                        lista.appendChild(li);
                    });
                });
        }

        function cargarActividadesCentro(id, lista) {
            fetch(`http://apicentros.local/api/centros/${id}/actividades`)
                .then(response => response.json())
                .then(actividades => {
                    actividades.forEach(actividad => {
                        let li = document.createElement("li");
                        li.innerHTML = `<strong>🎭 ${actividad.nombre}</strong><br>
                                        <span class="info">📌 Descripción: ${actividad.descripcion}<br>
                                        📅 Inicio: ${actividad.fecha_inicio} - Fin: ${actividad.fecha_final}<br>
                                        ⏰ Horario: ${actividad.horario}<br>
                                        👥 Plazas: ${actividad.plazas}</span>`;
                        lista.appendChild(li);
                    });
                });
        }

        function cargarInstalaciones() {
            fetch("http://apicentros.local/api/instalaciones")
                .then(response => response.json())
                .then(instalaciones => {
                    let lista = document.getElementById("instalaciones-list");
                    instalaciones.forEach(instalacion => {
                        let li = document.createElement("li");
                        li.innerHTML = `<strong>🏛️ ${instalacion.nombre}</strong><br>
                                        <span class="info">📌 Descripción: ${instalacion.descripcion}<br>
                                        👥 Capacidad Máxima: ${instalacion.capacidad_maxima}</span>`;
                        lista.appendChild(li);
                    });
                });
        }

        function cargarActividades() {
            fetch("http://apicentros.local/api/actividades")
                .then(response => response.json())
                .then(actividades => {
                    let lista = document.getElementById("actividades-list");
                    actividades.forEach(actividad => {
                        let li = document.createElement("li");
                        li.innerHTML = `<strong>🎭 ${actividad.nombre}</strong><br>
                                        <span class="info">📌 Descripción: ${actividad.descripcion}<br>
                                        📅 Inicio: ${actividad.fecha_inicio} - Fin: ${actividad.fecha_final}<br>
                                        ⏰ Horario: ${actividad.horario}<br>
                                        👥 Plazas: ${actividad.plazas}</span>`;
                        lista.appendChild(li);
                    });
                });
        }
    </script>
</body>
</html>
