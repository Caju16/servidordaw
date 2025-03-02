document.addEventListener("DOMContentLoaded", () => {
    const selectElement = document.getElementById("instalacion");
    cargarInstalaciones(selectElement);

    const form = document.getElementById("new-reserva-form");
    form.addEventListener("submit", function(event) {
        // event.preventDefault();

        const token = localStorage.getItem("token");
        const decodedToken = jwt_decode(token);
        const userId = decodedToken.data[0];

        const data = {
            nombre_solicitante: document.getElementById("nombre").value,
            id_usuario: userId,
            telefono: document.getElementById("telefono").value,
            email: document.getElementById("email").value,
            id_instalacion: document.getElementById("instalacion").value,
            fecha_hora_inicio: document.getElementById("fecha_hora_inicio").value,
            fecha_hora_final: document.getElementById("fecha_hora_final").value,
            estado: document.getElementById("estado").value
        };

        console.log(data);
        
        fetch("http://apicentros.local/api/reservas", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${token}`
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(responseData => {
            if (responseData.success) {
                alert("Reserva creada correctamente.");
                window.location.href = "/";
            } else {
                document.getElementById("msjErrorGeneral").textContent = "Error al crear la reserva. Inténtelo de nuevo.";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            document.getElementById("msjErrorGeneral").textContent = "Error al conectar con el servidor. Inténtelo de nuevo.";
        });
    });
});
