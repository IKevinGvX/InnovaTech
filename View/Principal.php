<!DOCTYPE html>
<html lang="es">
<?php
include_once '../Model/Conexion.php';
include_once '../Controller/ProductoController.php';
include_once '../Controller/AlmacenController.php';

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
    <link rel="stylesheet" href="CenterStyles/principal.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="CenterStyles/innovatech.webp">
                <img src="CenterStyles/innovatech.webp" alt="InnovaTech Logo" width="40" height="40"
                    class="d-inline-block align-text-top">
                InnovaTech
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
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
                        <a class="nav-link" href="empleados.php">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="proveedores.php">Proveedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="almacenes.php">Almacen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="clientes.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="usuarios.php">Usuarios</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center text-light mb-5" style="animation: glowingText 1.5s infinite alternate;">Home
        </h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Productos</div>
                    <div class="card-body">
                        <h4>Total Productos</h4>
                        <h2 class="text-success">
                            <?php echo number_format($total_productos); ?>
                        </h2>
                        <a href="productos.php" class="btn-glow">Ver Productos</a>
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
                    <div class="card-header">Clientes</div>
                    <div class="card-body">
                        <h4>Total Clientes</h4>
                        <h2 class="text-success">
                            <?php echo number_format($total_productos); ?>
                        </h2>
                        <a href="clientes.php" class="btn-glow">Ver Clientes</a>
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
                    <div class="card-header">Empleados</div>
                    <div class="card-body">
                        <h4>Total Empleados</h4>
                        <h2 class="text-success">
                            <?php echo number_format($total_productos); ?>
                        </h2>
                        <a href="empleados.php" class="btn-glow">Ver Empleados</a>
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
                    <div class="card-header">Almacen</div>
                    <div class="card-body">
                        <h4>Total Almacen</h4>
                        <h2 class="text-success">
                            <?php echo number_format($total_productos); ?>
                        </h2>
                        <a href="almacenes.php" class="btn-glow">Ver Almacen</a>
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
                    <div class="card-header">Gestion Usuarios</div>
                    <div class="card-body">
                        <h4>Total Usuarios</h4>
                        <h2 class="text-success">
                            <?php echo number_format($total_productos); ?>
                        </h2>
                        <a href="usuarios.php" class="btn-glow">Ver Usuarios</a>
                    </div>
                    <div class="card-footer">
                        <div class="icon-container">
                            <i class="fas fa-box-open"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <h2 class="text-center text-light mb-4" style="animation: glowingText 1.5s infinite alternate;">Reportes
                </h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Reporte de Entregas</div>
                            <div class="card-body">
                                <h4>Analiza las Entregas</h4>
                                <p>Consulta reportes detallados de las Entregas realizadas por periodo.</p>
                                <a href="entregas.php" class="btn-glow">Ver Reporte</a>
                            </div>
                            <div class="card-footer">
                                <div class="icon-container">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Reporte de Inventarios</div>
                            <div class="card-body">
                                <h4>Control de inventario</h4>
                                <p>Genera reportes de inventarios actuales, productos agotados y más.</p>
                                <a href="controlinventario.php" class="btn-glow">Ver Reporte</a>
                            </div>
                            <div class="card-footer">
                                <div class="icon-container">
                                    <i class="fas fa-box"></i>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>

        </div>
    </div><br>

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