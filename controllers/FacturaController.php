<?php
require_once 'BaseController.php';

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
            // Recogemos datos del formulario
            $fecha = $_POST['fecha'];
            $cliente = $_POST['cliente'];
            $servicio = $_POST['servicio'];
            $total = $_POST['total'];

            // Guardamos en BD
            $factura = new Factura();
            $factura->setFecha($fecha);
            $factura->setCliente($cliente);
            $factura->setServicio($servicio);
            $factura->setTotal($total);
            $factura->save();

            // Redireccionamos al listado
            header("Location: index.php?controller=Factura&action=index");
        } else {
            // Mostramos formulario de creación
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
                // Actualizamos datos
                $fecha = $_POST['fecha'];
                $cliente = $_POST['cliente'];
                $servicio = $_POST['servicio'];
                $total = $_POST['total'];

                $factura->setFecha($fecha);
                $factura->setCliente($cliente);
                $factura->setServicio($servicio);
                $factura->setTotal($total);
                $factura->update();

                // Redireccionar tras actualizar
                header("Location: index.php?controller=Factura&action=index");
            } else {
                // Mostrar formulario de edición
                $this->renderView('factura/edit', ['factura' => $facturaActual]);
            }
        } else {
            // Si no hay ID, volvemos a la lista
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

    // Descargar facturas en formato XLS
    public function downloadXls() {
        $factura = new Factura();
        $facturas = $factura->getAll();

        // Cabeceras para forzar la descarga
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=facturas.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Encabezados de columna
        echo "ID\tFecha\tCliente\tServicio\tTotal\n";
        // Filas
        foreach ($facturas as $f) {
            echo $f['id']."\t".
                 $f['fecha']."\t".
                 $f['cliente']."\t".
                 $f['servicio']."\t".
                 $f['total']."\n";
        }
    }

    // Filtrar facturas por fecha (mostrar formulario y resultado)
    public function filterDate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];

            $factura = new Factura();
            $facturas = $factura->filterByDateRange($startDate, $endDate);
            $this->renderView('factura/index', ['facturas' => $facturas]);
        } else {
            // Mostramos el formulario de filtro
            $this->renderView('factura/filterDate');
        }
    }
}
