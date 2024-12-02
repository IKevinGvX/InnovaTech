<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up InnovaTech</title>
    <link rel="stylesheet" href="Style/style.css">

</head>

<body>
    <style>
        .toast {
            visibility: hidden;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .toast.show {
            visibility: visible;
            animation: fadeOut 3s forwards;
        }

        .toast .message {
            background-color: #28a745;
            color: white;
            font-size: 24px;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                visibility: hidden;
            }
        }
    </style>
    <form action="../Controller/RegistroUsuario.php" method="POST">
        <div class="container">
            <div class="top"></div>
            <div class="bottom"></div>
            <div class="center">
                <h1>InnovaTech</h1>
                <h2 class="button-container">Sign Up</h2>
                <input type="email" name="email" placeholder="Ingresa tu nuevo Correo" required>
                <input type="password" name="contraseña" placeholder="Ingresa tu nueva contraseña" required>
                <input type="date" name="fecha" id="fecha" placeholder="Fecha" required>
                <input type="hidden" id="rol_id" value="7" name="rol_id" />
                <div class="button-container">
                    <button class="fire-button" type="submit">
                        <span class="flame"></span>
                        Registrarte
                    </button>
                    <h2>Ya tienes cuenta?</h2>
                    <a href="Loggin.php" class="fire-button">
                        <span class="flame"></span>Inicia sesión aquí
                    </a>
                </div>
            </div>
        </div>

        <?php
        session_start();
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            $message_type = $_SESSION['message_type']; // success o error
            echo "<div id='toast' class='toast show'><div class='message'>$message</div></div>";

            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>

        <script>
            window.onload = function () {
                var toast = document.getElementById("toast");

                if (toast) {
                    setTimeout(function () {
                        toast.classList.remove("show");
                        // Redirigir a Login después de 3 segundos
                        window.location.href = "Loggin.php";
                    }, 3000); // Desaparece después de 3 segundos
                }
            }
        </script>

        <script>
            var fechaInput = document.getElementById('fecha');
            var hoy = new Date();
            var anio = hoy.getFullYear();
            var mes = ("0" + (hoy.getMonth() + 1)).slice(-2);
            var dia = ("0" + hoy.getDate()).slice(-2);
            fechaInput.value = anio + '-' + mes + '-' + dia;
        </script>
    </form>
</body>

</html>