<?php
function exportarXML($productos)
{
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><productos></productos>');

    while ($row = $productos->fetch_assoc()) {
        $producto = $xml->addChild('producto');
        $producto->addChild('producto_id', $row['producto_id']);
        $producto->addChild('nombre_producto', $row['nombre_producto']);
        $producto->addChild('descripcion', $row['descripcion']);
        $producto->addChild('precio', $row['precio']);
        $producto->addChild('stock', $row['stock']);
        $producto->addChild('categoria', $row['descripcion']);
    }

    Header('Content-type: text/xml');
    echo $xml->asXML();
}
function exportarXMLPorID($producto_id, $connection)
{
    $sql = "SELECT * FROM productos WHERE producto_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><producto></producto>');
        $xml->addChild('producto_id', $row['producto_id']);
        $xml->addChild('nombre_producto', $row['nombre_producto']);
        $xml->addChild('descripcion', $row['descripcion']);
        $xml->addChild('precio', $row['precio']);
        $xml->addChild('stock', $row['stock']);
        $xml->addChild('categoria', $row['descripcion']);

        Header('Content-type: text/xml');
        echo $xml->asXML();
    } else {
        echo "Producto no encontrado.";
    }
}
require('fpdf.php');

function exportarPDF($productos)
{
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(30, 10, 'Producto ID', 1);
    $pdf->Cell(40, 10, 'Nombre Producto', 1);
    $pdf->Cell(60, 10, 'Descripcion', 1);
    $pdf->Cell(30, 10, 'Precio', 1);
    $pdf->Cell(30, 10, 'Stock', 1);
    $pdf->Cell(30, 10, 'Categoria', 1);
    $pdf->Ln();

    while ($row = $productos->fetch_assoc()) {
        $pdf->Cell(30, 10, $row['producto_id'], 1);
        $pdf->Cell(40, 10, $row['nombre_producto'], 1);
        $pdf->Cell(60, 10, $row['descripcion'], 1);
        $pdf->Cell(30, 10, $row['precio'], 1);
        $pdf->Cell(30, 10, $row['stock'], 1);
        $pdf->Cell(30, 10, $row['descripcion'], 1);
        $pdf->Ln();
    }

    $pdf->Output();
}
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function exportarExcel($productos)
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'Producto ID');
    $sheet->setCellValue('B1', 'Nombre Producto');
    $sheet->setCellValue('C1', 'Descripcion');
    $sheet->setCellValue('D1', 'Precio');
    $sheet->setCellValue('E1', 'Stock');
    $sheet->setCellValue('F1', 'Categoria');

    $rowNum = 2; // Comienza en la segunda fila
    while ($row = $productos->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNum, $row['producto_id']);
        $sheet->setCellValue('B' . $rowNum, $row['nombre_producto']);
        $sheet->setCellValue('C' . $rowNum, $row['descripcion']);
        $sheet->setCellValue('D' . $rowNum, $row['precio']);
        $sheet->setCellValue('E' . $rowNum, $row['stock']);
        $sheet->setCellValue('F' . $rowNum, $row['descripcion']);
        $rowNum++;
    }

    $writer = new Xlsx($spreadsheet);
    $writer->save('productos.xlsx');
    echo "Reporte Excel generado.";
}

?>