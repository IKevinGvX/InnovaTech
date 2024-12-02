<?php
$error_message = "";
if (isset($_GET['error'])) {
    if ($_GET['error'] == "email_not_registered") {
        $error_message = "El correo no está registrado.";
    } elseif ($_GET['error'] == "incorrect_password") {
        $error_message = "La contraseña es incorrecta.";
    }
}

// Redirigir a login después de 5 segundos
header("refresh:5;url=Loggin.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotFault>InnovaTech</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: red;
        }

        .error-message {
            font-size: 24px;
            text-align: center;
        }

        .redirect-message {
            margin-top: 20px;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="error-message">
        <p><?php echo $error_message; ?></p>
    </div>
    <div class="redirect-message">
        <p>Error De Contraseña , Click En Recuperar Contraseña :
        <p>Redireccionando en :
        </p><span id="countdown">5</span> segundos...</p>
    </div>

    <script>
        // Countdown before redirection
        let countdown = 5;
        const countdownElement = document.getElementById('countdown');
        const interval = setInterval(function () {
            countdown--;
            countdownElement.textContent = countdown;
            if (countdown <= 0) {
                clearInterval(interval);
            }
        }, 1000);
    </script>
</body>

</html>