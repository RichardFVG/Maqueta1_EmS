<?php
require_once 'BaseController.php';

// (NUEVO) Importamos las clases de PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class FacturaController extends BaseController {
    
    // Muestra la lista de facturas
    public function index() {
        $factura = new Factura();
        $facturas = $factura->getAll();
        $this->renderView('factura/index', ['facturas' => $facturas]);
    }

    // Crear factura (formulario y guardado)
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fecha = $_POST['fecha'];
            $cliente = $_POST['cliente'];
            $servicio = $_POST['servicio'];
            $total = $_POST['total'];

            $factura = new Factura();
            $factura->setFecha($fecha);
            $factura->setCliente($cliente);
            $factura->setServicio($servicio);
            $factura->setTotal($total);
            $factura->save();

            header("Location: index.php?controller=Factura&action=index");
        } else {
            $this->renderView('factura/create');
        }
    }

    // Editar factura (formulario y actualización)
    public function edit() {
        if (isset($_GET['id'])) {
            $factura = new Factura();
            $factura->setId($_GET['id']);
            $facturaActual = $factura->getOne();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $fecha = $_POST['fecha'];
                $cliente = $_POST['cliente'];
                $servicio = $_POST['servicio'];
                $total = $_POST['total'];

                $factura->setFecha($fecha);
                $factura->setCliente($cliente);
                $factura->setServicio($servicio);
                $factura->setTotal($total);
                $factura->update();

                header("Location: index.php?controller=Factura&action=index");
            } else {
                $this->renderView('factura/edit', ['factura' => $facturaActual]);
            }
        } else {
            header("Location: index.php?controller=Factura&action=index");
        }
    }

    // Eliminar factura
    public function delete() {
        if (isset($_GET['id'])) {
            $factura = new Factura();
            $factura->setId($_GET['id']);
            $factura->delete();
        }
        header("Location: index.php?controller=Factura&action=index");
    }

    // (MODIFICADO) Descargar facturas en verdadero formato XLS con PhpSpreadsheet
    public function downloadXls() {
        // 1) Obtenemos los datos de la BD
        $factura = new Factura();
        $facturas = $factura->getAll();

        // 2) Creamos la hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Facturas');

        // 3) Cabeceras en la primera fila
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Fecha');
        $sheet->setCellValue('C1', 'Cliente');
        $sheet->setCellValue('D1', 'Servicio');
        $sheet->setCellValue('E1', 'Total');

        // 4) Insertar filas
        $rowNumber = 2;
        foreach ($facturas as $fact) {
            $sheet->setCellValue('A'.$rowNumber, $fact['id']);
            $sheet->setCellValue('B'.$rowNumber, $fact['fecha']);
            $sheet->setCellValue('C'.$rowNumber, $fact['cliente']);
            $sheet->setCellValue('D'.$rowNumber, $fact['servicio']);
            $sheet->setCellValue('E'.$rowNumber, $fact['total']);
            $rowNumber++;
        }

        // 5) Ajustar anchos de columna (opcional)
        foreach (['A','B','C','D','E'] as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // 6) Cabeceras HTTP para forzar la descarga como .xls
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="facturas.xls"');
        header('Cache-Control: max-age=0');

        // 7) Generamos el archivo y lo enviamos al navegador
        //    Usamos la clase Xls para generar un archivo .xls
        $writer = new Xls($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    // Filtrar facturas por fecha (formulario y resultado)
    public function filterDate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];

            $factura = new Factura();
            $facturas = $factura->filterByDateRange($startDate, $endDate);
            $this->renderView('factura/index', ['facturas' => $facturas]);
        } else {
            $this->renderView('factura/filterDate');
        }
    }
}
