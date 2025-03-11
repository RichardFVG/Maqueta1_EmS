<?php
session_start();

// (NUEVO) Cargamos el autoload de Composer para usar PhpSpreadsheet
require_once __DIR__ . '/vendor/autoload.php';

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

// Obtenemos el nombre del controlador y la acción
$controllerName = isset($_GET['controller']) ? $_GET['controller'].'Controller' : 'FacturaController';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Verificamos la existencia del controlador
if (class_exists($controllerName)) {
    $controller = new $controllerName();
    // Verificamos la existencia del método (acción)
    if (method_exists($controller, $actionName)) {
        $controller->$actionName();
    } else {
        echo "La acción <strong>$actionName</strong> no existe.";
    }
} else {
    echo "El controlador <strong>$controllerName</strong> no existe.";
}
