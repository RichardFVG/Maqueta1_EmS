<?php
require_once 'BaseController.php';

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

        // Cálculo de totales (suma de cantidades, cantidad de albaranes)
        $totalAlbaranes = count($albaranes);
        $sumaCantidad = 0;
        foreach ($albaranes as $a) {
            $sumaCantidad += $a['cantidad'];
        }

        // Renderizar la nueva vista summary
        $this->renderView('albaran/summary', [
            'albaranes' => $albaranes,
            'totalAlbaranes' => $totalAlbaranes,
            'sumaCantidad' => $sumaCantidad
        ]);
    }

    // Descargar XLS con el historial de albaranes
    public function downloadSummaryXls() {
        $albaran = new Albaran();
        $albaranes = $albaran->getAll();

        // Cálculo de totales
        $totalAlbaranes = count($albaranes);
        $sumaCantidad = 0;
        foreach ($albaranes as $a) {
            $sumaCantidad += $a['cantidad'];
        }

        // Cabeceras para forzar la descarga
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=historial_albaranes.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Encabezados de columnas en la hoja Excel
        // También se puede agregar un título previo, etc.
        echo "ID\tFecha\tProveedor\tCantidad\tDescripción\n";

        // Filas de datos
        if(!empty($albaranes)){
            foreach ($albaranes as $row) {
                echo $row['id']."\t".
                     $row['fecha']."\t".
                     $row['proveedor']."\t".
                     $row['cantidad']."\t".
                     $row['descripcion']."\n";
            }
        }

        // Podemos agregar un salto de línea y totales al final del archivo
        echo "\n";  // salto
        echo "Total Albaranes:\t$totalAlbaranes\n";
        echo "Suma Cantidad:\t$sumaCantidad\n";
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
