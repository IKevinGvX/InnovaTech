<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspection Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos generales */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            overflow-x: hidden;
        }

        header {
            text-align: center;
            padding: 50px 20px;
            background: linear-gradient(135deg, #009688, #ffffff);
            color: #fff;
            animation: fadeIn 1s ease-in-out;
        }

        header h1 {
            font-size: 3em;
            margin-bottom: 10px;
        }

        header p {
            font-size: 1.5em;
            margin-top: 0;
        }

        .contacts {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 40px 20px;
        }

        .contact-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 280px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            animation: fadeInUp 1.5s ease-in-out;
        }

        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .contact-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .contact-info {
            padding: 15px;
            text-align: center;
        }

        .contact-info h3 {
            font-size: 1.5em;
            color: #333;
            margin: 10px 0;
        }

        .contact-info p {
            font-size: 1em;
            color: #555;
            margin-bottom: 15px;
        }

        .contact-info a {
            display: inline-block;
            text-decoration: none;
            background-color: #25D366;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 0.9em;
            transition: background-color 0.3s, transform 0.3s;
        }

        .contact-info a:hover {
            background-color: #1aa94f;
            transform: translateY(-2px);
        }

        footer {
            text-align: center;
            padding: 10px 20px;
            background: linear-gradient(135deg, #009688, #ffffff);
            color: #fff;
        }

        footer p {
            margin: 0;
            font-size: 0.9em;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 2.5em;
            }

            header p {
                font-size: 1.2em;
            }

            .contact-card {
                width: 100%;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
<header style="text-align: center; padding: 50px 20px; background: linear-gradient(135deg, #009688, #ffffff); color: #fff; animation: fadeIn 1s ease-in-out;">
    <h1 style="font-size: 3em; margin-bottom: 10px;">Contacto De Desarrollo</h1>
    <p style="font-size: 1.5em; margin-top: 0;">Your comprehensive source for detailed inspection data.</p>
    <button onclick="goBack()" style="margin-top: 20px; padding: 10px 20px; background-color: #4CAF50; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 1em; transition: background-color 0.3s;">
        Go Back
    </button>
</header>

<script>
    function goBack() {
        window.history.back();
    }
</script>


    <div class="contacts">
        <div class="contact-card">
            <img src="photo/kev1.jpg" alt="Front-End Specialist">
            <div class="contact-info">
                <h3>Robinzon Sanchez</h3>
                <p>Front-End Specialist focusing on modern web technologies like React, Angular, and Vue.js to deliver
                    responsive and visually stunning websites.</p>
                <a href="https://wa.me/1234567890" target="_blank">Contact via WhatsApp</a>
            </div>
        </div>

        <div class="contact-card">
            <img src="photo/kev.jpg" alt="Back-End Developer">
            <div class="contact-info">
                <h3>Khenbrind Hide </h3>
                <p>Back-End Developer experienced in building robust APIs, scalable architectures, and database
                    management using Node.js, PHP, and Python.</p>
                <a href="https://wa.me/0987654321" target="_blank">Contact via WhatsApp</a>
            </div>
        </div>

        <div class="contact-card">
            <img src="photo/kev3.jpg" alt="UX/UI Designer">
            <div class="contact-info">
                <h3>Solano Vergaraz </h3>
                <p>UX/UI Designer passionate about creating intuitive and user-friendly interfaces that enhance the user
                    experience and meet client goals.</p>
                <a href="https://wa.me/1122334455" target="_blank">Contact via WhatsApp</a>
            </div>
        </div>
        <div class="contact-card">
            <img src="photo/kev2.jpg" alt="DevOps Engineer">
            <div class="contact-info">
                <h3>Pacaya Vasquez </h3>
                <p>DevOps Engineer skilled in CI/CD pipelines, cloud infrastructure (AWS, Azure), and containerization
                    technologies like Docker and Kubernetes.</p>
                <a href="https://wa.me/6677889900" target="_blank">Contact via WhatsApp</a>
            </div>
        </div>
    </div>


    <footer>
        <p>© 2024 Inspection Report. All rights reserved.</p>
    </footer>
</body>

</html>