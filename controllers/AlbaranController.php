<?php
require_once 'BaseController.php';

// (NUEVO) Importamos las clases de PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class AlbaranController extends BaseController {
    // Listado
    public function index() {
        $albaran = new Albaran();
        $albaranes = $albaran->getAll();
        $this->renderView('albaran/index', ['albaranes' => $albaranes]);
    }

    // Generar resumen de albaranes
    public function generateSummary() {
        $albaran = new Albaran();
        $albaranes = $albaran->getAll();

        // Cálculo de totales
        $totalAlbaranes = count($albaranes);
        $sumaCantidad = 0;
        foreach ($albaranes as $a) {
            $sumaCantidad += $a['cantidad'];
        }

        $this->renderView('albaran/summary', [
            'albaranes' => $albaranes,
            'totalAlbaranes' => $totalAlbaranes,
            'sumaCantidad' => $sumaCantidad
        ]);
    }

    // (MODIFICADO) Descargar XLS real con el historial de albaranes
    public function downloadSummaryXls() {
        $albaran = new Albaran();
        $albaranes = $albaran->getAll();

        // Cálculo de totales
        $totalAlbaranes = count($albaranes);
        $sumaCantidad = 0;
        foreach ($albaranes as $a) {
            $sumaCantidad += $a['cantidad'];
        }

        // 1) Crear la hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Historial Albaranes');

        // 2) Cabeceras en la fila 1
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Fecha');
        $sheet->setCellValue('C1', 'Proveedor');
        $sheet->setCellValue('D1', 'Cantidad');
        $sheet->setCellValue('E1', 'Descripción');

        // 3) Llenamos las filas con los datos
        $rowNumber = 2;
        foreach ($albaranes as $row) {
            $sheet->setCellValue('A'.$rowNumber, $row['id']);
            $sheet->setCellValue('B'.$rowNumber, $row['fecha']);
            $sheet->setCellValue('C'.$rowNumber, $row['proveedor']);
            $sheet->setCellValue('D'.$rowNumber, $row['cantidad']);
            $sheet->setCellValue('E'.$rowNumber, $row['descripcion']);
            $rowNumber++;
        }

        // 4) Agregar totales (opcional)
        $sheet->setCellValue('A'.($rowNumber + 1), 'Total Albaranes:');
        $sheet->setCellValue('B'.($rowNumber + 1), $totalAlbaranes);

        $sheet->setCellValue('A'.($rowNumber + 2), 'Suma Cantidades:');
        $sheet->setCellValue('B'.($rowNumber + 2), $sumaCantidad);

        // 5) Ajustar anchos (opcional)
        foreach (['A','B','C','D','E'] as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // 6) Cabeceras para forzar la descarga como .xls real
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="historial_albaranes.xls"');
        header('Cache-Control: max-age=0');

        // 7) Crear el writer y enviar
        $writer = new Xls($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    // Crear albarán
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fecha = $_POST['fecha'];
            $proveedor = $_POST['proveedor'];
            $cantidad = $_POST['cantidad'];
            $descripcion = $_POST['descripcion'];

            $albaran = new Albaran();
            $albaran->setFecha($fecha);
            $albaran->setProveedor($proveedor);
            $albaran->setCantidad($cantidad);
            $albaran->setDescripcion($descripcion);
            $albaran->save();

            header("Location: index.php?controller=Albaran&action=index");
        } else {
            $this->renderView('albaran/create');
        }
    }

    // Editar albarán
    public function edit() {
        if (isset($_GET['id'])) {
            $albaran = new Albaran();
            $albaran->setId($_GET['id']);
            $albaranActual = $albaran->getOne();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $fecha = $_POST['fecha'];
                $proveedor = $_POST['proveedor'];
                $cantidad = $_POST['cantidad'];
                $descripcion = $_POST['descripcion'];

                $albaran->setFecha($fecha);
                $albaran->setProveedor($proveedor);
                $albaran->setCantidad($cantidad);
                $albaran->setDescripcion($descripcion);
                $albaran->update();

                header("Location: index.php?controller=Albaran&action=index");
            } else {
                $this->renderView('albaran/edit', ['albaran' => $albaranActual]);
            }
        } else {
            header("Location: index.php?controller=Albaran&action=index");
        }
    }

    // Eliminar albarán
    public function delete() {
        if (isset($_GET['id'])) {
            $albaran = new Albaran();
            $albaran->setId($_GET['id']);
            $albaran->delete();
        }
        header("Location: index.php?controller=Albaran&action=index");
    }
}
