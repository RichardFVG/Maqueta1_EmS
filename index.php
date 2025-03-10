<?php
session_start();

// Requerimos la configuración de base de datos
require_once 'config/database.php';

// Controlador base que maneja la carga de vistas
require_once 'controllers/BaseController.php';

// Modelos
require_once 'models/Factura.php';
require_once 'models/Albaran.php';
require_once 'models/Compra.php';

// Controladores
require_once 'controllers/FacturaController.php';
require_once 'controllers/AlbaranController.php';
require_once 'controllers/CompraController.php';

// Obtenemos el nombre del controlador y la acción desde la URL (GET)
// Ej: index.php?controller=Factura&action=index
$controllerName = isset($_GET['controller']) ? $_GET['controller'].'Controller' : 'FacturaController';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Verificamos que la clase controlador exista
if (class_exists($controllerName)) {
    $controller = new $controllerName();
    // Verificamos que el método (acción) exista
    if (method_exists($controller, $actionName)) {
        $controller->$actionName();
    } else {
        echo "La acción <strong>$actionName</strong> no existe.";
    }
} else {
    echo "El controlador <strong>$controllerName</strong> no existe.";
}
