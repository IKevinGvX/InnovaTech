<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tp_web";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consultar datos de la tabla detallemovimiento
$sql = "SELECT 
            detalle_movimiento_id,
            almacen_id,
            movimiento_id,
            precio,
            cantidad,
            subtotal,
            fecha,
            producto_id
        FROM detalle_movimiento";

$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Inventario</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: #ffffff;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            max-width: 1200px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            color: #343a40;
        }

        h1 {
            text-align: center;
            font-weight: 800;
            font-size: 36px;
            text-shadow: 2px 4px rgba(0, 0, 0, 0.2);
        }

        .filter-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filter-bar select,
        .filter-bar input {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            outline: none;
            font-size: 16px;
        }

        .filter-bar button {
            padding: 10px 20px;
            background: #42a5f5;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .filter-bar button:hover {
            background: #1e88e5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        table thead {
            background: linear-gradient(145deg, #42a5f5, #1e88e5);
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
        }

        th {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            background: rgb(165, 92, 92);
        }

        table,
        table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            background: rgb(255, 255, 255);
        }

        table tbody tr:hover {
            background: rgb(8, 91, 102);
            transform: scale(1.02);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Reporte Inventario</h1>

        <div class="filter-bar">
            <select id="filterAlmacen">
                <option value="">Seleccionar Almacén</option>
            </select>
            <select id="filterMovimiento">
                <option value="">Seleccionar Movimiento</option>
            </select>
            <input type="date" id="filterFecha" placeholder="Seleccionar Fecha">
            <button id="generateChart">Realizar Reporte Gráfico</button>
            <button id="goToMain">Volver a Principal</button>
        </div>
        <script>
            document.getElementById('goToMain').addEventListener('click', function () {
                window.location.href = 'principal.php';
            });              
        </script>
        <table id="movimientoTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Almacén ID</th>
                    <th>Movimiento ID</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Fecha</th>
                    <th>Producto ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo $row['movimiento_id']; ?></td>
                        <td><?php echo $row['almacen_id']; ?></td>
                        <td><?php echo $row['movimiento_id']; ?></td>
                        <td><?php echo $row['precio']; ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td><?php echo $row['subtotal']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                        <td><?php echo $row['producto_id']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <canvas id="pieChart" style="max-width: 600px; margin: 20px auto;"></canvas>
    </div>

    <script>
        const data = <?php echo json_encode($data); ?>;
        const almacenSet = new Set();
        const movimientoSet = new Set();
        data.forEach(item => {
            almacenSet.add(item.almacen_id);
            movimientoSet.add(item.movimiento_id);
        });

        const almacenFilter = document.getElementById('filterAlmacen');
        const movimientoFilter = document.getElementById('filterMovimiento');

        almacenSet.forEach(almacen => {
            const option = document.createElement('option');
            option.value = almacen;
            option.textContent = `Almacén ${almacen}`;
            almacenFilter.appendChild(option);
        });

        movimientoSet.forEach(movimiento => {
            const option = document.createElement('option');
            option.value = movimiento;
            option.textContent = `Movimiento ${movimiento}`;
            movimientoFilter.appendChild(option);
        });

        const table = $('#movimientoTable').DataTable();

        almacenFilter.addEventListener('change', () => {
            table.column(1).search(almacenFilter.value).draw();
        });

        movimientoFilter.addEventListener('change', () => {
            table.column(2).search(movimientoFilter.value).draw();
        });

        document.getElementById('filterFecha').addEventListener('change', (e) => {
            table.column(6).search(e.target.value).draw();
        });

        $(document).ready(function () {
            if ($.fn.DataTable.isDataTable('#movimientoTable')) {
                $('#movimientoTable').DataTable().destroy();
            }
            $('#movimientoTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'pdf', 'print'],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                }
            });
        });

        document.getElementById('generateChart').addEventListener('click', () => {
            const cantidades = {};

            data.forEach(item => {
                cantidades[item.movimiento_id] = (cantidades[item.movimiento_id] || 0) + parseInt(item.cantidad);
            });

            const labels = Object.keys(cantidades);
            const valores = Object.values(cantidades);

            const ctx = document.getElementById('pieChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: valores,
                        backgroundColor: ['#42a5f5', '#66bb6a', '#ffca28', '#ef5350', '#ab47bc'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Distribución de Movimientos por Cantidad'
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>