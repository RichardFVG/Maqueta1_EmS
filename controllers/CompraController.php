<?php
require_once 'BaseController.php';

class CompraController extends BaseController {
    // Mostramos un ejemplo de clasificación de compras agrupadas por cliente
    public function index() {
        $compra = new Compra();
        $clasificacion = $compra->getAllGroupedByCliente();
        $this->renderView('compra/index', ['compras' => $clasificacion]);
    }
}
