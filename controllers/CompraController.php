<?php
require_once 'BaseController.php';

class CompraController extends BaseController {

    // 1) Listar todas las compras
    public function index() {
        $compra = new Compra();
        $compras = $compra->getAll(); // Todas las compras
        $this->renderView('compra/index', ['compras' => $compras]);
    }

    // 2) Crear compra
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recogemos datos del formulario
            $cliente = $_POST['cliente'];
            $producto = $_POST['producto'];
            $fecha = $_POST['fecha'];
            $monto = $_POST['monto'];

            // Guardamos en BD
            $compra = new Compra();
            $compra->setCliente($cliente);
            $compra->setProducto($producto);
            $compra->setFecha($fecha);
            $compra->setMonto($monto);
            $compra->save();

            // Redirigimos al listado de compras
            header("Location: index.php?controller=Compra&action=index");
        } else {
            // Mostramos formulario de creación
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
                // Actualizamos datos
                $cliente = $_POST['cliente'];
                $producto = $_POST['producto'];
                $fecha = $_POST['fecha'];
                $monto = $_POST['monto'];

                $compra->setCliente($cliente);
                $compra->setProducto($producto);
                $compra->setFecha($fecha);
                $compra->setMonto($monto);
                $compra->update();

                // Redirigimos al listado
                header("Location: index.php?controller=Compra&action=index");
            } else {
                // Mostrar formulario de edición
                $this->renderView('compra/edit', ['compra' => $compraActual]);
            }
        } else {
            // Si no hay ID, volvemos al listado
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

    // 5) Descargar todas las compras en formato XLS
    public function downloadXls() {
        $compra = new Compra();
        $compras = $compra->getAll();

        // Cabeceras para forzar la descarga
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=compras.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Encabezados de columna
        echo "ID\tCliente\tProducto\tFecha\tMonto\n";

        // Filas
        foreach ($compras as $c) {
            echo $c['id']."\t".
                 $c['cliente']."\t".
                 $c['producto']."\t".
                 $c['fecha']."\t".
                 $c['monto']."\n";
        }
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
