document.addEventListener("DOMContentLoaded", () => {
    const selectElement = document.getElementById("actividad");
    cargarActividades(selectElement);

    const form = document.getElementById("new-inscripcion-form");
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
            id_actividad: document.getElementById("actividad").value,
            fecha_inscripcion: document.getElementById("fecha_inscripcion").value,
            estado: document.getElementById("estado").value
        };


        fetch("http://apicentros.local/api/inscripciones", {
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
                // alert("Inscripción creada correctamente.");
            } else {
                document.getElementById("msjErrorGeneral").textContent = "Error al crear la inscripción. Inténtelo de nuevo.";
            }
        })
    });
});