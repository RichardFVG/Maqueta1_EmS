<?php
require_once 'BaseController.php';

class AlbaranController extends BaseController {
    // Listado
    public function index() {
        $albaran = new Albaran();
        $albaranes = $albaran->getAll();
        $this->renderView('albaran/index', ['albaranes' => $albaranes]);
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
