<?php
require_once '../Model/Conexion.php';
require_once '../Controller/ProductoController.php';

$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new ProductController($db);

// Obtener datos de productos
$productos = $controller->obtenerProductoCategoria();
$data = [];
$labels = [];
$totalStock = 0;
if ($productos) {
    while ($producto = $productos->fetch_assoc()) {
        $labels[] = $producto['nombreproducto'];
        $data[] = $producto['stock'];
        $totalStock += $producto['stock'];
    }
}
$averageStock = $totalStock / count($data);
$maxStock = max($data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Gráfico Mejorado</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1A1A2E, #16213E);
            color: #FFFFFF;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0F3460;
            color: rgb(94, 7, 7);
            text-align: center;
            padding: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        header h1 {
            font-size: 2.8rem;
            margin: 0;
            color: #FFA500;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .container {
            width: 90%;
            margin: 50px auto;
            background: rgba(87, 13, 13, 0.42);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        }

        canvas {
            background: #FFFFFF;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        }

        .info-box {
            margin: 20px 0;
            padding: 10px;
            background: #16213E;
            color: #FFFFFF;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        }

        .info-box p {
            margin: 0;
            font-size: 1.2rem;
        }

        footer {
            background: #0F3460;
            color: rgb(129, 22, 22);
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0px -4px 8px rgba(0, 0, 0, 0.3);
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

        footer a {
            color: #FFA500;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .filter-container {
            margin-bottom: 20px;
            text-align: center;
        }

        .filter-container select {
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            border: 2px solid #FFA500;
            background: #1A1A2E;
            color: #FFFFFF;
            margin: 5px;
        }

        .export-button {
            background: #FFA500;
            color: #FFFFFF;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            transition: background 0.3s ease;
        }

        .export-button:hover {
            background: #FF6347;
        }

        .info-box {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            max-width: 400px;
            margin: 20px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-family: 'Arial', sans-serif;
            text-align: center;
        }

        .info-box p {
            margin: 10px 0;
            color: #333;
            font-size: 16px;
        }

        .info-box a {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .info-box a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <h1>Reporte Gráfico - INNOVATECH</h1>
    </header>
    <div class="container">
        <h2 style="text-align: center; color: #16213E; font-size: 2rem;">Stock de Productos</h2>
        <div class="info-box">
            <p><strong>Promedio de Stock:</strong> <?= round($averageStock, 2) ?></p>
            <p><strong>Máximo de Stock:</strong> <?= $maxStock ?></p>
            <a href="productos.php" id="categorize-button">Come Back</a>

        </div>
        <div class="filter-container">
            <label for="chartType">Tipo de gráfico:</label>
            <select id="chartType">
                <option value="line">Líneas</option>
            </select>

            <label for="maxProducts">Cantidad de productos:</label>
            <select id="maxProducts">
                <?php for ($i = 1; $i <= count($labels); $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>

            <label for="minStock">Mínimo stock:</label>
            <select id="minStock">
                <?php for ($i = 0; $i <= $maxStock; $i += 10): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>

            <label for="maxStock">Máximo stock:</label>
            <select id="maxStock">
                <?php for ($i = 10; $i <= $maxStock; $i += 10): ?>
                    <option value="<?= $i ?>" <?= $i == $maxStock ? 'selected' : '' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>

            <button class="export-button" id="applyFilters">Aplicar Filtros</button>
            <button class="export-button" id="exportChart">Exportar Gráfico</button>
        </div>
        <canvas id="stockChart"></canvas>
    </div>

    <footer>
        <p>&copy; <?= date('Y') ?> INNOVATECH. Todos los derechos reservados. <a href="#">Términos de uso</a> | <a
                href="#">Política de privacidad</a></p>
    </footer>

    <script>
        const originalLabels = <?= json_encode($labels) ?>;
        const originalData = <?= json_encode($data) ?>;

        const ctx = document.getElementById('stockChart').getContext('2d');
        let stockChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: originalLabels,
                datasets: [{
                    label: 'Cantidad en Stock',
                    data: originalData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#000000',
                            font: {
                                size: 22
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.raw / total) * 100).toFixed(2);
                                return `${context.raw} unidades (${percentage}%)`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#000000',
                            font: {
                                size: 18
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000000',
                            font: {
                                size: 20
                            }
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutBounce'
                }
            }
        });

        document.getElementById('applyFilters').addEventListener('click', function () {
            const maxProducts = parseInt(document.getElementById('maxProducts').value);
            const minStock = parseInt(document.getElementById('minStock').value);
            const maxStock = parseInt(document.getElementById('maxStock').value);

            const filteredLabels = [];
            const filteredData = [];

            for (let i = 0; i < originalLabels.length; i++) {
                if (originalData[i] >= minStock && originalData[i] <= maxStock) {
                    filteredLabels.push(originalLabels[i]);
                    filteredData.push(originalData[i]);
                }

                if (filteredLabels.length >= maxProducts) {
                    break;
                }
            }

            stockChart.data.labels = filteredLabels;
            stockChart.data.datasets[0].data = filteredData;
            stockChart.update();
        });

        document.getElementById('exportChart').addEventListener('click', function () {
            const link = document.createElement('a');
            link.href = stockChart.toBase64Image();
            link.download = 'grafico_stock.png';
            link.click();
        });
    </script>
</body>

</html>