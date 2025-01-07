<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNOVATECH>RecoverPassword</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="Style/stylerecupera.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-900 text-white">
    <div class="absolute top-4 left-4 text-lg font-medium text-white fire-flame cursor-pointer">
        <a href="Loggin.php">Regresar a Inicio</a>
    </div>
    <div class="flex justify-center items-center h-screen">
        <div class="container relative w-full max-w-md p-8 rounded-lg shadow-xl animate__animated">
            <h2 class="text-center text-3xl font-bold text-purple-700 fire-flame mb-6">Recupera tu Contraseña</h2>
            <form action="RecuperacionContraseña.php" method="POST" id="recovery-form">
                <div class="mb-4">
                    <label for="email" class="block text-lg font-medium">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required placeholder="Ingresa tu correo electrónico"
                        class="mt-2 p-3 w-full bg-white text-black rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50" />
                </div>
                <div class="mb-4">
                    <button type="submit"
                        class="btn w-full py-3 bg-purple-600 text-white rounded-lg shadow-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                        Enviar Enlace de Recuperación
                    </button>
                </div>
                <div id="error-message" class="text-center text-red-500 text-sm mt-4"></div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("recovery-form").addEventListener("submit", function (event) {
            event.preventDefault();
            const email = document.getElementById("email").value.trim();
            const errorMessage = document.getElementById("error-message");

            if (!email) {
                errorMessage.textContent = "Por favor, ingresa un correo electrónico.";
                return;
            }

            Swal.fire({
                title: '¡Correo Enviado!',
                text: 'Te hemos enviado un enlace de recuperación a tu correo.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = "Loggin.php";
            });
        });
    </script>
</body>

</html>