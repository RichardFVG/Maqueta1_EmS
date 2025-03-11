<?php
require_once 'BaseController.php';

// (NUEVO) Importamos las clases de PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class CompraController extends BaseController {

    // 1) Listar todas las compras
    public function index() {
        $compra = new Compra();
        $compras = $compra->getAll();
        $this->renderView('compra/index', ['compras' => $compras]);
    }

    // 2) Crear compra
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente = $_POST['cliente'];
            $producto = $_POST['producto'];
            $fecha = $_POST['fecha'];
            $monto = $_POST['monto'];

            $compra = new Compra();
            $compra->setCliente($cliente);
            $compra->setProducto($producto);
            $compra->setFecha($fecha);
            $compra->setMonto($monto);
            $compra->save();

            header("Location: index.php?controller=Compra&action=index");
        } else {
            $this->renderView('compra/create');
        }
    }

    // 3) Editar compra
    public function edit() {
        if (isset($_GET['id'])) {
            $compra = new Compra();
            $compra->setId($_GET['id']);
            $compraActual = $compra->getOne();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $cliente = $_POST['cliente'];
                $producto = $_POST['producto'];
                $fecha = $_POST['fecha'];
                $monto = $_POST['monto'];

                $compra->setCliente($cliente);
                $compra->setProducto($producto);
                $compra->setFecha($fecha);
                $compra->setMonto($monto);
                $compra->update();

                header("Location: index.php?controller=Compra&action=index");
            } else {
                $this->renderView('compra/edit', ['compra' => $compraActual]);
            }
        } else {
            header("Location: index.php?controller=Compra&action=index");
        }
    }

    // 4) Eliminar compra
    public function delete() {
        if (isset($_GET['id'])) {
            $compra = new Compra();
            $compra->setId($_GET['id']);
            $compra->delete();
        }
        header("Location: index.php?controller=Compra&action=index");
    }

    // (MODIFICADO) 5) Descargar todas las compras en .xls real
    public function downloadXls() {
        $compra = new Compra();
        $compras = $compra->getAll();

        // 1) Crear Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Compras');

        // 2) Encabezados
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Cliente');
        $sheet->setCellValue('C1', 'Producto');
        $sheet->setCellValue('D1', 'Fecha');
        $sheet->setCellValue('E1', 'Monto');

        // 3) Llenar filas
        $rowNumber = 2;
        foreach ($compras as $c) {
            $sheet->setCellValue('A'.$rowNumber, $c['id']);
            $sheet->setCellValue('B'.$rowNumber, $c['cliente']);
            $sheet->setCellValue('C'.$rowNumber, $c['producto']);
            $sheet->setCellValue('D'.$rowNumber, $c['fecha']);
            $sheet->setCellValue('E'.$rowNumber, $c['monto']);
            $rowNumber++;
        }

        // 4) Ajustar anchos (opcional)
        foreach (['A','B','C','D','E'] as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // 5) Forzar descarga
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="compras.xls"');
        header('Cache-Control: max-age=0');

        // 6) Generamos el archivo y lo enviamos al navegador
        $writer = new Xls($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    // 6) Clasificación de compras por cliente
    public function classification() {
        $compra = new Compra();
        $clasificacion = $compra->getAllGroupedByCliente();
        $this->renderView('compra/classification', [
            'clasificacion' => $clasificacion
        ]);
    }
}
