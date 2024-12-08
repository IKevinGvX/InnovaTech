<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'generateXML':
            exportarXML($productos);
            break;
        case 'generatePDF':
            generatePDF();
            break;
        case 'generateExcel':
            generateExcel();
            break;
    }
}


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

function generatePDF()
{
}

function generateExcel()
{
}

?>