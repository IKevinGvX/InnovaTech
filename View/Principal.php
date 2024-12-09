<!DOCTYPE html>
<html lang="es">
<?php
include_once '../Model/Conexion.php';
include_once '../Controller/ProductoController.php';

$db = new Conexion();
$connection = $db->getConnection();

$productController = new ProductController($connection);

$total_productos = $productController->obtenerallproducts();
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME INNOVATECH</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: #1A1A2E;
            color: white;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #0F4B5B;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar .navbar-brand {
            font-weight: bold;
            color: #00BFFF;
        }

        .navbar .navbar-nav .nav-link {
            color: #00BFFF;
        }

        .navbar .navbar-nav .nav-link:hover {
            color: #00FFFF;
        }

        @keyframes glowingText {
            0% {
                text-shadow: 0 0 5px #00BFFF, 0 0 10px #00BFFF, 0 0 15px #00BFFF;
            }

            50% {
                text-shadow: 0 0 10px #00BFFF, 0 0 20px #00BFFF, 0 0 30px #00BFFF;
            }

            100% {
                text-shadow: 0 0 15px #00BFFF, 0 0 25px #00BFFF, 0 0 35px #00BFFF;
            }
        }

        .card {
            background-color: #2F3A3D;
            border: 2px solid #00BFFF;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
            animation: glowingText 1.5s infinite alternate;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-header {
            background-color: #1F6B72;
            color: white;
            font-weight: bold;
            font-size: 18px;
            border-radius: 15px 15px 0 0;
            text-align: center;
        }

        .card-body {
            text-align: center;
        }

        .card-body h4 {
            font-size: 24px;
            margin: 20px 0;
        }

        .btn-glow {
            background-color: #00BFFF;
            color: white;
            border-radius: 25px;
            padding: 10px 25px;
            box-shadow: 0 0 10px #00BFFF;
            transition: all 0.3s ease-in-out;
        }

        .btn-glow:hover {
            box-shadow: 0 0 20px #00BFFF;
            transform: scale(1.1);
        }

        .container {
            margin-top: 50px;
        }

        /* Grid para cartas */
        .row {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .card-footer {
            background-color: #1A1A2E;
            text-align: center;
            border-radius: 0 0 15px 15px;
        }

        /* Animación para iconos */
        .icon-container i {
            font-size: 40px;
            color: #00BFFF;
            animation: glowingText 1.5s infinite alternate;
        }

        /* Estilos del pie de página */
        footer {
            background-color: #0F4B5B;
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        footer .social-icons a {
            color: white;
            font-size: 30px;
            margin: 0 15px;
            transition: all 0.3s ease;
        }

        footer .social-icons a:hover {
            color: #00FFFF;
            transform: scale(1.2);
        }

        footer .info {
            margin-top: 20px;
        }

        footer .info p {
            font-size: 18px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand">InnovaTech</a>
            <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="Principal.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Proveedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Almacen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Usuarios</a>
                    </li>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1 class="text-center text-light mb-5" style="animation: glowingText 1.5s infinite alternate;">Home
        </h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Inventario</div>
                    <div class="card-body">
                        <h4>Total Productos</h4>
                        <h2 class="text-success">
                            <?php echo number_format($total_productos); ?>
                        </h2>
                        <button class="btn-glow">Ver Inventario</button>
                    </div>
                    <div class="card-footer">
                        <div class="icon-container">
                            <i class="fas fa-box-open"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Reportes</div>
                    <div class="card-body">
                        <h4>Generar Reportes</h4>
                        <button class="btn-glow">Ver Reportes</button>
                    </div>
                    <div class="card-footer">
                        <div class="icon-container">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Ventas</div>
                    <div class="card-body">
                        <h4>Realizar Venta</h4>
                        <button class="btn-glow">Hacer Venta</button>
                    </div>
                    <div class="card-footer">
                        <div class="icon-container">
                            <i class="fas fa-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Administración</div>
                    <div class="card-body">
                        <h4>Gestión del Sistema</h4>
                        <button class="btn-glow">Configuraciones</button>
                    </div>
                    <div class="card-footer">
                        <div class="icon-container">
                            <i class="fas fa-cogs"></i>
                        </div>
                    </div>
                </div><br>
                <br>
            </div>
        </div>
    </div>

    <footer>
        <div class="social-icons">
            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/?lang=es" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://pe.linkedin.com/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
        <div class="info">
            <p>&copy;ElectroTec 2024: Commitment to Innovation and Excellence
                At ElectroTec, our mission is to be leaders in the market for household</p>
            <p>appliances and technological maintenance services, offering innovative and personalized solutions
                that
                exceed our customers' expectations.</p>
            <p>Our commitment focuses on:
            </p>
            <p>
                Guaranteed Quality: We provide products and services backed by the highest standards of quality and
                durability.
            </p>
            <p>
                Customer Satisfaction: We strive to offer a unique experience, addressing the specific needs of each
                client with an agile and professional approach.
            </p>
            <p>
                Continuous Innovation: We incorporate cutting-edge technology to constantly improve our offering and
                adapt to market trends.
            </p>
            <p>
                Responsibility and Sustainability: We operate responsibly, promoting sustainable practices and
                contributing to the well-being of our community.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>