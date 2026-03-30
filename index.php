<?php
require_once 'controllers/HomeController.php';
require_once 'controllers/MenuController.php';
require_once 'controllers/PlatController.php';
require_once 'controllers/RestaurantController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ContactController.php';
require_once 'controllers/PanierController.php';
if (file_exists('controllers/CommandeController.php')) {
    require_once 'controllers/CommandeController.php';
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Routeur basique
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Créer le contrôleur dynamique
$controllerClass = ucfirst($controller) . 'Controller';
$controllerObject = new $controllerClass();

// Appeler l'action
if (isset($_GET['id'])) {
    $controllerObject->$action($_GET['id']);
} else {
    $controllerObject->$action();
}
?>