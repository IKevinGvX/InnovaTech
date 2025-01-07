<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimientos</title>
    
    <!-- Estilos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
        .form-container form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            border: none;
            padding: 12px;
            text-align: center;
            transition: background-color 0.3s ease-in-out;
        }
        th {
            background: linear-gradient(45deg, #4CAF50, #2E8B57);
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        td {
            background-color: #f9f9f9;
        }
        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }
        tr:hover td {
            background-color: #d9f2d9;
        }
        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        #chart-total-vendido {
            margin-top: 50px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <h1>Reporte de Movimientos Robusto</h1>
    <div class="filters-container">
        <form id="filtroForm" method="POST" action="">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="fecha_inicio" class="form-label">Fecha Inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                </div>
                <div class="col-auto">
                    <label for="fecha_fin" class="form-label">Fecha Fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
                </div>
                <div class="col-auto">
                    <label for="tipo_movimiento" class="form-label">Tipo de Movimiento:</label>
                    <select id="tipo_movimiento" name="tipo_movimiento" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Salida">Salida</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Enviado">Enviado</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" name="filtrar" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
    </div>

    <hr>

    <?php
    if (isset($_POST['filtrar'])) {
        $host = "localhost";
        $user = "root";
        $password = ""; 
        $database = "tp_web"; 

        $conn = new mysqli($host, $user, $password, $database);

        if ($conn->connect_error) {
            echo "<script>
                Swal.fire('Error', 'No se pudo conectar a la base de datos.', 'error');
            </script>";
            die();
        }

        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $tipo_movimiento = $_POST['tipo_movimiento'];

        $sql = "SELECT total, cliente_id, almacen_id, fecha_envio, tipo_movimiento 
                FROM movimiento_almacen_destinado
                WHERE fecha_envio BETWEEN ? AND ? AND tipo_movimiento = ?
                ORDER BY fecha_envio";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $fecha_inicio, $fecha_fin, $tipo_movimiento);
        $stmt->execute();
        $result = $stmt->get_result();

        $total_vendido = 0;

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Total</th><th>Cliente ID</th><th>Almacén ID</th><th>Fecha Envío</th><th>Tipo Movimiento</th></tr>";

            $totales = [];
            $fechas = [];

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['total'] . "</td>";
                echo "<td>" . $row['cliente_id'] . "</td>";
                echo "<td>" . $row['almacen_id'] . "</td>";
                echo "<td>" . $row['fecha_envio'] . "</td>";
                echo "<td>" . $row['tipo_movimiento'] . "</td>";
                echo "</tr>";

                $totales[] = $row['total'];
                $fechas[] = $row['fecha_envio'];
                $total_vendido += $row['total'];
            }

            echo "</table>";

            echo "<div class='mt-3'>";
            echo "<h4>Total Vendido: <strong>" . number_format($total_vendido, 2) . "</strong></h4>";
            echo "</div>";
        } else {
            echo "<script>
                Swal.fire('Sin Resultados', 'No se encontraron datos para los filtros seleccionados.', 'info');
            </script>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
    <div class="button-group">
        <button class="btn btn-secondary" id="btnReset" onclick="resetForm()">Limpiar Todo</button>
        <button class="btn btn-dark" onclick="goBack()">Volver</button>
    </div>
    <div id="chart-total-vendido">
        <canvas id="chartTotal"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labelsTotal = <?php echo json_encode($fechas ?? []); ?>;
        const dataTotal = {
            labels: labelsTotal,
            datasets: [{
                label: 'Total Vendido',
                data: <?php echo json_encode($totales ?? []); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        const configTotal = {
            type: 'bar',
            data: dataTotal,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Gráfico de Total Vendido por Fecha'
                    }
                }
            },
        };

        const chartTotal = new Chart(
            document.getElementById('chartTotal'),
            configTotal
        );
        function resetForm() {
            document.getElementById('filtroForm').reset();
            location.reload();
        }
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
