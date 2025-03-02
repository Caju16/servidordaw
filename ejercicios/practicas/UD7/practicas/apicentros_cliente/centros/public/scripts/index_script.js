// AL CARGAR EL DOM, SE CARGAN LOS CENTROS, INSTALACIONES Y ACTIVIDADES
// SI EXISTE UN TOKEN, MOSTRARÁ EL BOTÓN DE CERRAR SESIÓN Y LOS DEMÁS OCULTOS

document.addEventListener("DOMContentLoaded", () => {
    if (localStorage.getItem("token")) {
        document.querySelectorAll(".login-button").forEach(button => button.style.display = "none");

        // Mostrar secciones de gestión si hay token
        document.getElementById("gestion-usuario").style.display = "block";
        document.getElementById("gestion-reservas").style.display = "block";
        document.getElementById("gestion-inscripciones").style.display = "block";

        mostrarInformacionUsuario();
    }

    // CARGAR CENTROS, INSTALACIONES Y ACTIVIDADES

    cargarCentros();
    cargarInstalaciones();
    cargarActividades();

    // RECUPERAR VALORES DE BÚSQUEDA DESDE LOCALSTORAGE

    document.getElementById("search-nombre-instalacion").value = localStorage.getItem("nombreInstalacion") || '';
    document.getElementById("search-descripcion-instalacion").value = localStorage.getItem("descripcionInstalacion") || '';
    document.getElementById("search-nombre-actividad").value = localStorage.getItem("nombreActividad") || '';
    document.getElementById("search-descripcion-actividad").value = localStorage.getItem("descripcionActividad") || '';

    // MANEJAR EL FORMULARIO DE BÚSQUEDA

    document.getElementById("search-form").addEventListener("submit", function(event) {
        event.preventDefault();
        const nombreInstalacion = document.getElementById("search-nombre-instalacion").value.trim();
        const descripcionInstalacion = document.getElementById("search-descripcion-instalacion").value.trim();
        const nombreActividad = document.getElementById("search-nombre-actividad").value.trim();
        const descripcionActividad = document.getElementById("search-descripcion-actividad").value.trim();
        
        const queryInstalacion = { nombre: nombreInstalacion, descripcion: descripcionInstalacion };
        const queryActividad = { nombre: nombreActividad, descripcion: descripcionActividad };
        console.log(queryInstalacion, queryActividad);

        // GUARDAR VALORES DE BÚSQUEDA EN LOCALSTORAGE

        localStorage.setItem("nombreInstalacion", nombreInstalacion);
        localStorage.setItem("descripcionInstalacion", descripcionInstalacion);
        localStorage.setItem("nombreActividad", nombreActividad);
        localStorage.setItem("descripcionActividad", descripcionActividad);

        // Verificar si todos los campos están vacíos
        if (!nombreInstalacion && !descripcionInstalacion && !nombreActividad && !descripcionActividad) {
            history.pushState(null, '', window.location.pathname);
        } else {
            // Actualizar la URL sin recargar la página
            const queryStringInstalacion = new URLSearchParams(queryInstalacion).toString();
            const queryStringActividad = new URLSearchParams(queryActividad).toString();
            const newUrl = `${window.location.pathname}?${queryStringInstalacion}&${queryStringActividad}`;
            history.pushState(null, '', newUrl);
        }

        buscarInstalaciones(queryInstalacion);
        buscarActividades(queryActividad);
    });
});

function mostrarInformacionUsuario() {
    const token = localStorage.getItem("token");
    if (!token) {
        return;
    }

    const decodedToken = jwt_decode(token);
    const userId = decodedToken.data[0];


    fetch(`http://apicentros.local/api/user?id=${userId}`, {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data) {
            document.getElementById("user-name").textContent = data.nombre;
            document.getElementById("user-email").textContent = data.email;
            document.getElementById("user-info").style.display = "block";
        } else {
            alert("Error al obtener la información del usuario.");
        }
    })
    .catch(error => console.error("Error:", error));
}

// CERRAR SESIÓN

function cerrarSesion() {
    localStorage.removeItem("token");
    window.location.href = "/";
}

// FUNCIÓN PARA REFRESCAR EL TOKEN

