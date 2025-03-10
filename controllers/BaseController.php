<?php
class BaseController {
    // Renderiza una vista, inyectando variables en un array asociativo opcional
    public function renderView($view, $data = []) {
        extract($data); // Extrae las variables del array para usarlas en la vista
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/menu.php';
        require_once 'views/' . $view . '.php';
        require_once 'views/layouts/footer.php';
    }
}
