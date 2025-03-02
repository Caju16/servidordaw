document.getElementById("edit-user-form").addEventListener("submit", function(event) {
            event.preventDefault();

            const nombre = document.getElementById("nombre").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const repassword = document.getElementById("repassword").value;

            if (password !== repassword) {
                alert("Las contraseñas no coinciden.");
                return;
            }

            const token = localStorage.getItem("token");
            const userData = { nombre, email, password };

            fetch("http://apicentros.local/api/user", {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${token}`
                },
                body: JSON.stringify(userData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === "Usuario actualizado con éxito") {
                    alert("Usuario actualizado con éxito.");
                    window.location.href = "/";
                } else {
                    alert("Error al actualizar el usuario: " + data.message);
                }
            })
            .catch(error => console.error("Error:", error));
        });

        // Obtener el token del localStorage y cargar los datos del usuario
        const token = localStorage.getItem("token");
        if (!token) {
            window.location.href = "/usuario/login";
        }

        fetch("http://apicentros.local/api/user", {
            method: "GET",
            headers: { "Authorization": `Bearer ${token}` }
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById("nombre").value = data.nombre;
                document.getElementById("email").value = data.email;
            } else {
                alert("Error al obtener los datos del usuario.");
            }
        })
        .catch(error => console.error("Error:", error));