function refrescarToken() {
    const token = localStorage.getItem("token");
    
    fetch("http://apicentros.local/api/token/refresh", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${token}`
        }
    })
    .then(response => {
        console.log("Respuesta completa:", response);
        if (response.status === 401) {
            alert("El token ha caducado. Por favor, inicie sesión nuevamente.");
            cerrarSesion();
            return;
        }
        return response.json();
    })
    .then(data => {
        console.log("Datos recibidos:", data);
        
        if (data.jwt) {
            localStorage.setItem("token", data.jwt);
            alert("Token refrescado con éxito");
        } else {
            alert("Error al refrescar el token");
        }
    })
    .catch(error => console.error("Error:", error));
}

// FUNCIÓN PARA CARGAR LOS CENTROS

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

// OBTENER LAS INSTALACIONES ASOCIADAS AL CENTRO 

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

// OBTENER LAS ACTIVIDADES ASOCIADAS AL CENTRO

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

// OBTENER TODAS LAS INSTALACIONES

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

// OBTENER TODAS LAS ACTIVIDADES

function cargarActividades() {
    fetch("http://apicentros.local/api/actividades")
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            return response.json();
        })
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

// FUNCIÓN PARA BUSCAR INSTALACIONES

function buscarInstalaciones(query) {
    const queryString = new URLSearchParams(query).toString();
    fetch(`http://apicentros.local/api/instalaciones?${queryString}`)
        .then(response => {
            if (!response.ok) {
                if (response.status === 404) {
                    alert("La instalación que está buscando no existe.");
                } else {
                    throw new Error(`Error HTTP: ${response.status}`);
                }
                return [];
            }
            return response.json();
        })
        .then(instalaciones => {
            console.log("Instalaciones encontradas:", instalaciones);
            let lista = document.getElementById("instalaciones-list");
            lista.innerHTML = ''; // Limpiar la lista antes de mostrar los resultados
            instalaciones.forEach(instalacion => {
                let li = document.createElement("li");
                li.innerHTML = `<strong>🏛️ ${instalacion.nombre}</strong><br>
                                <span class="info">📌 Descripción: ${instalacion.descripcion}<br>
                                👥 Capacidad Máxima: ${instalacion.capacidad_maxima}</span>`;
                lista.appendChild(li);
            });
        })
        .catch(error => console.error("Error en fetch:", error));
}

// FUNCIÓN PARA BUSCAR ACTIVIDADES

function buscarActividades(query) {
    const queryString = new URLSearchParams(query).toString();
    fetch(`http://apicentros.local/api/actividades?${queryString}`)
        .then(response => {
            if (!response.ok) {
                if (response.status === 404) {
                    alert("La actividad que está buscando no existe.");
                } else {
                    throw new Error(`Error HTTP: ${response.status}`);
                }
                return [];
            }
            return response.json();
        })
        .then(actividades => {
            console.log("Actividades encontradas:", actividades);
            let lista = document.getElementById("actividades-list");
            lista.innerHTML = ''; // Limpiar la lista antes de mostrar los resultados
            actividades.forEach(actividad => {
                let li = document.createElement("li");
                li.innerHTML = `<strong>🎭 ${actividad.nombre}</strong><br>
                                <span class="info">📌 Descripción: ${actividad.descripcion}<br>
                                📅 Inicio: ${actividad.fecha_inicio} - Fin: ${actividad.fecha_final}<br>
                                ⏰ Horario: ${actividad.horario}<br>
                                👥 Plazas: ${actividad.plazas}</span>`;
                lista.appendChild(li);
            });
        })
        .catch(error => console.error("Error buscando actividades:", error));
}

// ELIMINAR USUARIO

function eliminarUsuario() {
    const token = localStorage.getItem("token");
    if (!token) {
        alert("No estás autenticado.");
        return;
    }

    const decodedToken = jwt_decode(token);
    const userId = decodedToken.data[0];

    if (confirm("¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.")) {
        fetch(`http://apicentros.local/api/user?id=${userId}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${token}`
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.message == "Usuario eliminado con éxito") {
                alert("Usuario eliminado con éxito.");
                localStorage.removeItem("token");
                window.location.href = "/";
            } else {
                alert("Error al eliminar el usuario: " + data.message);
            }
            
        })
        .catch(error => console.error("Error:", error));
    }
}

