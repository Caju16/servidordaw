document.addEventListener("DOMContentLoaded", () => {
    const token = localStorage.getItem("token");
    if (!token) {
        window.location.href = "/usuario/login";
        return;
    }

    const decodedToken = jwt_decode(token);
    const userId = decodedToken.data[0];

    // Obtener todas las instalaciones
    fetch("http://apicentros.local/api/instalaciones", {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        }
    })
    .then(response => response.json())
    .then(instalaciones => {
        const instalacionesMap = new Map();
        instalaciones.forEach(instalacion => {
            instalacionesMap.set(instalacion.id, instalacion.nombre);
        });

        // Obtener las reservas del usuario
        fetch(`http://apicentros.local/api/reservas?user_id=${userId}`, {
            method: "GET",
            headers: {
                "Authorization": `Bearer ${token}`
            }
        })
        .then(response => response.json())
        .then(reservas => {
            const reservasList = document.getElementById("reservas-list");
            reservas.forEach(reserva => {
                const nombreInstalacion = instalacionesMap.get(reserva.id_instalacion) || "Desconocida";
                const li = document.createElement("li");
                li.innerHTML = `<strong>👤 Nombre del Solicitante: ${reserva.nombre_solicitante}</strong><br>
                                <span class="info">📞 Teléfono: ${reserva.telefono}<br>
                                📧 Email: ${reserva.email}<br>
                                🏢 Instalación: ${nombreInstalacion}<br>
                                🕒 Fecha y Hora de Inicio: ${reserva.fecha_hora_inicio}<br>
                                🕒 Fecha y Hora de Final: ${reserva.fecha_hora_final}<br>
                                📋 Estado: ${reserva.estado}</span><br/>
                                <button class="cancel-button" onclick="cancelarReserva(${reserva.id})">Cancelar Reserva</button>`;
                reservasList.appendChild(li);
            });
        })
        .catch(error => console.error("Error cargando reservas:", error));
    })
    .catch(error => console.error("Error cargando instalaciones:", error));
});

function cancelarReserva(reservaId) {
    if (confirm("¿Estás seguro de que deseas cancelar esta reserva? Esta acción no se puede deshacer.")) {
        const token = localStorage.getItem("token");
        fetch(`http://apicentros.local/api/reservas/${reservaId}`, {
            method: "DELETE",
            headers: {
                "Authorization": `Bearer ${token}`
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.message == "Reserva eliminada con éxito") {
                alert("Reserva cancelada con éxito.");
                window.location.reload();
            } else {
                alert("Error al cancelar la reserva: " + data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    }
}