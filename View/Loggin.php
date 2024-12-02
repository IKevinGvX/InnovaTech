<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In InnovaTech</title>
    <link rel="stylesheet" href="Style/style.css">
    <style>
        #loading-message {
            display: none;
            color: #ff4d94;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            z-index: 9999;
        }

        .small-link {
            font-size: 14px;
            color: blue;
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <form action="Seguridad.php" method="POST" id="login-form">
        <div class="container">
            <div class="top"></div>
            <div class="bottom"></div>
            <div class="center">
                <h1>InnovaTech</h1>
                <h2 class="button-container">Please Sign In</h2>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>
                <input type="password" id="contrasena" name="contrasena" placeholder="Enter Password" required>
                <div class="error-message" id="error-message"></div>
                <h3 class="button-container">
                    ¿Forgot Your Password?
                    <a class="small-link" href="RecuperacionContraseña.php">Click Here</a>
                </h3>
                <div class="button-container">
                    <button class="fire-button" type="submit" id="submit-button">
                        <span class="flame"></span>
                        Access
                    </button>
                    <h2 class="button-container">¿You don't have an account?
                    </h2>
                    <a href="Registrar.php" class="fire-button">
                        <span class="flame"></span>
                        Here
                    </a>
                </div>
            </div>
        </div>
    </form>
    <div id="loading-message">Loading...</div>
    <script>
        document.getElementById('login-form').addEventListener('submit', function (event) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('contrasena').value.trim();
            const errorMessage = document.getElementById('error-message');

            if (!email || !password) {
                event.preventDefault();
                errorMessage.textContent = "Por favor, completa todos los campos.";
                return;
            }

            document.getElementById('loading-message').style.display = 'block';

            setTimeout(() => {
                document.getElementById('login-form').submit();
            }, 3000);

            event.preventDefault();
        });
    </script>
</body>

</html>